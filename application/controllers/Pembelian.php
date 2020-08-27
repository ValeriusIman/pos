<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Pembelian_m", "Barang_m", "ItemPembelian_m", "Pelanggan_m", "Supplier_m", "Satuan_m", "User_m",));
    }

    public function index()
    {
        $user = $this->User_m->getAll()->result();
        $barang = $this->Barang_m->getAll();
        $supplier = $this->Supplier_m->getAll();
        $satuan = $this->Satuan_m->getAll();

        //1.cari dulu nilai terbesar dari id yang terakhir
        $queryMaxId = "select ifnull(max(nomor),0) as max from transaksi_beli "
            . "WHERE DAY(tanggal) = DAY(NOW()) AND MONTH(tanggal) = MONTH(NOW()) AND YEAR(tanggal)=YEAR(NOW())";
        $max = $this->db->query($queryMaxId)->row()->max;
        $max = (int) $max;
        // "TRX/2020/04/0120"
        $strPad = str_pad($max + 1, 4, "0", STR_PAD_LEFT);
        $noTransaksi = "PB/" . date("ymd") . "/" . $strPad;

        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Aplikasi Pembelian",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/pembelian/app_pembelian",
            "users" => $user,
            "barangs" => $barang,
            "suppliers" => $supplier,
            "satuans" => $satuan,
            "noTransaksi" => $noTransaksi
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesTransaksi()
    {
        $str_item_beli = $this->input->post("item_beli");
        $itemBeli = json_decode($str_item_beli);

        //1.cari dulu nilai terbesar dari id yang terakhir
        $queryMaxId = "select ifnull(max(nomor),0) as max from transaksi_beli "
            . "WHERE DAY(tanggal) = DAY(NOW()) AND MONTH(tanggal) = MONTH(NOW()) AND YEAR(tanggal)=YEAR(NOW())";
        $max = $this->db->query($queryMaxId)->row()->max;
        $max = (int) $max;
        // "TRX/2020/04/0120"
        $strPad = str_pad($max + 1, 4, "0", STR_PAD_LEFT);
        $noTransaksi = "PB/" . date("ymd") . "/" . $strPad;

        $dataTransaksi = array(
            "no_pembelian" => $noTransaksi,
            "user_id" => $this->input->post("id_user"),
            "supplier_id" => $this->input->post("id_supplier"),
            "tanggal" => $this->input->post("tanggal"),
            "biaya" => $this->input->post("total"),
            "nomor" => ($max + 1)
        );

        if (isset($_POST['proses'])) {
            $idTransaksi = $this->Pembelian_m->insertGetId($dataTransaksi);
            $index = 0;
            foreach ($itemBeli as $item) {
                $itemBeli[$index++]->transaksi_beli_id = $idTransaksi;
            }
            $this->ItemPembelian_m->insertBatch($itemBeli);

            if ($this->db->affected_rows() > 0) {
                $keranjang = array("success" => true, "id_transaksi" => $idTransaksi);
            } else {
                $keranjang = array("success" => false);
            }
            echo json_encode($keranjang);
        }
    }

    public function list()
    {
        $list = $this->Pembelian_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Pembelian",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/pembelian/v_pembelian_list",
            "pembelians" => $list
        );
        $this->load->view('tamplates/main', $data);
    }

    public function detail($id)
    {

        $result = userData(); //fungsi_helper
        $pembelian = $this->Pembelian_m->getJoin($id);
        $item = $this->ItemPembelian_m->joinLengkap($id);
        $data = array(
            "title" => "Detail Pembelian",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/pembelian/v_detail_pembelian",
            "pembelian" => $pembelian,
            "item" => $item
        );
        $this->load->view('tamplates/main', $data);
    }

    public function print($id)
    {
        $result = userData(); //fungsi_helper
        $pembelian = $this->Pembelian_m->getJoin($id);
        $item = $this->ItemPembelian_m->joinLengkap($id);
        $data = array(
            "title" => "Print",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/pembelian/print_pembelian",
            "pembelian" => $pembelian,
            "item" => $item
        );
        $this->load->view('tamplates/main', $data);
    }

    public function report()
    {
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Laporan Pembelian",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/laporan/v_report_pembelian",
        );
        $this->load->view('tamplates/main', $data);
    }

    public function getReport()
    {
        $awal = $this->input->post("tanggal_awal");
        $akhir = $this->input->post("tanggal_akhir");
        if (isset($_POST['proses'])) {
            $join = $this->Pembelian_m->joinPembelian($awal, $akhir);
            echo json_encode($join);
        };
    }

    public function downloadReport()
    {
        $awal = $this->input->post("tanggalAwal");
        $akhir = $this->input->post("tanggalAkhir");
        $pembelian = $this->Pembelian_m->joinPembelian($awal, $akhir);
        $item = $this->Pembelian_m->joinItem($awal, $akhir);
        $data = array(
            "pembelians" => $pembelian,
            "items" => $item,
            "awal" => $awal,
            "akhir" => $akhir
        );
        $html = $this->load->view('transaksi/laporan/print_pembelian', $data, true);
        $this->fungsi->pdfGenerator($html, 'Pembelian Priode ' . $awal . ' s/d ' . $akhir, 'A4', 'portrait');
    }
}

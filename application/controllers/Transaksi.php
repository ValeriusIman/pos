<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Transaksi_m", "ItemTransaksi_m"));
    }
    public function index()
    {
        $list = $this->Transaksi_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Transaksi",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/transaksi/v_transaksi_list",
            "transaksis" => $list
        );
        $this->load->view('tamplates/main', $data);
    }

    public function detail($id)
    {

        $result = userData(); //fungsi_helper
        $transaksi = $this->Transaksi_m->getJoin($id);
        $item = $this->ItemTransaksi_m->joinLengkap($id);
        $data = array(
            "title" => "Detail Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/transaksi/v_transaksi_detail",
            "transaksi" => $transaksi,
            "item" => $item
        );
        $this->load->view('tamplates/main', $data);
    }

    public function report()
    {
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Laporan Penjualan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/laporan/v_report",
        );
        $this->load->view('tamplates/main', $data);
    }

    public function getReport()
    {
        $awal = $this->input->post("tanggal_awal");
        $akhir = $this->input->post("tanggal_akhir");
        if (isset($_POST['proses'])) {
            $join = $this->Transaksi_m->joinTransaksiDetail($awal, $akhir);
            echo json_encode($join);
        };
    }

    public function downloadReport()
    {
        $awal = $this->input->post("tanggalAwal");
        $akhir = $this->input->post("tanggalAkhir");
        $transaksi = $this->Transaksi_m->joinTransaksiDetail($awal, $akhir);
        $item = $this->Transaksi_m->joinTransaksi($awal, $akhir);
        $data = array(
            "transaksis" => $transaksi,
            "items" => $item,
            "awal" => $awal,
            "akhir" => $akhir
        );
        $html = $this->load->view('transaksi/laporan/print', $data, true);
        $this->fungsi->pdfGenerator($html, 'Transaksi Priode ' . $awal . ' s/d ' . $akhir, 'A4', 'portrait');
    }

    public function print($id)
    {
        $result = userData(); //fungsi_helper
        $transaksi = $this->Transaksi_m->getJoin($id);
        $item = $this->ItemTransaksi_m->joinLengkap($id);
        $data = array(
            "title" => "Print",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/transaksi/print_transaksi",
            "transaksi" => $transaksi,
            "item" => $item
        );
        $this->load->view('tamplates/main', $data);
    }

    public function laba()
    {
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Laporan Laba Rugi",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/laporan/v_laba",
        );
        $this->load->view('tamplates/main', $data);
    }

    public function downloadLabaKotor()
    {
        $awal = $this->input->post("tanggalAwal");
        $akhir = $this->input->post("tanggalAkhir");
        $biaya = $this->input->post("biaya");
        $item = $this->Transaksi_m->joinItemLaba($awal, $akhir);
        $jumlah = $this->Transaksi_m->hitungTotal($awal, $akhir);
        $data = array(
            "items" => $item,
            "awal" => $awal,
            "akhir" => $akhir,
            "jumlah" => $jumlah,
            "biaya" => $biaya,
        );
        $html = $this->load->view('transaksi/laporan/print_laba_kotor', $data, true);
        $this->fungsi->pdfGenerator($html, 'Laba Kotor Priode ' . $awal . ' s/d ' . $akhir, 'A4', 'portrait');
    }
}

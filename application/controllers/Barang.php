<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Barang_m", "JenisBarang_m", "Satuan_m"));
    }

    public function index()
    {
        $list = $this->Barang_m->getAll();
        $jenisBarang = $this->JenisBarang_m->getAll();
        $satuan = $this->Satuan_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/barang/v_barang_list",
            "barangs" => $list,
            "jenisBarangs" => $jenisBarang,
            "satuans" => $satuan
        );
        $this->load->view('tamplates/main', $data);
    }

    public function detail($id)
    {

        $result = userData(); //fungsi_helper
        $barang = $this->Barang_m->getPrimaryKey($id);
        $jenisBarang = $this->JenisBarang_m->getAll();
        $satuan = $this->Satuan_m->getAll();
        $data = array(
            "title" => "Detail Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/barang/v_barang_detail",
            "barang" => $barang,
            "jenisBarangs" => $jenisBarang,
            "satuans" => $satuan
        );
        $this->load->view('tamplates/main', $data);
    }

    public function tambah()
    {
        $barang = array(
            "kode_barang" => $this->input->post("kodeBarang", true),
            "nama_barang" => $this->input->post("namaBarang", true),
            "jenis_barang_id" => $this->input->post("jenisBarang", true),
            "satuan_id" => $this->input->post("satuanBarang", true)
        );
        $this->Barang_m->insert($barang);
    }

    public function prosesEdit()
    {
        $id = $this->input->post("id", true);
        $barang = array(
            "nama_barang" => $this->input->post("nama_barang", true),
            "jenis_barang_id" => $this->input->post("kategori", true),
            "satuan_id" => $this->input->post("satuan", true)
        );
        $this->Barang_m->update($id, $barang);
    }

    public function delete()
    {
        $id = $this->input->post("id");
        $this->Barang_m->delete($id);
    }

    public function restore()
    {
        $id = $this->input->post("id");
        $this->Barang_m->restore($id);
    }

    public function printBarcode($id)
    {
        $barang['barang'] = $this->Barang_m->getPrimaryKey($id);
        // $barang['barang'] = $this->Barang_m->getAll();
        $html = $this->load->view('master/barang/printBarcode', $barang, true);
        $this->fungsi->pdfGenerator($html, 'Barcode-' . $barang['barang']->kode_barang, 'A4', 'portrait');
    }

    // Ambil data Barang
    function get_barang()
    {
        $kode = $this->input->post('kode_barang');
        $data = $this->Barang_m->get_data_barang_bykode($kode);
        echo json_encode($data);
    }

    public function reportBarang()
    {
        $jenisBarang = $this->JenisBarang_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Laporan Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/laporan/v_report_barang",
            "jenisBarangs" => $jenisBarang,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function filter()
    {
        $filter = $this->input->post("filter");
        if (isset($_POST['proses'])) {
            $data = $this->Barang_m->filter($filter);
            echo json_encode($data);
        };
    }

    public function printBarang()
    {
        $filter = $this->input->post("filter");
        $barang['barang'] = $this->Barang_m->filter($filter);
        $html = $this->load->view('transaksi/laporan/print_barang', $barang, true);
        $this->fungsi->pdfGenerator($html, 'Daftar Barang ', 'A4', 'portrait');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecycleBin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Barang_m", "JenisBarang_m", "Satuan_m", "Supplier_m", "Pelanggan_m", "user_m"));
    }

    public function hapusBarang()
    {
        $list = $this->Barang_m->getHapus();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Recycle Bin Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/barang/v_barang_hapus",
            "barangs" => $list,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function hapusPelanggan()
    {
        $list = $this->Pelanggan_m->getHapus();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Recycle Bin Pelanggan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/pelanggan/v_pelanggan_hapus",
            "pelanggans" => $list,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function hapusSupplier()
    {
        $list = $this->Supplier_m->getHapus();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Recycle Bin Supplier",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/supplier/v_supplier_hapus",
            "suppliers" => $list,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function hapusKategori()
    {
        $list = $this->JenisBarang_m->getHapus();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Recycle Bin Supplier",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/jenisBarang/v_jenisBarang_hapus",
            "kategoris" => $list,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function hapusSatuan()
    {
        $list = $this->Satuan_m->getHapus();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Recycle Bin Satuan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/satuan/v_satuan_hapus",
            "satuans" => $list,
        );
        $this->load->view('tamplates/main', $data);
    }
}

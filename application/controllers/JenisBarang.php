<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model("JenisBarang_m");
    }

    public function index()
    {
        $list = $this->JenisBarang_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Kategori Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/jenisBarang/v_jenisBarang_list",
            "jenisBarangs" => $list
        );
        $this->load->view('tamplates/main', $data);
    }

    public function tambah()
    {
        $jenisBarang = array(
            "jenis_barang" => $this->input->post("jenis_barang", true)
        );
        $this->JenisBarang_m->insert($jenisBarang);
    }

    public function delete()
    {
        $id = $this->input->post("id_jenis_barang");
        $this->JenisBarang_m->delete($id);
    }

    public function restore()
    {
        $id = $this->input->post("id");
        $this->JenisBarang_m->restore($id);
    }

    public function edit($id)
    {
        $result = userData();
        $jenisBarang = $this->JenisBarang_m->getPrimaryKey($id);
        $data = array(
            "title" => "Edit Kategori Barang",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/jenisBarang/v_jenisBarang_edit",
            "jenisBarang" => $jenisBarang
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesEdit()
    {
        $id = $this->input->post("id_jenis_barang");
        $jenisBarang = array(
            "jenis_barang" => $this->input->post("jenis_barang")
        );
        $this->JenisBarang_m->update($id, $jenisBarang);
    }
}

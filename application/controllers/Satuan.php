<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model("Satuan_m");
    }

    public function index()
    {
        $list = $this->Satuan_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Satuan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/satuan/v_satuan_list",
            "satuans" => $list
        );
        $this->load->view('tamplates/main', $data);
    }

    public function tambah()
    {
        $satuan = array(
            "satuan_barang" => $this->input->post("satuan_barang", true)
        );
        $this->Satuan_m->insert($satuan);
    }

    public function delete()
    {
        $id = $this->input->post("id_satuan");
        $this->Satuan_m->delete($id);
    }

    public function restore()
    {
        $id = $this->input->post("id");
        $this->Satuan_m->restore($id);
    }

    public function edit($id)
    {
        $result = userData();
        $satuan = $this->Satuan_m->getPrimaryKey($id);
        $data = array(
            "title" => "Edit satuan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/satuan/v_satuan_edit",
            "satuan" => $satuan
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesEdit()
    {
        $id = $this->input->post("id_satuan");
        $satuan = array(
            "satuan_barang" => $this->input->post("satuan_barang")
        );
        $this->Satuan_m->update($id, $satuan);
    }
}

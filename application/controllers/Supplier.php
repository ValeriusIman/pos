<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model("Supplier_m");
    }
    public function index()
    {
        $list = $this->Supplier_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Supplier",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/supplier/v_supplier_list",
            "suppliers" => $list
        );
        $this->load->view('tamplates/main', $data);
    }

    public function tambah()
    {
        $supplier = array(
            "nama_supplier" => $this->input->post("nama_supplier", true),
            "no_telp" => $this->input->post("no_telp", true),
            "alamat" => $this->input->post("alamat", true),
            "keterangan" => $this->input->post("keterangan", true)
        );
        $this->Supplier_m->insert($supplier);
    }

    public function delete()
    {
        $id = $this->input->post("id_supplier");
        $this->Supplier_m->delete($id);
    }

    public function restore()
    {
        $id = $this->input->post("id");
        $this->Supplier_m->restore($id);
    }

    public function edit($id)
    {
        $result = userData();
        $supplier = $this->Supplier_m->getPrimaryKey($id);
        $data = array(
            "title" => "Edit Supplier",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/supplier/v_supplier_edit",
            "supplier" => $supplier
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesEdit()
    {
        $id = $this->input->post("id_supplier");
        $supplier = array(
            "nama_supplier" => $this->input->post("nama_supplier"),
            "no_telp" => $this->input->post("no_telp"),
            "alamat" => $this->input->post("alamat"),
            "keterangan" => $this->input->post("keterangan")
        );
        $this->Supplier_m->update($id, $supplier);
    }
}

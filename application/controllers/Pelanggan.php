<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model("Pelanggan_m");
    }
    public function index()
    {
        $listPelanggan = $this->Pelanggan_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Pelanggan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/pelanggan/v_pelanggan_list",
            "pelanggans" => $listPelanggan
        );
        $this->load->view('tamplates/main', $data);
    }

    public function tambah()
    {
        $pelanggan = array(
            "nama_pelanggan" => $this->input->post("nama_pelanggan", true),
            "no_telp" => $this->input->post("no_telp", true)
        );
        $this->Pelanggan_m->insert($pelanggan);
    }

    public function delete()
    {
        $pelanggan = $this->input->post("id_pelanggan");
        $this->Pelanggan_m->delete($pelanggan);
    }

    public function restore()
    {
        $id = $this->input->post("id");
        $this->Pelanggan_m->restore($id);
    }

    public function edit($id)
    {
        $result = userData();
        $pelanggan = $this->Pelanggan_m->getPrimaryKey($id);
        $data = array(
            "title" => "Edit Pelanggan",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/pelanggan/v_pelanggan_edit",
            "pelanggan" => $pelanggan
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesEdit()
    {
        $id = $this->input->post("id_pelanggan");
        $pelanggan = array(
            "nama_pelanggan" => $this->input->post("nama_pelanggan"),
            "no_telp" => $this->input->post("no_telp")
        );
        $this->Pelanggan_m->update($id, $pelanggan);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // not_login();
        $this->load->model(array("User_m", "Dashboard_m"));
    }

    public function dashboard()
    {
        $email = userData(); //fungsi_helper

        $hari = $this->Dashboard_m->hitungPendapatan();
        $bulan = $this->Dashboard_m->hitungPendapatanBulan();
        $tahun = $this->Dashboard_m->hitungPendapatanTahun();
        $total = $this->Dashboard_m->hitungSemua();
        $transaksi = $this->Dashboard_m->transaksiPerBulan();
        $pendapatan = $this->Dashboard_m->pendapatan();
        $pengeluaran = $this->Dashboard_m->pengeluaran();
        $produk = $this->Dashboard_m->jumlahProdukTerlaris();
        $produkTerlaris = $this->Dashboard_m->produkTerlaris();
        $stock = $this->Dashboard_m->stock();
        $karyawan = $this->Dashboard_m->karyawan();
        $supplier = $this->Dashboard_m->supplier();
        $pelanggan = $this->Dashboard_m->pelanggan();
        $penjualan = $this->Dashboard_m->penjualan();

        $data = array(
            "title" => "Dashboard",
            "result" => $email['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "tamplates/dashboard",
            "perhari" => $hari,
            "perbulan" => $bulan,
            "tahun" => $tahun,
            "total" => $total,
            "transaksi" => $transaksi,
            "pendapatan" => $pendapatan,
            "pengeluaran" => $pengeluaran,
            "produk" => $produk,
            "produkTerlaris" => $produkTerlaris,
            "stock" => $stock,
            "karyawan" => $karyawan,
            "pelanggan" => $pelanggan,
            "supplier" => $supplier,
            "penjualan" => $penjualan,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function index()
    {
        check_admin();
        $listUser = $this->User_m->getAll()->result();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "User",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/user/v_user_listData",
            "users" => $listUser
        );
        $this->load->view('tamplates/main', $data);
    }

    public function profil()
    {

        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "My Profile",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/user/v_user_profile"
        );
        $this->load->view('tamplates/main', $data);
    }

    public function edit()
    {
        $id = $this->input->post("idUser", true);
        $user = array(
            "nama" => $this->input->post("nama", true),
            "alamat" => $this->input->post("alamat", true),
            "no_telp" => $this->input->post("no_telp", true),
            "tanggal_lahir" => $this->input->post("tanggal", true),
            "jenis_kelamin" => $this->input->post("jenis_kelamin", true)
        );

        $this->User_m->update($id, $user);
    }

    public function detail($id)
    {
        $result = userData();
        $user = $this->User_m->getPrimaryKey($id);
        $data = array(
            "title" => "Detail User",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "master/user/v_user_detail",
            "user" => $user
        );
        $this->load->view('tamplates/main', $data);
    }

    public function delete($id)
    {
        $user = $this->User_m->getPrimaryKey($id);
        if (file_exists("assets/img/profile/$user->image")) {
            unlink("assets/img/profile/$user->image");
        }
        $delete = $this->User_m->delete($id);
        return $delete;
    }

    public function insertUser()
    {
        $user = array(
            "email" => $this->input->post("email", true),
            "nama" => $this->input->post("nama", true),
            "password" => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
            "jenis_kelamin" => $this->input->post("jenis_kelamin", true),
            "alamat" => $this->input->post("alamat", true),
            "no_telp" => $this->input->post("no_telp", true),
            "tanggal_lahir" => $this->input->post("tanggal", true),
            "level" => $this->input->post("role", true),
            "is_active" => 1,
            "token" => md5($this->input->post("email")),
            "date_created" => time()
        );
        $this->User_m->insert($user);
    }

    public function getPendapatan()
    {
        $awal = $this->input->post('tanggal_awal', true);
        $akhir = $this->input->post('tanggal_akhir', true);
        if (isset($_POST['proses'])) {
            $join = $this->Dashboard_m->pendapatanPeriode($awal, $akhir);
            echo json_encode($join);
        };
    }

    public function getPengeluaran()
    {
        $awal = $this->input->post('tanggal_awal', true);
        $akhir = $this->input->post('tanggal_akhir', true);
        if (isset($_POST['proses'])) {
            $join = $this->Dashboard_m->pengeluaranPeriode($awal, $akhir);
            echo json_encode($join);
        };
    }
}

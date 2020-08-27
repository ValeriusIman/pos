<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("User_m");
        // login();
    }

    public function index()
    {
        login();
        $data = array(
            "title" => "Login",
            "page" => "auth/login"
        );
        $this->load->view('tamplates/mainLogin', $data);
    }

    public function login()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_m->getEmail($email);
        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'level' => $user['level'],
                        'user_id' => $user['id_user'],
                        'nama' => $user['nama']
                    ];
                    $this->session->set_userdata($data);
                    redirect('user/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Kata sandi salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Anda telah keluar dari akun!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/error404');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tunda_m extends CI_Model
{
    public function getAll($params = null)
    {
        $this->db->select('transaksi_tunda.*, user.nama')
            ->from('transaksi_tunda')
            ->join('user', 'user.id_user = transaksi_tunda.user_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $this->db->get();
    }

    public function insertGetId($data)
    {
        $this->db->insert("transaksi_tunda", $data);
        return $this->db->insert_id();
    }

    function get_item_tunda_bykode($id)
    {
        $this->db->select('*');
        $this->db->from('item_tunda');
        $this->db->where('tunda_id', $id);
        $hasil = $this->db->get()->result();
        return $hasil;
    }

    public function delete_tundatransaksi($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        return $this->db->delete('transaksi_tunda');
    }
}

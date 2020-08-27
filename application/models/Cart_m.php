<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_m extends CI_Model
{

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM cart");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int) $row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = array(
            'cart_id' => $car_no,
            'barang_id' => $post['barang_id'],
            'harga' => $post['harga'],
            'qty' => $post['qty'],
            'total' => $post['total'],
            'hpp' => $post['hpp'],
            'total_hpp' => $post['total_hpp'],
            'user_id' => $post['user_id'],
        );

        $this->db->insert('cart', $params);
    }

    public function getAllCart($params = null)
    {
        $this->db->select('cart.*,barang.kode_barang as kode, barang.nama_barang as nama')
            ->from('cart')
            ->join('barang', 'barang.id_barang = cart.barang_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $this->db->get();
    }

    public function delCart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function updateQty($post)
    {
        $sql = "UPDATE cart SET harga = '$post[harga]',
                qty = qty + '$post[qty]',
                total = '$post[harga]' * qty,
                total_hpp = '$post[hpp]' * qty
                WHERE barang_id = '$post[barang_id]'";
        $this->db->query($sql);
    }

    function insertBatchTundaTransaksi($params)
    {
        $this->db->insert_batch('cart', $params);
    }
}

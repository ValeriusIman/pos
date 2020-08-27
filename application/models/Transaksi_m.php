<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{
    var $table = "transaksi";
    var $primaryKey = "id_transaksi";

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function insertGetId($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function getAll()
    {
        $this->db->select('transaksi.*,user.nama as nama_user, pelanggan.nama_pelanggan as pelanggan_nama')
            ->from('transaksi')
            ->join('user', 'user.id_user = transaksi.user_id')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.pelanggan_id')
            ->order_by('no_transaksi', 'desc');
        return $this->db->get()->result();
    }

    public function getJoin($id)
    {
        $this->db->select('item_transaksi.*, user.nama, pelanggan.nama_pelanggan, transaksi.no_transaksi,
            transaksi.tanggal_transaksi, transaksi.total_harga, transaksi.diskon, transaksi.bayar, transaksi.kembalian, transaksi.grand_total')
            ->from('item_transaksi')
            ->join('transaksi', 'transaksi.id_transaksi = item_transaksi.transaksi_id')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.pelanggan_id')
            ->join('user', 'user.id_user = transaksi.user_id')
            ->where('item_transaksi.transaksi_id', $id);
        return $this->db->get()->row();
    }

    public function getByPrimaryKey($id)
    {
        $this->db->select('transaksi.*,user.nama as nama_user, pelanggan.nama_pelanggan as pelanggan_nama')
            ->from('transaksi')
            ->join('user', 'user.id_user = transaksi.user_id')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.pelanggan_id')
            ->where('transaksi.id_transaksi', $id);
        return $this->db->get()->row();
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    // delete data
    public function delete($id)
    {
        return $this->db->update($this->table, array("is_active" => 0));
    }

    public function joinTransaksiDetail($awal, $akhir)
    {
        $query = "SELECT *, user.nama FROM transaksi JOIN user ON user.id_user = transaksi.user_id "
            . "WHERE tanggal_transaksi BETWEEN '$awal' AND '$akhir' ORDER BY no_transaksi ASC";
        $as = $this->db->query($query);
        return $as->result();
    }

    public function joinTransaksi($awal, $akhir)
    {
        $query = "SELECT *, barang.nama_barang as nama,barang.kode_barang as kode,barang.harga_barang as harga "
            . "FROM transaksi "
            . "JOIN item_transaksi ON item_transaksi.transaksi_id=transaksi.id_transaksi "
            . "JOIN barang ON item_transaksi.barang_id=barang.id_barang "
            . "WHERE tanggal_transaksi BETWEEN '$awal' AND '$akhir' "
            . "ORDER BY no_transaksi ASC ";
        $as = $this->db->query($query);
        return $as->result();
    }

    public function joinItemLaba($awal, $akhir)
    {
        $query = "SELECT *, barang.nama_barang as nama,barang.kode_barang as kode,barang.harga_barang as harga "
            . "FROM transaksi "
            . "JOIN item_transaksi ON item_transaksi.transaksi_id=transaksi.id_transaksi "
            . "JOIN barang ON item_transaksi.barang_id=barang.id_barang "
            . "WHERE tanggal_transaksi BETWEEN '$awal' AND '$akhir' "
            . " ORDER BY tanggal_transaksi ASC";
        $as = $this->db->query($query);
        return $as->result();
    }

    public function hitungTotal($awal, $akhir)
    {
        $query = "SELECT SUM(grand_total) as total,SUM(diskon) as diskon,SUM(total_hpp) as hpp_total FROM transaksi "
            . "JOIN item_transaksi ON item_transaksi.transaksi_id=transaksi.id_transaksi "
            . "WHERE tanggal_transaksi BETWEEN '$awal' AND '$akhir'";
        $as = $this->db->query($query);
        return $as->result();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_m extends CI_Model
{
    var $table = "transaksi_beli";
    var $primaryKey = "id_pembelian";

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
        $this->db->select('transaksi_beli.*,user.nama as nama_user, supplier.nama_supplier as supplier_nama')
            ->from('transaksi_beli')
            ->join('user', 'user.id_user = transaksi_beli.user_id')
            ->join('supplier', 'supplier.id_supplier = transaksi_beli.supplier_id')
            ->order_by('no_pembelian', 'desc');
        return $this->db->get()->result();
    }

    public function getJoin($id)
    {
        $this->db->select('item_beli.*, user.nama, supplier.nama_supplier, transaksi_beli.no_pembelian,
            transaksi_beli.tanggal, transaksi_beli.biaya')
            ->from('item_beli')
            ->join('transaksi_beli', 'transaksi_beli.id_pembelian = item_beli.transaksi_beli_id')
            ->join('supplier', 'supplier.id_supplier = transaksi_beli.supplier_id')
            ->join('user', 'user.id_user = transaksi_beli.user_id')
            ->where('item_beli.transaksi_beli_id', $id);
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

    public function joinPembelian($awal, $akhir)
    {
        $query = "SELECT *,user.nama FROM transaksi_beli JOIN user ON user.id_user = transaksi_beli.user_id "
            . "WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY id_pembelian ASC";
        $as = $this->db->query($query);
        return $as->result();
    }

    public function joinItem($awal, $akhir)
    {
        $query = "SELECT *, barang.nama_barang as nama,barang.kode_barang as kode,barang.harga_barang as harga "
            . "FROM transaksi_beli "
            . "JOIN item_beli ON item_beli.transaksi_beli_id=transaksi_beli.id_pembelian "
            . "JOIN barang ON item_beli.barang_id=barang.id_barang "
            . "WHERE tanggal BETWEEN '$awal' AND '$akhir' "
            . "ORDER BY id_pembelian ASC ";
        $as = $this->db->query($query);
        return $as->result();
    }
}

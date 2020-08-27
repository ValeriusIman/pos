<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
    public function hitungPendapatan()
    {
        $this->db->select('SUM(grand_total) AS total')
            ->from('transaksi')
            ->where('DATE(tanggal_transaksi) = DATE(NOW())');
        return $this->db->get()->row();
    }

    public function hitungPendapatanBulan()
    {
        $this->db->select('SUM(grand_total) AS total')
            ->from('transaksi')
            ->where('MONTH(tanggal_transaksi) = MONTH(NOW())');
        return $this->db->get()->row();
    }

    public function hitungPendapatanTahun()
    {
        $this->db->select('SUM(grand_total) AS total')
            ->from('transaksi')
            ->where('YEAR(tanggal_transaksi) = YEAR(NOW())');
        return $this->db->get()->row();
    }

    public function hitungSemua()
    {
        $this->db->select('SUM(grand_total) AS total')
            ->from('transaksi');
        return $this->db->get()->row();
    }

    public function produkTerlaris()
    {
        $this->db->select('barang_id , COUNT(barang_id) AS Total ,barang.nama_barang as barang')
            ->from('item_transaksi')
            ->join('barang', 'barang.id_barang = item_transaksi.barang_id')
            ->group_by('barang_id')
            ->order_by('Total', 'desc')
            ->limit(10);
        return $this->db->get()->result();
    }

    public function jumlahProdukTerlaris()
    {
        $this->db->select('barang_id , SUM(qty_item_transaksi) AS Total ,barang.nama_barang as barang')
            ->from('item_transaksi')
            ->join('barang', 'barang.id_barang = item_transaksi.barang_id')
            ->group_by('barang_id')
            ->order_by('Total', 'desc')
            ->limit(10);
        return $this->db->get()->result();
    }

    public function transaksiPerBulan()
    {
        $this->db->select('MONTH(tanggal_transaksi) AS bulan, COUNT(tanggal_transaksi) AS Total')
            ->from('transaksi')
            ->limit(12)
            ->group_by('bulan');
        return $this->db->get()->result();
    }

    public function stockIn()
    {
        $this->db->select('DATE_FORMAT(date, "%M") AS bulan, COUNT(type) AS Total')
            ->from('stock')
            ->where('type', 'In')
            ->group_by('bulan');
        return $this->db->get()->result();
    }

    public function stock()
    {
        $this->db->select('MONTH(date) AS bulan, COUNT(type) AS Total')
            ->from('stock')
            ->group_by('bulan', 'type');
        return $this->db->get()->result();
    }

    public function stockOut()
    {
        $this->db->select('DATE_FORMAT(date, "%M") AS Bulan, COUNT(type) AS total')
            ->from('stock')
            ->where('type', 'Out')
            ->group_by('bulan');
        return $this->db->get()->result();
    }

    public function pendapatan()
    {
        $this->db->select('SUM(grand_total) AS total,MONTH(tanggal_transaksi) AS Bulan')
            ->from('transaksi')
            ->group_by('bulan');
        return $this->db->get()->result();
    }

    public function pengeluaran()
    {
        $this->db->select('SUM(biaya) AS biaya,MONTH(tanggal) AS bln')
            ->from('transaksi_beli')
            ->group_by('bln');
        return $this->db->get()->result();
    }

    public function karyawan()
    {
        $this->db->select('*')
            ->from('user');
        return $this->db->get()->num_rows();
    }

    public function pelanggan()
    {
        $this->db->select('*')
            ->from('pelanggan')
            ->where('is_active', 1);
        return $this->db->get()->num_rows();
    }

    public function supplier()
    {
        $this->db->select('*')
            ->from('supplier')
            ->where('is_active', 1);
        return $this->db->get()->num_rows();
    }

    public function penjualan()
    {
        $this->db->where('DATE(tanggal_transaksi)=DATE(NOW())');
        return $this->db->get('transaksi')->num_rows();
    }

    public function pendapatanPeriode($awal, $akhir)
    {
        $query = "SELECT SUM(grand_total) AS total, tanggal_transaksi
        FROM transaksi 
        WHERE tanggal_transaksi BETWEEN '$awal' AND '$akhir' 
        GROUP BY tanggal_transaksi";
        $as = $this->db->query($query);
        return $as->result();
    }

    public function pengeluaranPeriode($awal, $akhir)
    {
        $query = "SELECT SUM(biaya) AS total, tanggal
        FROM transaksi_beli 
        WHERE tanggal BETWEEN '$awal' AND '$akhir' 
        GROUP BY tanggal";
        $as = $this->db->query($query);
        return $as->result();
    }
}

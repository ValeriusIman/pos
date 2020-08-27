<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_m extends CI_Model
{
    var $table = "barang";
    var $primaryKey = "id_barang";

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getAll()
    {
        $this->db->select('barang.*,jenis_barang.jenis_barang as kategori, satuan.satuan_barang as satuan')
            ->from('barang')
            ->join('jenis_barang', 'jenis_barang.id_jenis_barang = barang.jenis_barang_id')
            ->join('satuan', 'satuan.id_satuan = barang.satuan_id')
            ->where('barang.is_active', 1);
        return $this->db->get()->result();
    }

    public function getPrimaryKey($id)
    {
        $this->db->select('barang.*,jenis_barang.jenis_barang as kategori, satuan.satuan_barang as satuan')
            ->from('barang')
            ->join('jenis_barang', 'jenis_barang.id_jenis_barang = barang.jenis_barang_id')
            ->join('satuan', 'satuan.id_satuan = barang.satuan_id')
            ->where('barang.id_barang', $id);
        return $this->db->get()->row();
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, array("is_active" => 0));
    }

    public function restore($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, array("is_active" => 1));
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['barang_id'];
        $query = "UPDATE barang SET stock = stock + '$qty' WHERE id_barang = '$id'";
        $this->db->query($query);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['barang_id'];
        $query = "UPDATE barang SET stock = stock - '$qty' WHERE id_barang = '$id'";
        $this->db->query($query);
    }

    // Cari kode barcode scanner
    function get_data_barang_bykode($barcode_barang)
    {
        $hsl = $this->db->query("SELECT * FROM barang WHERE kode_barang='$barcode_barang' AND is_active='1'");
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'id_barang' => $data->id_barang,
                    'kode_barang' => $data->kode_barang,
                    'nama_barang' => $data->nama_barang,
                    'harga_barang' => $data->harga_barang,
                    'stock' => $data->stock,
                    'hpp' => $data->HPP,
                    'jenis_barang_id' => $data->jenis_barang_id,
                    'satuan_id' => $data->satuan_id,
                );
            }
        }
        return $hasil;
    }

    public function getHapus()
    {
        $this->db->select('barang.*,jenis_barang.jenis_barang as kategori, satuan.satuan_barang as satuan')
            ->from('barang')
            ->join('jenis_barang', 'jenis_barang.id_jenis_barang = barang.jenis_barang_id')
            ->join('satuan', 'satuan.id_satuan = barang.satuan_id')
            ->where('barang.is_active', 0);
        return $this->db->get()->result();
    }

    public function filter($filter)
    {
        if ($filter != 0) {
            $query = "SELECT *,jenis_barang.jenis_barang FROM barang JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.jenis_barang_id "
                . "WHERE barang.jenis_barang_id = '$filter' AND barang.is_active='1'";
            $as = $this->db->query($query);
            return $as->result();
        } else {
            $query = "SELECT *,jenis_barang.jenis_barang FROM barang JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.jenis_barang_id "
                . "WHERE barang.is_active='1'";
            $as = $this->db->query($query);
            return $as->result();
        }
    }
}

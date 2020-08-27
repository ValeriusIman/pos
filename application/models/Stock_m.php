<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_m extends CI_Model
{
    var $table = "stock";
    var $primaryKey = "id_stock";

    public function insertGetId($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insertBatch($data)
    {
        return $this->db->insert_batch("stock_item", $data);
    }

    public function insertBatchOut($data)
    {
        return $this->db->insert_batch("stock_out_item", $data);
    }

    public function getAllStockIn()
    {
        $this->db->select('stock.*, user.nama as user_nama')
            ->from('stock')
            ->join('user', 'user.id_user = stock.user_id')
            ->where('type = "In"')
            ->order_by('id_stock', 'desc');
        return $this->db->get()->result();
    }

    public function getAllStockOut()
    {
        $this->db->select('stock.*,user.nama as user_nama')
            ->from('stock')
            ->join('user', 'user.id_user = stock.user_id')
            ->where('type = "out"')
            ->order_by('id_stock', 'desc');
        return $this->db->get()->result();
    }

    public function getJoinStockIn($id)
    {
        $this->db->select('stock.*,user.nama')
            ->from('stock')
            ->join('user', 'user.id_user=stock.user_id')
            ->where('id_stock', $id);
        return $this->db->get()->row();
    }

    public function getJoinStockInItem($id)
    {
        $this->db->select('stock_item.*,barang.nama_barang,barang.kode_barang,supplier.nama_supplier')
            ->from('stock_item')
            ->join('supplier', 'supplier.id_supplier=stock_item.supplier_id')
            ->join('barang', 'barang.id_barang=stock_item.barang_id')
            ->where('stock_item.stock_id', $id);
        return $this->db->get()->result();
    }

    public function getJoinStockOut($id)
    {
        $this->db->select('stock_out_item.*,barang.nama_barang,barang.kode_barang,supplier.nama_supplier')
            ->from('stock_out_item')
            ->join('supplier', 'supplier.id_supplier=stock_out_item.supplier_id')
            ->join('barang', 'barang.id_barang=stock_out_item.barang_id')
            ->where('stock_out_item.stock_id', $id);
        return $this->db->get()->result();
    }

    public function stockMinimum()
    {
        $this->db->where('stock <= "100"');
        return $this->db->get('barang');
    }

    function get_stock($id)
    {
        $hsl = $this->db->query("SELECT * FROM barang WHERE id_barang='$id' AND is_active='1'");
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
}

<?php


class ItemPembelian_m extends CI_Model
{
    var $table = "item_beli";
    var $primaryKey = "id_item_beli";

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function insertBatch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getAll($id)
    {

        $this->db->select('item_transaksi.*')
            ->from('item_transaksi')
            ->where('item_transaksi.transaksi_id', $id);
        return $this->db->get()->result();
        // return $this->db->get($this->table)->result();
    }

    public function getByPrimaryKey($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row();
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    // delete data
    public function delete($id)
    {
        //hanya mengupdate is_active dari 1 menjadi 0
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, array("is_active" => 0));
    }

    public function joinLengkap($id)
    {
        $this->db->select('item_beli.*,barang.kode_barang as kode, barang.nama_barang as nama,
            satuan.satuan_barang as satuan')
            ->from('item_beli')
            ->join('barang', 'barang.id_barang = item_beli.barang_id')
            ->join('satuan', 'satuan.id_satuan = item_beli.satuan_id')
            ->where('item_beli.transaksi_beli_id', $id);
        return $this->db->get()->result();
    }
}

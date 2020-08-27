<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    var $table = "user";
    var $primaryKey = "id_user";
    var $email = "email";

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getAll()
    {
        return $this->db->get($this->table);
    }

    public function getPrimaryKey($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row();
    }

    public function getEmail($id)
    {
        $this->db->where($this->email, $id);
        return $this->db->get($this->table)->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }
    public function updateProfil($id, $data)
    {
        $this->db->where($this->email, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->delete($this->table);
    }
}

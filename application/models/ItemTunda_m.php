<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ItemTunda_m extends CI_Model
{
    function insertBatchTunda($params)
    {
        $this->db->insert_batch('item_tunda', $params);
    }

    public function delete_tundaitemtransaksi($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        return $this->db->delete('item_tunda');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_reject_model extends MY_Model
{
    protected $table = 'prod_reject';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function insert_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }
}

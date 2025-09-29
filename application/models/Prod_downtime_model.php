<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_downtime_model extends MY_Model
{
    protected $table = 'prod_downtime';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function insert_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }
}

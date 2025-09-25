<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_downtimes_model extends MY_Model
{
    protected $table = 'jenis_downtimes';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
    public function get_dropdown()
    {
        $result = $this->db->order_by("nama", "ASC")->get($this->table)->result();
        $dropdown = [];
        foreach ($result as $row) {
            $dropdown[$row->id] = $row->nama;
        }
        return $dropdown;
    }
}

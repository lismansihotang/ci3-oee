<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_qc_model extends MY_Model
{
    protected $table = 'jenis_qc';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

       public function get_by_mesin($kd_ms)
    {
        $this->db->where('kd_ms', $kd_ms);
        $this->db->order_by('id', 'ASC');
        return $this->db->get('jenis_qc')->result();
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Spk_model extends MY_Model
{
    protected $table = 'spk';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function insert($data)
    {
        if (empty($this->table) || empty($data)) {
            return false;
        }
        if ($this->session->userdata('user_id')) {
            $data['created_by'] = $this->session->userdata('user_id');
        }

        $arrDate = ['tgl_mulai','tgl_selesai','tgl_mulai2','tgl_selesai2'];
        foreach ($data as $key => $val) {
            if (in_array($key, $arrDate) === true && $val === '') {
                $data[$key] = null;
            }
        }
        return $this->db->insert($this->table, $data);
    }
}

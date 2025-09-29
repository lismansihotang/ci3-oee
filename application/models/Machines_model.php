<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Machines_model extends MY_Model
{
    protected $table = 'machines';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function get_dropdown()
    {
        $result = $this->db->select('id, kode_mesin, nama_mesin')
            ->from('machines')
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $dropdown = ['' => '-- Pilih Mesin --'];
        foreach ($result as $row) {
            // tampilkan kode mesin + nama mesin
            $dropdown[$row->id] = $row->kode_mesin . ' - ' . $row->nama_mesin;
        }
        return $dropdown;
    }
}

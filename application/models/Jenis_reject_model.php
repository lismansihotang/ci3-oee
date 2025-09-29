<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_reject_model extends MY_Model
{
    protected $table = 'jenis_reject';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function get_dropdown()
    {
        $result = $this->db->select('id, kd_reject, nama_reject')
            ->from('jenis_reject')
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $dropdown = ['' => '-- Pilih Jenis Reject --'];
        foreach ($result as $row) {
            // tampilkan kode mesin + nama mesin
            $dropdown[$row->id] = '[' . $row->kd_reject . '] - ' . $row->nama_reject;
        }
        return $dropdown;
    }
}

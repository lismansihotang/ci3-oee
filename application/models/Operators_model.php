<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Operators_model extends MY_Model
{
    protected $table = 'operators';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = ['user_id', 'nama', 'no_induk'];

    public function checkUser($username, $password)
    {
        $this->db->where('user_id', $username);
        $this->db->where('password', $password);
        $query = $this->db->get($this->table);

        var_dump($this->db->last_query());
        return $query->row();
    }

     public function get_dropdown()
{
    $result = $this->db->select('id, user_id, nama,jabatan, divisi')
                       ->from('operators')
                       ->order_by('id', 'DESC')
                       ->get()
                       ->result();

    $dropdown = ['' => '-- Pilih Operators --'];
    foreach ($result as $row) {
        // tampilkan kode mesin + nama mesin
        $dropdown[$row->id] = $row->id . ' - ' . $row->nama;
    }
    return $dropdown;
}
}

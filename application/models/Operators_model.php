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

        return $query->row();
    }

     public function get_dropdown()
{
    $result = $this->db->select('id, user_id, nama, jabatan, divisi')
                       ->from('operators')
                       ->like('jabatan', 'leader', 'both') // ✅ tampilkan semua yang mengandung "leader"
                       ->order_by('nama', 'ASC')
                       ->get()
                       ->result();

    $dropdown = ['' => '-- Pilih Leader / Ass.Leader --'];
    foreach ($result as $row) {
        $dropdown[$row->id] = $row->nama . ' [' . $row->jabatan.']';
    }
    return $dropdown;
}

}

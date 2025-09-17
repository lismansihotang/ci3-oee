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
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers_model extends MY_Model
{
    protected $table = 'customers';

    // Tentukan kolom mana saja yang bisa dicari
    protected $searchable_columns = ['kd_cust', 'nm_cust', 'kota', 'telepon'];

    /**
     * List Data Customers untuk select.
     * @return object|null Objek data produk jika ditemukan, atau null jika tidak.
     */
    public function get_all_for_select()
    {
        $this->db->select('kd_cust, nm_cust');
        $this->db->where('kd_cust IS NOT NULL');
        $this->db->where('kd_cust !=', '');
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where('is_deleted', 0);
        }
        return $this->db->get($this->table)->result();
    }

    /**
     * Mengambil satu customer berdasarkan kode customer.
     * @param string $code Kode customer yang dicari.
     * @return object|null Objek data customer jika ditemukan, atau null jika tidak.
     */
    public function get_by_code($code)
    {
        $this->db->where('kd_cust', $code);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}

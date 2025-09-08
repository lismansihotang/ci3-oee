<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends MY_Model
{
    protected $table = 'products';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function get_all_for_select()
    {
        $this->db->select('kd_produk, nama_produk');
        $this->db->where('kd_produk IS NOT NULL');
        $this->db->where('kd_produk !=', '');
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where('is_deleted', 0);
        }
        return $this->db->get($this->table)->result();
    }

    /**
     * Mengambil satu produk berdasarkan kode produk.
     * @param string $product_code Kode produk yang dicari.
     * @return object|null Objek data produk jika ditemukan, atau null jika tidak.
     */
    public function get_by_code($product_code)
    {
        $this->db->where('kd_produk', $product_code);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}

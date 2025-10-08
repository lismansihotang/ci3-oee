<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends MY_Model
{
    protected $table = 'products';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];

    public function get_defects_with_standard($kd_produk)
{
    $product = $this->db->where('kd_produk', $kd_produk)->get('products')->row_array();
    if (!$product) return [];

    $defects = [];
    foreach ($product as $field => $value) {
        if (strpos($field, 'qc_') === 0) {
            $label = str_replace('qc_', '', $field);
            $label = ucwords(str_replace('_', ' ', $label)); // rapikan label

            $defects[] = [
                'field'    => $field,
                'label'    => $label,
                'standard' => $value
            ];
        }
    }
    return $defects;
}


public function get_dropdown()
{
    $result = $this->db->select('id, nama_produk, kd_produk')
                       ->from('products')
                       ->order_by('id', 'DESC')
                       ->get()
                       ->result();

    $dropdown = ['' => '-- Pilih Products --'];
    foreach ($result as $row) {
        $dropdown[$row->id] = $row->id . ' - ' . $row->nama_produk. ' - ' .$row->kd_produk;
    }
    return $dropdown;
}

  public function get_all_for_select()
    {
        return $this->db->select('id, nama_produk, kd_produk')
            ->from($this->table)
            ->order_by('id', 'ASC')
            ->get()
            ->result();
    }
}

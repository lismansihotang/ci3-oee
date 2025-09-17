<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_orders_model extends MY_Model
{
    // Tentukan tabel
    protected $table = 'purchase_orders';
    // Tentukan kolom untuk pencarian
    protected $searchable_columns = ['no_po'];
    // Tentukan tabel detail
    protected $detail_table = 'purchase_order_details';
    // Tentukan kolom foreign key
    protected $foreign_key = 'id_po';

     public function get_all_for_select()
    {
        return $this->db->select('id, no_po')
                        ->from($this->table)
                        ->order_by('no_po', 'ASC')
                        ->get()
                        ->result();
    }
   public function get_dropdown()
{
    $result = $this->db->select('po.id, po.no_po, GROUP_CONCAT(DISTINCT p.nama_produk SEPARATOR ", ") as produk')
                       ->from('purchase_orders po')
                       ->join('purchase_order_details pod', 'pod.id_po = po.id', 'inner')
                       ->join('products p', 'p.kd_produk = pod.kd_product', 'left')
                       ->where('YEAR(po.tgl_kirim)', 2024) // filter hanya tahun 2025
                       ->group_by('po.id, po.no_po')
                       ->order_by('po.id', 'DESC')
                       ->get()
                       ->result();

    $dropdown = ['' => '-- Pilih PO --'];
    foreach ($result as $row) {
        // tampilkan nomor PO + nama produk (kalau ada)
        $dropdown[$row->id] = $row->no_po . (!empty($row->produk) ? " - " . $row->produk : '');
    }
    return $dropdown;
}
public function get_detail_by_po($id_po)
{
    return $this->db->select('pod.id_po,pod.kd_product,p.kd_produk, p.nama_produk, p.cavity, p.ct, p.ct_print, p.ct_stamp, p.no_mould')
                    ->from('purchase_order_details pod')
                    ->join('products p', 'p.kd_produk = pod.kd_product', 'left')
                    ->join('purchase_orders po', 'po.id = pod.id_po', 'inner')
                    ->where('pod.id_po', $id_po)
                    ->get()
                    ->row();
}




}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_detail_model extends MY_Model
{
    protected $table = 'prod_detail';

    // Tentukan kolom untuk pencarian
    protected $joins = [
        [
            'table' => 'prod_utama',
            'condition' => 'prod_utama.id = prod_detail.prod_id',
            'type' => 'left'
        ],
         [
            'table' => 'spk',
            'condition' => 'spk.id = prod_utama.no_spk',
            'type' => 'left'
         ],
         [
            'table' => 'prod_reject',
            'condition' => 'prod_reject.prod_detail_id = prod_detail.id',
            'type' => 'left'
         ]
    ];

    protected $select_fields = '
        prod_detail.*,
        spk.no_spk,
        spk.tday AS tday,
        COALESCE(prod_reject.qty, 0) AS reject_qty
    ';

    protected $searchable_columns = [
        'prod_detail.*',
        'spk.no_spk',
        'spk.tday',
        'prod_reject.qty'
    ];

    public function get_with_reject($where = [])
{
    $this->db->select("
        prod_detail.*,
        COALESCE(prod_reject.qty, 0) AS reject_qty
    ");
    $this->db->from($this->table);

    foreach ($this->joins as $join) {
        $this->db->join($join['table'], $join['condition'], $join['type']);
    }

    if (!empty($where)) {
        $this->db->where($where);
    }

    return $this->db->get()->result();
}


}

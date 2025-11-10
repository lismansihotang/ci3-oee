<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prod_utama_model extends MY_Model
{
    protected $table = 'prod_utama';

    protected $joins = [
        [
            'table' => 'products',
            'condition' => 'products.kd_produk = prod_utama.kd_prod',
            'type' => 'left'
        ],
        [
            'table' => 'machines',
            'condition' => 'machines.id = prod_utama.kd_ms',
            'type' => 'left'
        ],
        [
            'table' => 'operators',
            'condition' => 'operators.id = prod_utama.operators_id',
            'type' => 'left'
        ],
         [
            'table' => 'spk',
            'condition' => 'spk.id = prod_utama.no_spk',
            'type' => 'left'
         ]
    ];

    protected $select_fields = '
        prod_utama.*,
        products.nama_produk,
        machines.nama_mesin,
        machines.kode_mesin,
        operators.nama,
        spk.no_spk,
        spk.tday AS tday
    ';

    protected $searchable_columns = [
        'prod_utama.*',
        'products.nama_produk',
        'machines.nama_mesin',
        'machines.kode_mesin',
        'operators.nama',
        'spk.no_spk',
        'spk.tday'
    ];

    
}

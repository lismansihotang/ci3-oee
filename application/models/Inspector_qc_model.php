<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspector_qc_model extends MY_Model
{
    protected $table = 'inspector_qc';

    // Tentukan kolom untuk pencarian
     protected $joins = [
        [
            'table' => 'machines',
            'condition' => 'machines.id = inspector_qc.machines_id',
            'type' => 'left'
        ]
    ];

    protected $select_fields = '
        inspector_qc.*,
        machines.nama_mesin,
        machines.kode_mesin
    ';

    protected $searchable_columns = [
        'inspector_qc.*',
        'machines.nama_mesin',
        'machines.kode_mesin'
    ];
}

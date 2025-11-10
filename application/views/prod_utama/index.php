<?= card_open('<i class="icon cil-list"></i> List of Prod_utama') ?>
    <?= build_index_header('prod_utama', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
            //'id' => 'Id',
            'tanggal' => 'Tanggal',
            'nama_produk' => 'Produk',
            'nama_mesin' => 'Mesin',
            'no_spk' => 'No.SPK',
            'tday' => 'T/Day',
            'jml_pass' => 'Pass',
            'jml_hold' => 'Hold',
            'nama' => 'Operator',
            'persen_pass' => '%Pass',
            'persen_reject' => '%Reject',
            'persen_down' => '%Down',
             'sh' => 'Shift',
            /**'jam' => 'Jam',
            'per_rb' => 'Per_rb',
            'per_bw' => 'Per_bw',
            'per_rs' => 'Per_rs',
            'per_rc' => 'Per_rc',
            'per_ra' => 'Per_ra',
            'per_rl' => 'Per_rl',
            'is_deleted' => 'Is_deleted',
            'created_by' => 'Created_by',
            'updated_by' => 'Updated_by',
            'deleted_by' => 'Deleted_by',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at',
            'deleted_at' => 'Deleted_at', */
        ),
        'rows' => $rows,
        'actions' => [
            'view' => 'prod_utama/view',
            'edit' => 'prod_utama/edit',
            'delete' => 'prod_utama/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
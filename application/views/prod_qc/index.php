<?= card_open('<i class="icon cil-list"></i> List of Prod_qc') ?>
    <?= build_index_header('prod_qc', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
            //'id' => 'Id',
            'prod_id' => 'Product',
            //'kd_jenis_qc' => 'Kd_jenis_qc',
            'kd_ms' => 'Mesin',
            'tanggal' => 'Tanggal',
            /**'is_deleted' => 'Is_deleted',
            'created_by' => 'Created_by',
            'updated_by' => 'Updated_by',
            'deleted_by' => 'Deleted_by',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at', */
        ),
        'rows' => $rows,
        'actions' => [
            'view' => [
                'url'   => 'prod_qc/details/{prod_id}/{kd_ms}/{tanggal}',
                'title' => 'Lihat Detail',
                'icon'  => 'cil-magnifying-glass',
                'class' => 'btn-primary',
            ],
            'edit' => 'prod_qc/edit',
            'delete' => 'prod_qc/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
<?= card_open('<i class="icon cil-list"></i> List of Jenis_downtimes') ?>
    <?= build_index_header('jenis_downtimes', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
            //'id' => 'Id',
            'kode' => 'Kode',
            'nama' => 'Nama',
            /**'is_deleted' => 'Is_deleted',
            'created_by' => 'Created_by',
            'updated_by' => 'Updated_by',
            'deleted_by' => 'Deleted_by',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at',
            'deleted_at' => 'Deleted_at', */
        ),
        'rows' => $rows,
        'actions' => [
            'view' => 'jenis_downtimes/view',
            'edit' => 'jenis_downtimes/edit',
            'delete' => 'jenis_downtimes/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
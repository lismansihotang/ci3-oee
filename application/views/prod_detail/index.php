<?= card_open('<i class="icon cil-list"></i> List of Prod_detail') ?>
    <?= build_index_header('prod_detail', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'shift_id' => 'Shift_id',
  'jam_mulai' => 'Jam_mulai',
  'jam_selesai' => 'Jam_selesai',
  'pass_qty' => 'Pass_qty',
  'finish_qty' => 'Finish_qty',
  'is_deleted' => 'Is_deleted',
  'created_by' => 'Created_by',
  'updated_by' => 'Updated_by',
  'deleted_by' => 'Deleted_by',
  'created_at' => 'Created_at',
  'updated_at' => 'Updated_at',
  'deleted_at' => 'Deleted_at',
),
        'rows' => $rows,
        'actions' => [
            'view' => 'prod_detail/view',
            'edit' => 'prod_detail/edit',
            'delete' => 'prod_detail/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
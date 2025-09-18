<?= card_open('<i class="icon cil-list"></i> List of Prod_shift_log') ?>
    <?= build_index_header('prod_shift_log', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'kd_ms' => 'Kd_ms',
  'tanggal' => 'Tanggal',
  'shift_no' => 'Shift_no',
  'leader_id' => 'Leader_id',
  'status' => 'Status',
  'total_pass' => 'Total_pass',
  'total_reject' => 'Total_reject',
  'total_hold' => 'Total_hold',
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
            'view' => 'prod_shift_log/view',
            'edit' => 'prod_shift_log/edit',
            'delete' => 'prod_shift_log/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
<?= card_open('<i class="icon cil-list"></i> List of Prod_downtime') ?>
    <?= build_index_header('prod_downtime', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'shift_id' => 'Shift_id',
  'downtime_id' => 'Downtime_id',
  'start_time' => 'Start_time',
  'end_time' => 'End_time',
  'duration_min' => 'Duration_min',
  'notes' => 'Notes',
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
            'view' => 'prod_downtime/view',
            'edit' => 'prod_downtime/edit',
            'delete' => 'prod_downtime/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
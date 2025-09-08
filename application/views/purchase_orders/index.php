<?= card_open('<i class="icon cil-list"></i> List of Purchase_orders') ?>
    <?= build_index_header('purchase_orders', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
  //'id' => 'Id',
  'no_po' => 'No_po',
  'tgl_po' => 'Tgl_po',
  'tgl_kirim' => 'Tgl_kirim',
  'kd_cust' => 'Kd_cust',
  'nm_cust' => 'Nm_cust',
  /**'ket' => 'Ket',
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
            'view' => 'purchase_orders/view',
            'edit' => 'purchase_orders/edit',
            'delete' => 'purchase_orders/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
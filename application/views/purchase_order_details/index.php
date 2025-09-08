<?= card_open('<i class="icon cil-list"></i> List of Purchase_order_details') ?>
    <?= build_index_header('purchase_order_details', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'id_po' => 'Id_po',
  'no' => 'No',
  'kd_product' => 'Kd_product',
  'nm_product' => 'Nm_product',
  'qty' => 'Qty',
  'harga' => 'Harga',
  'subtotal' => 'Subtotal',
  'total' => 'Total',
  'kiriman_akhir' => 'Kiriman_akhir',
  'qty_kirim' => 'Qty_kirim',
  'sisa_order' => 'Sisa_order',
  'status' => 'Status',
  'jml_kirim' => 'Jml_kirim',
  'jml_retur' => 'Jml_retur',
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
            'view' => 'purchase_order_details/view',
            'edit' => 'purchase_order_details/edit',
            'delete' => 'purchase_order_details/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
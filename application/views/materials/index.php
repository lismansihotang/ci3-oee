<?= card_open('<i class="icon cil-list"></i> List of Materials') ?>
    <?= build_index_header('materials', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'kode' => 'Kode',
  'nama' => 'Nama',
  'qty' => 'Qty',
  'jenis' => 'Jenis',
  'lokasi_1' => 'Lokasi_1',
  'lokasi_2' => 'Lokasi_2',
  'keterangan' => 'Keterangan',
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
            'view' => 'materials/view',
            'edit' => 'materials/edit',
            'delete' => 'materials/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
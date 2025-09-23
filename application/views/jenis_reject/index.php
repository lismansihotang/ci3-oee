<?= card_open('<i class="icon cil-list"></i> List of Jenis_reject') ?>
    <?= build_index_header('jenis_reject', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (

//   'id' => 'Id',
  'kd_reject' => 'Kode',
  'nama_reject' => 'Nama',
  'jenis_machines' => 'Jenis Machines',
//   'is_deleted' => 'Is_deleted',
//   'created_by' => 'Created_by',
//   'updated_by' => 'Updated_by',
//   'deleted_by' => 'Deleted_by',
//   'created_at' => 'Created_at',
//   'updated_at' => 'Updated_at',
//   'deleted_at' => 'Deleted_at',

),
        'rows' => $rows,
        'actions' => [
            'view' => 'jenis_reject/view',
            'edit' => 'jenis_reject/edit',
            'delete' => 'jenis_reject/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
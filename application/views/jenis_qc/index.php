<?= card_open('<i class="icon cil-list"></i> List of Jenis_qc') ?>
    <?= build_index_header('jenis_qc', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'kd_qc' => 'Kd_qc',
  'kd_ms' => 'Kd_ms',
  'nama_qc' => 'Nama_qc',
  'satuan' => 'Satuan',
),
        'rows' => $rows,
        'actions' => [
            'view' => 'jenis_qc/view',
            'edit' => 'jenis_qc/edit',
            'delete' => 'jenis_qc/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
<?= card_open('<i class="icon cil-list"></i> List of Inspector_qc') ?>
    <?= build_index_header('inspector_qc', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'tanggal' => 'Tanggal',
  'machines_id' => 'Machines',
  'shift' => 'Shift',
  'phase' => 'Phase',
  'problem' => 'Problem',
  'problem_description' => 'Problem Description',
  'report_time' => 'Report Time',
//   'handle_time' => 'Handle Time',
//   'end_time' => 'End Time',
//   'operator_id' => 'Operators',
//   'solution_descrtiption' => 'Solution_descrtiption',
//   'status_problem' => 'Status_problem',
//   'status_produk' => 'Status_produk',
),
        'rows' => $rows,
        'actions' => [
            'view' => 'inspector_qc/view',
            'edit' => 'inspector_qc/edit',
            'delete' => 'inspector_qc/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
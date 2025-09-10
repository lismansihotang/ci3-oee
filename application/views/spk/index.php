<?= card_open('<i class="icon cil-list"></i> List of Spk') ?>
    <?= build_index_header('spk', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
  //'id' => 'Id',
  'no_spk' => 'No_spk',
  'kd_machine' => 'Kd_machine',
  'kd_product' => 'Kd_product',
  /**'cavity' => 'Cavity',
  'ct' => 'Ct',
  'tgl_mulai' => 'Tgl_mulai',
  'tgl_selesai' => 'Tgl_selesai',
  'no_mould' => 'No_mould',
  'no_po' => 'No_po',
  'jml_ord' => 'Jml_ord',
  'keterangan' => 'Keterangan',
  'tjam' => 'Tjam',
  'tshift' => 'Tshift',
  'tday' => 'Tday',
  'ct_print' => 'Ct_print',
  'ct_stamp' => 'Ct_stamp',
  'print_jam' => 'Print_jam',
  'print_shift' => 'Print_shift',
  'print_day' => 'Print_day',
  'stamp_jam' => 'Stamp_jam',
  'stamp_shift' => 'Stamp_shift',
  'stamp_day' => 'Stamp_day',
  'status' => 'Status',
  'sub' => 'Sub',
  'no' => 'No',
  'jumlah_jam' => 'Jumlah_jam',
  'tgl_mulai2' => 'Tgl_mulai2',
  'tgl_selesai2' => 'Tgl_selesai2',
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
            'view' => 'spk/view',
            'edit' => 'spk/edit',
            'delete' => 'spk/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
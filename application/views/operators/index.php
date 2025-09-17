<?= card_open('<i class="icon cil-list"></i> List of Operators') ?>
    <?= build_index_header('operators', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
  //'id' => 'Id',
  'user_id' => 'User_id',
  'nama' => 'Nama',
  'no_induk' => 'No_induk',
  //'password' => 'Password',
  'jabatan' => 'Jabatan',
  'divisi' => 'Divisi',
  /**'akses' => 'Akses',
  'grup' => 'Grup',
  'urutan' => 'Urutan',
  'tgl_keluar' => 'Tgl_keluar',
  'alasan' => 'Alasan',
  'alamat_asal' => 'Alamat_asal',
  'alamat_sekarang' => 'Alamat_sekarang',
  'nik' => 'Nik',
  'phone' => 'Phone',
  'tempat_lahir' => 'Tempat_lahir',
  'tgl_lahir' => 'Tgl_lahir',
  'pendidikan' => 'Pendidikan',
  'alumnus' => 'Alumnus',
  'tgl_masuk' => 'Tgl_masuk',
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
            'view' => 'operators/view',
            'edit' => 'operators/edit',
            'delete' => 'operators/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
<?= card_open('<i class="icon cil-list"></i> List of Machines') ?>
    <?= build_index_header('machines', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'ID',
  'kode_mesin' => 'KODE',
  'nama_mesin' => 'NAMA',
  'jenis_mesin' => 'JENIS',
//   'urutan' => 'URUTAN',
//   'jenis' => 'Jenis',
//   'manufacturer' => 'MANUFACTURER',
//   'kapasitas_kontainer' => 'Kapasitas_kontainer',
//   'screw_speed' => 'Screw_speed',
//   'hp' => 'Hp',
//   'max_mold' => 'Max_mold',
//   'min_mold' => 'Min_mold',
//   'max_diameter_single_head' => 'Max_diameter_single_head',
//   'tinggi_mesin' => 'Tinggi_mesin',
//   'lebar_mesin' => 'Lebar_mesin',
//   'panjang_mesin' => 'Panjang_mesin',
//   'berat_mesin' => 'Berat_mesin',
//   'rate' => 'Rate',
//   'operator' => 'Operator',
//   'listrik' => 'Listrik',
//   'depresiasi' => 'Depresiasi',
//   'foh_lain' => 'Foh_lain',
//   'indirect_labour' => 'Indirect_labour',
//   'direct_labour' => 'Direct_labour',
//   'general_adm' => 'General_adm',
//   'marketing' => 'Marketing',
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
            'view' => 'machines/view',
            'edit' => 'machines/edit',
            'delete' => 'machines/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
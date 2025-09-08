<?= card_open('<i class="icon cil-list"></i> List of Users') ?>
    <?= build_index_header('users', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array (
  'id' => 'Id',
  'username' => 'Username',
  'password' => 'Password',
  'email' => 'Email',
  'created_at' => 'Created_at',
  'updated_by' => 'Updated_by',
  'updated_at' => 'Updated_at',
),
        'rows' => $rows,
        'actions' => [
            'view' => 'users/view',
            'edit' => 'users/edit',
            'delete' => 'users/delete'
        ]
    ],$offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
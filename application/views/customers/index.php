<?= card_open('<i class="icon cil-list"></i> List of Customers') ?>
<?= build_index_header('customers', [
    'search_term' => $search_term,
    'total_rows' => $total_rows,
    'from_rows' => $from_rows,
    'to_rows' => $to_rows,
]) ?>
<?= build_table([
    'headers' => array(
        //'id' => 'Id',
        'kd_cust' => 'Kode Customers',
        'nm_cust' => 'Nama Customers',
        //'alamat1' => 'Alamat1',
        //'alamat2' => 'Alamat2',
        'kota' => 'Kota',
        'telepon' => 'Telepon',
        /**'is_deleted' => 'Is_deleted',
        'created_by' => 'Created_by',
        'updated_by' => 'Updated_by',
        'deleted_by' => 'Deleted_by',
        'created_at' => 'Created_at',
        'updated_at' => 'Updated_at',
        'deleted_at' => 'Deleted_at', */
    ),
    'rows' => $rows,
    'actions' => [
        'view' => 'customers/view',
        'edit' => 'customers/edit',
        'delete' => 'customers/delete'
    ]
], $offset) ?>
<?= $pagination ?>
<?= card_close() ?>
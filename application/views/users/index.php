<?= card_open('<i class="icon cil-list"></i> List of Users') ?>
<div class="mb-3">
    <div class="btn-group" role="group" aria-label="HomeAdd">
        <a href="<?= site_url('users/create') ?>" class="btn btn-primary btn-sm" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Tambah Data Baru"><i class="icon cil-plus"></i> Tambah Data</a>
        <a href="<?= site_url('/') ?>" class="btn btn-outline-primary btn-sm" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
    </div>
</div>
<?= build_table([
    'headers' => array(
        0 => 'Id',
        1 => 'Username',
        2 => 'Password',
        3 => 'Email',
        4 => 'Created_at',
    ),
    'rows' => $rows,
    'actions' => [
        'view' => 'users/view',
        'edit' => 'users/edit',
        'delete' => 'users/delete'
    ]
]) ?>
<?= $pagination ?>
<?= card_close() ?>
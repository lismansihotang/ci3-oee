<?= card_open('<i class="icon cil-list"></i> List of Materials') ?>
<div class="mb-3">
    <div class="btn-group" role="group" aria-label="HomeAdd">
        <a href="<?= site_url('materials/create') ?>" class="btn btn-primary btn-sm" data-coreui-placement="top" title="Tambah Data Baru"><i class="icon cil-plus"></i> Tambah Data</a>
        <a href="<?= site_url('/') ?>" class="btn btn-outline-primary btn-sm" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
    </div>
</div>
<?= build_table([
    'headers' => array(
        //0 => 'Id',
        1 => 'Kode',
        2 => 'Nama',
        3 => 'Qty',
        4 => 'Jenis',
        /**5 => 'Lokasi_1',
        6 => 'Lokasi_2',
        7 => 'Keterangan',
        8 => 'Is_deleted',
        9 => 'Created_by',
        10 => 'Updated_by',
        11 => 'Deleted_by',
        12 => 'Created_at',
        13 => 'Updated_at',
        14 => 'Deleted_at',**/
    ),
    'rows' => $rows,
    'actions' => [
        'view' => 'materials/view',
        'edit' => 'materials/edit',
        'delete' => 'materials/delete'
    ]
]) ?>
<?= $pagination ?>
<?= card_close() ?>
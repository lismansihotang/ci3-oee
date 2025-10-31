<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Materials') ?>

<div class="row">
    <div class="col-8">
        <h5 class="mt-2">Informasi Material</h5>
    </div>
    <div class="col-4 text-end">
        <div class="mb-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <a href="<?= site_url('materials/edit/'.$row->id) ?>" 
                   class="btn btn-warning" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="Edit Data Ini">
                   <i class="icon cil-pencil"></i> Edit
                </a>
                <a href="<?= site_url('materials/delete/'.$row->id) ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Hapus data ini?')" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="Hapus Data Ini">
                   <i class="icon cil-trash"></i> Delete
                </a>
                <a href="<?= site_url('materials') ?>" 
                   class="btn btn-secondary" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="< Kembali ke List Data">
                   <i class="icon cil-reload"></i> Kembali
                </a>
                <a href="<?= site_url('/') ?>" 
                   class="btn btn-outline-dark" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="< Kembali ke Halaman Utama">
                   <i class="icon cil-home"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered table-hover border">
    <tr>
        <th>ID</th>
        <td><span class="badge rounded-pill bg-dark">#<?= $row->id ?></span></td>
    </tr>
    <tr>
        <th>KODE</th>
        <td><button class="btn btn-outline-dark"><?= $row->kode ?></button></td>
    </tr>
    <tr>
        <th>NAMA</th>
        <td><a href="#" class="btn btn-success"><?= $row->nama ?></a></td>
    </tr>
    <tr>
        <th>QTY</th>
        <td><span class="badge bg-primary"><?= number_format($row->qty, 0) ?></span></td>
    </tr>
    <tr>
        <th>JENIS</th>
        <td>
            <span class="badge bg-<?= ($row->jenis == 'Raw Material') ? 'info' : 'secondary' ?>">
                <?= ucfirst($row->jenis) ?>
            </span>
        </td>
    </tr>
    <tr>
        <th>LOKASI 1</th>
        <td><?= $row->lokasi_1 ?: '-' ?></td>
    </tr>
    <tr>
        <th>LOKASI 2</th>
        <td><?= $row->lokasi_2 ?: '-' ?></td>
    </tr>
    <tr>
        <th>KETERANGAN</th>
        <td><?= $row->keterangan ?: '-' ?></td>
    </tr>
</table>

<div class="row mt-3">
    <div class="col-12"><strong>Informasi Data</strong></div>
    <div class="col-4">
        <?= generate_card_info(indo_date($row->created_at, true).' > Created By', $row->created_by, 'primary'); ?>
    </div>
    <div class="col-4">
        <?= generate_card_info(indo_date($row->updated_at, true).' > Updated By', $row->updated_by); ?>
    </div>   
</div>

<?= card_close() ?>

<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Inspector QC') ?>

<div class="row">
    <div class="col-8">
        <h5 class="mt-2">Informasi Pemeriksaan QC</h5>
    </div>
    <div class="col-4 text-end">
        <div class="mb-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <a href="<?= site_url('inspector_qc/edit/'.$row->id) ?>" 
                   class="btn btn-warning" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="Edit Data Ini">
                   <i class="icon cil-pencil"></i> Edit
                </a>
                <a href="<?= site_url('inspector_qc/delete/'.$row->id) ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Hapus data ini?')" 
                   data-coreui-toggle="tooltip" 
                   data-coreui-placement="top" 
                   title="Hapus Data Ini">
                   <i class="icon cil-trash"></i> Delete
                </a>
                <a href="<?= site_url('inspector_qc') ?>" 
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
        <th>TANGGAL</th>
        <td><button class="btn btn-outline-dark"><?= indo_date($row->tanggal, true) ?></button></td>
    </tr>
    <tr>
        <th>MESIN</th>
        <td><?= $row->machines_id ?></td>
    </tr>
    <tr>
        <th>SHIFT</th>
        <td><?= $row->shift ?></td>
    </tr>
    <tr>
        <th>PHASE</th>
        <td><?= $row->phase ?></td>
    </tr>
    <tr>
        <th>PROBLEM</th>
        <td><?= $row->problem ?></td>
    </tr>
    <tr>
        <th>DESKRIPSI PROBLEM</th>
        <td><?= $row->problem_description ?></td>
    </tr>
    <tr>
        <th>WAKTU LAPOR</th>
        <td><?= $row->report_time ?></td>
    </tr>
    <tr>
        <th>WAKTU PENANGANAN</th>
        <td><?= $row->handle_time ?></td>
    </tr>
    <tr>
        <th>WAKTU SELESAI</th>
        <td><?= $row->end_time ?></td>
    </tr>
    <tr>
        <th>OPERATOR</th>
        <td><?= $row->operator_id ?></td>
    </tr>
    <tr>
        <th>SOLUSI</th>
        <td><?= $row->solution_descrtiption ?></td>
    </tr>
    <tr>
        <th>STATUS PROBLEM</th>
        <td>
            <span class="badge bg-<?= $row->status_problem == 'Selesai' ? 'success' : 'warning' ?>">
                <?= ucfirst($row->status_problem) ?>
            </span>
        </td>
    </tr>
    <tr>
        <th>STATUS PRODUK</th>
        <td>
            <span class="badge bg-<?= $row->status_produk == 'PASS' ? 'success' : 'danger' ?>">
                <?= ucfirst($row->status_produk) ?>
            </span>
        </td>
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

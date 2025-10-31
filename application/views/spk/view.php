<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= card_open('<i class="icon cil-spreadsheet"></i> Detail SPK') ?>

<div class="row mb-3">
    <div class="col-8">
        <?= generate_card_info('Nomor SPK',  $row->no_spk  , "info"); ?>
    </div>
    <div class="col-4 text-end">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('spk/edit/' . $row->id) ?>" class="btn btn-warning" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('spk/delete/' . $row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('spk') ?>" class="btn btn-secondary" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
        </div>
    </div>
</div>

<table class="table table-bordered table-hover align-middle">
    <tr>
        <th style="width: 25%">Kode Mesin</th>
        <td>
            <span class="badge bg-dark"><?= $row->kd_machine ?></span>
        </td>
    </tr>
    <tr>
        <th>Kode Produk</th>
        <td><span class="badge bg-success"><?= $row->kd_product ?></span></td>
    </tr>
    <tr>
        <th>Cavity</th>
        <td><?= $row->cavity ?></td>
    </tr>
    <tr>
        <th>Cycle Time (CT)</th>
        <td><?= $row->ct ?></td>
    </tr>
    <tr>
        <th>Tanggal Mulai</th>
        <td><?= indo_date($row->tgl_mulai, true) ?></td>
    </tr>
    <tr>
        <th>Tanggal Selesai</th>
        <td><?= indo_date($row->tgl_selesai, true) ?></td>
    </tr>
    <tr>
        <th>No. Mould</th>
        <td><?= $row->no_mould ?></td>
    </tr>
    <tr>
        <th>No. PO</th>
        <td><?= $row->no_po ?></td>
    </tr>
    <tr>
        <th>Jumlah Order</th>
        <td><?= number_format($row->jml_ord) ?></td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td><?= $row->keterangan ?: '<span class="text-muted">-</span>' ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php
            $status_badge = match (strtoupper($row->status)) {
                'OPEN' => 'warning',
                'PROGRESS' => 'primary',
                'CLOSE' => 'success',
                default => 'secondary'
            };
            ?>
            <span class="badge rounded-pill bg-<?= $status_badge ?>"><?= strtoupper($row->status) ?></span>
        </td>
    </tr>
</table>

<?= card_open('<i class="icon cil-description"></i> Informasi Tambahan', ['class' => 'border-top-warning border-top-3']) ?>
<div class="row">
    <div class="col-md-4 mb-2"><?= generate_card_info('Created At', indo_date($row->created_at, true), 'primary'); ?></div>
    <div class="col-md-4 mb-2"><?= generate_card_info('Updated At', indo_date($row->updated_at, true)); ?></div>
    <div class="col-md-4 mb-2"><?= generate_card_info('Created By', $row->created_by); ?></div>
</div>
<?= card_close() ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url('assets/js/sweetalert-helper.js') ?>"></script>

<?= card_close() ?>

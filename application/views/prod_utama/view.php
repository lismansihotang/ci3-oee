<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Prod_utama') ?>
<div class="row">
    <div class="col-8">
    </div>
    <div class="col-4 text-end">
        <div class="mt-3 mb-4">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <a href="<?= site_url('prod_utama/edit/' . $row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
                <a href="<?= site_url('prod_utama/delete/' . $row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
                <a href="<?= site_url('prod_utama') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered">

    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>tanggal</th>
        <td><?= $row->tanggal ?></td>
    </tr>
    <tr>
        <th>kd_prod</th>
        <td><?= $row->kd_prod ?></td>
    </tr>
    <tr>
        <th>kd_ms</th>
        <td><?= $row->kd_ms ?></td>
    </tr>
    <tr>
        <th>no_spk</th>
        <td><?= $row->no_spk ?></td>
    </tr>
    <tr>
        <th>jml_pass</th>
        <td><?= $row->jml_pass ?></td>
    </tr>
    <tr>
        <th>jml_hold</th>
        <td><?= $row->jml_hold ?></td>
    </tr>
    <tr>
        <th>operators_id</th>
        <td><?= $row->operators_id ?></td>
    </tr>
</table>
<h3>Details</h3>
<?php
$table_attributes = array(
    'class' => 'table table-bordered table-hover border'
);

$prod_detail_headers = [
    'jam' => ['label' => 'Jam', 'property' => 'jam', 'align' => 'center'],
    'shift_id' => ['label' => 'Shift', 'property' => 'shift_id', 'align' => 'center'],
    'pass_qty' => ['label' => 'Pass', 'property' => 'pass_qty', 'align' => 'center'],
    'hold_qty' => ['label' => 'Hold', 'property' => 'hold_qty', 'align' => 'center'],
];
echo generate_table_view($prod_details, $prod_detail_headers, $table_attributes);

?>
<h3>Downtimes</h3>
<?php
$prod_downtime_headers = [
    'start_time' => ['label' => 'Start Time', 'property' => 'start_time', 'align' => 'center'],
    'end_time' => ['label' => 'End Time', 'property' => 'end_time', 'align' => 'center'],
    'duration_min' => ['label' => 'Duration', 'property' => 'duration_min', 'align' => 'center'],
    'notes' => ['label' => 'Keterangan', 'property' => 'notes'],
    'action' => ['label' => 'Aksi', 'property' => 'action',],
];
echo generate_table_view($prod_downtimes, $prod_downtime_headers, $table_attributes);
?>
<div class="row mt-3">
    <div class="col-12">Informasi Data</div>
    <div class="col-4"><?= generate_card_info(indo_date($row->created_at, true) . ' > Created By', $row->created_by, 'primary'); ?></div>
    <div class="col-4"><?= generate_card_info(indo_date($row->updated_at, true) . ' > Updated By', $row->updated_by); ?></div>
</div>
<?= card_close() ?>
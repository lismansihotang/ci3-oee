<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Prod_qc') ?>
<div class="row">
    <div class="col-8">
    </div>
    <div class="col-4 text-end">
        <div class="mt-3 mb-4">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <a href="<?= site_url('prod_qc') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
            </div>
        </div>
    </div>
</div>
<?php
$table_attributes = array(
    'class' => 'table table-bordered table-hover border w-100 mx-n4 mb-0'
);

function get_mesin_callback($row, $value)
{
    $buttons = [
        ['label' => get_single_value('Machines_model', ['id' => $row->kd_ms], 'kode_mesin'), 'class' => 'btn btn-outline-primary', 'href' => site_url(['machines/view', 'id' => $value])],
        ['label' => get_single_value('Machines_model', ['id' => $row->kd_ms], 'nama_mesin'), 'class' => 'btn btn-primary', 'href' => site_url(['machines/view', 'id' => $value])],
    ];
    return generate_btn_group($buttons);
}

function get_product_callback($row, $value)
{
    $buttons = [
        ['label' => $value, 'class' => 'btn btn-outline-info', 'href' => site_url(['products/view', 'id' => $value])],
        ['label' => get_single_value('Products_model', ['id' => $row->prod_id], 'nama_produk'), 'class' => 'btn btn-info', 'href' => site_url(['products/view', 'id' => $value])],
    ];
    return generate_btn_group($buttons);
}

$qc_headers = [
    'prod_id' => ['label' => 'Product', 'property' => 'prod_id', 'type' => 'callback', 'callback' => 'get_product_callback', 'align' => 'center'],
    'kd_ms' => ['label' => 'Mesin', 'property' => 'kd_ms', 'type' => 'callback', 'callback' => 'get_mesin_callback', 'align' => 'center'],
    'tanggal' => ['label' => 'Tanggal', 'property' => 'tanggal', 'align' => 'center'],
    'shift' => ['label' => 'Shift', 'property' => 'shift', 'align' => 'center'],
    'jam' => ['label' => 'Jam', 'property' => 'jam', 'align' => 'center'],
    'kd_qc' => ['label' => 'QC', 'property' => 'kd_qc', 'align' => 'center'],
    'nilai' => ['label' => 'Nilai', 'property' => 'nilai', 'align' => 'center'],
];

echo generate_table_view($row, $qc_headers, $table_attributes);
?>
<?= card_close() ?>
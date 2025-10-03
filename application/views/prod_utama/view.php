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

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php
// Fungsi Callback
function get_mesin_callback($row, $value)
{
    $buttons = [
        ['label' => get_single_value('Machines_model', ['id' => $row->kd_ms], 'kode_mesin'), 'class' => 'btn btn-outline-primary', 'href' => site_url(['machines/view', 'id' => $value])],
        ['label' => get_single_value('Machines_model', ['id' => $row->kd_ms], 'nama_mesin'), 'class' => 'btn btn-primary', 'href' => site_url(['machines/view', 'id' => $value])],
    ];
    return generate_btn_group($buttons);
}
function get_spk_callback($row, $value)
{
    $buttons = [
        ['label' => $value, 'class' => 'btn btn-outline-info', 'href' => site_url(['spk/view', 'id' => $value])],
        ['label' => get_single_value('Spk_model', ['id' => $row->no_spk], 'no_spk'), 'class' => 'btn btn-info', 'href' => site_url(['spk/view', 'id' => $value])],
    ];
    return generate_btn_group($buttons);
}
function get_operator_callback($row, $value)
{
    $buttons = [
        ['label' => get_single_value('Operators_model', ['id' => $row->operators_id], 'jabatan'), 'class' => 'btn btn-outline-primary', 'href' => site_url(['operators/view', 'id' => $value])],
        ['label' => get_single_value('Operators_model', ['id' => $row->operators_id], 'nama'), 'class' => 'btn btn-primary', 'href' => site_url(['operators/view', 'id' => $value])],
    ];
    return generate_btn_group($buttons);
}

$prod_utama_header_maps = [
    'ID #'           => ['property' => 'id', 'wrapper' => '<span class="badge bg-primary">%s</span>'],
    'Tanggal Produksi'     => ['property' => 'tanggal', 'format' => 'date', 'params' => 'd M Y', 'class' => 'text-muted fst-italic'],
    'Kode Produk'          => 'kd_prod',
    'Kode Mesin'           => ['property' => 'kd_ms', 'type' => 'callback', 'callback' => 'get_mesin_callback'],
    'No. SPK'              => ['property' => 'no_spk', 'type' => 'callback', 'callback' => 'get_spk_callback'],
    'Operator'              => ['property' => 'operators_id', 'type' => 'callback', 'callback' => 'get_operator_callback'],
];
$prod_utama_table_attributes = [
    'class' => 'table table-bordered table-hover border w-100'
];
echo build_table_view([$row], $prod_utama_header_maps, $prod_utama_table_attributes);

$table_attributes = array(
    'class' => 'table table-bordered table-hover border w-100 mx-n4 mb-0'
);

$prod_detail_headers = [
    'jam' => ['label' => 'Jam', 'property' => 'jam', 'align' => 'center'],
    'shift' => ['label' => 'Shift', 'property' => 'shift', 'align' => 'center'],
    'pass_qty' => ['label' => 'Pass', 'property' => 'pass_qty', 'align' => 'center'],
    'hold_qty' => ['label' => 'Hold', 'property' => 'hold_qty', 'align' => 'center'],
];

$prod_downtime_headers = [
    'start_time' => ['label' => 'Start Time', 'property' => 'start_time', 'align' => 'center'],
    'end_time' => ['label' => 'End Time', 'property' => 'end_time', 'align' => 'center'],
    'duration_min' => ['label' => 'Duration', 'property' => 'duration_min', 'align' => 'center'],
    'notes' => ['label' => 'Keterangan', 'property' => 'notes'],
    'action' => ['label' => 'Aksi', 'property' => 'action',],
];

$accod_items = [
    [
        'title' => 'Details [SHIFT 1]',
        'content' => generate_table_view(group_array($prod_details, 'shift', 1), $prod_detail_headers, $table_attributes),
        'icon' => 'cil-chart',
        'body_class' => 'p-0',
        'actions' => [
            [
                'type' => 'dropdown',
                'icon' => '<i class="icon cil-options"></i>',
                'class' => 'btn btn-outline-dark m-2',
                'items' => [
                    [
                        'label' => 'Edit Detail [SHIFT 1]',
                        'url'   => 'prod_utam/edit/' . $prod_id . '&shift=1',
                        'icon'  => 'cil-pencil'
                    ],
                ]
            ]
        ]
    ],
    [
        'title' => 'Details [SHIFT 2]',
        'content' => generate_table_view(group_array($prod_details, 'shift', 2), $prod_detail_headers, $table_attributes),
        'icon' => 'cil-chart',
        'body_class' => 'p-0',
        'actions' => [
            [
                'type' => 'dropdown',
                'icon' => '<i class="icon cil-options"></i>', // Ganti ikon dropdown
                'class' => 'btn btn-outline-dark m-2', // Kelas untuk tombol utama dropdown
                'items' => [
                    [
                        'label' => 'Edit Detail [SHIFT 2]',
                        'url'   => 'prod_utam/edit/' . $prod_id . '&shift=2',
                        'icon'  => 'cil-pencil'
                    ],
                ]
            ]
        ]
    ],
    [
        'title' => 'Details [SHIFT 3]',
        'content' => generate_table_view(group_array($prod_details, 'shift', 3), $prod_detail_headers, $table_attributes),
        'icon' => 'cil-chart',
        'body_class' => 'p-0',
        'actions' => [
            [
                'type' => 'dropdown',
                'icon' => '<i class="icon cil-options"></i>', // Ganti ikon dropdown
                'class' => 'btn btn-outline-dark m-2', // Kelas untuk tombol utama dropdown
                'items' => [
                    [
                        'label' => 'Edit Detail [SHIFT 3]',
                        'url'   => 'prod_utam/edit/' . $prod_id . '&shift=3',
                        'icon'  => 'cil-pencil'
                    ],
                ]
            ]
        ]
    ],
    [
        'title' => 'Downtimes',
        'content' => generate_table_view($prod_downtimes, $prod_downtime_headers, $table_attributes),
        'icon' => 'cil-clock',
        'body_class' => 'p-0',
    ]
];
echo generate_accordion($accod_items, 'accord_details', TRUE, 0);
?>
<div class="row mt-3">
    <div class="col-12">Informasi Data</div>
    <div class="col-4"><?= generate_card_info(indo_date($row->created_at, true) . ' > Created By', get_single_value('Operators_model', ['id' => $row->created_by], 'nama'), 'primary'); ?></div>
    <div class="col-4"><?= generate_card_info(indo_date($row->updated_at, true) . ' > Updated By', get_single_value('Operators_model', ['id' => $row->updated_by], 'nama')); ?></div>
</div>
<?= card_close() ?>
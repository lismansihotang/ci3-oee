<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/floating-select2.css') ?>">

<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Purchase Orders' : '<i class="icon cil-window"></i> Tambah Purchase Orders') ?>
    <form method="post" id="form-purchase-orders">
        <?= bs_floating_input('no_po', 'text', (isset($row) ? $row->no_po : '')); ?>
        <?= bs_floating_input('tgl_po', 'date', (isset($row) ? $row->tgl_po : '')); ?>
        <?= bs_floating_input('tgl_kirim', 'date', (isset($row) ? $row->tgl_kirim : '')); ?>
        <?= bs_floating_select('kd_cust', $cust_options, (isset($row) ? $row->kd_cust : ''), null, [ // extra_attributes
        'data-target-input' => 'nm_cust',
        'data-source-key' => 'nm_cust',
        'data-fetch-url' => site_url('customers/get_customer_data/'),
        'class' => 'select2-init select-customer',
    ]); ?>
    <input type="hidden" name="nm_cust" value="<?=(isset($row) ? $row->nm_cust : '');?>">
        <?= bs_floating_input('ket', 'text', (isset($row) ? $row->ket : '')); ?>
        
        <hr>

        <h5 class="mt-4 mb-3">Detail Purchase Order</h5>

        <?php

            $headers = [
                'Kode Produk','','Jumlah', 'Harga', 'Subtotal',
                //'Tanggal Kirim'
            ];
$columns = [
    'kd_product', 'nm_product', 'qty', 'harga', 'subtotal',
    //'kiriman_akhir'
];

$column_types = [
    'kd_product' => 'select2',
    'qty' => 'number',
    'harga' => 'number',
    'subtotal' => 'number',
    //'kiriman_akhir' => 'date',
    'nm_product' => 'hidden',
];

$select_options = [
    'kd_product' => $products_options
];

$fetch_urls = [
    'kd_product' => site_url('products/get_product_data/')
];

// Tambahkan array baru untuk ID dan kelas
$column_attributes = [
    'qty' => ['class' => 'qty-input', 'id' => 'qty_0'],
    'harga' => ['class' => 'harga-input'],
    'kd_product' => [
        'class' => 'produk-select select2-init',
                    'data-fetch-url' => site_url('products/get_product_data/'),
                    'data-mapping' => [
            "nama_produk" => ".nama-produk-input",
            "cost"        => ".harga-input"
        ]
    ],
    'nm_product' => ['class' => 'nama-produk-input'],
    'subtotal' => ['class' => 'subtotal-input'],
];

$details = isset($details) ? $details : [];
echo table_form_detail_generic('poDetailTable', $headers, $columns, $details, $column_types, $select_options, $column_attributes, $fetch_urls);
?>

        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('purchase_orders') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr_config.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr-helper.js') ?>"></script>

<script src="<?= base_url('assets/js/fetch.js') ?>"></script>
<script src="<?= base_url('assets/js/header-autofill.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-autofill.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/calc-grid.js') ?>"></script>

<script>
    $(function () {
        // init Select2 umum
        $(".select2-init").select2({ theme: "bootstrap-5" });

        // helper tabel (init plugin)
        $("#poDetailTable").gridHelper();

        // autofill tabel produk
        $("#poDetailTable").tableAutofill({ trigger: ".produk-select" });

        // kalkulasi subtotal
        $("#poDetailTable").calcGrid();

        // header/form pelanggan
        $("#form-purchase-orders").headerAutofill({ trigger: ".select-customer" });
    });
</script>
<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Purchase_orders' : '<i class="icon cil-window"></i> Tambah Purchase_orders') ?>
    <form method="post">
        <?= bs_floating_input('no_po', 'text', (isset($row) ? $row->no_po : '')); ?>
        <?= bs_floating_input('tgl_po', 'date', (isset($row) ? $row->tgl_po : '')); ?>
        <?= bs_floating_input('tgl_kirim', 'date', (isset($row) ? $row->tgl_kirim : '')); ?>
        <?= bs_floating_select('kd_cust', $cust_options, (isset($row) ? $row->kd_cust : ''), null, [ // extra_attributes
        'data-target-input' => 'nm_cust',
        'data-fetch-url' => site_url('customers/get_customer_data/'),
        'data-source-key' => 'nm_cust'
    ]); ?>
        <?= bs_floating_input('ket', 'text', (isset($row) ? $row->ket : '')); ?>
        <input type="hidden" name="nm_cust">
        <hr>

        <h5 class="mt-4 mb-3">Detail Purchase Order</h5>

        <?php

            $headers = ['Kode Produk','Jumlah', 'Harga', 'Subtotal', 'Tanggal Kirim'];
$columns = ['kd_product', 'nm_product', 'qty', 'harga', 'subtotal', 'kiriman_akhir'];

$column_types = [
    'qty' => 'number',
    'harga' => 'number',
    'subtotal' => 'number',
    'kiriman_akhir' => 'date',
    'nm_product' => 'hidden'
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
    'kd_product' => ['class' => 'produk-select'],
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
<script src="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr_config.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/purchase-order-calc.js') ?>"></script>
<script src="<?= base_url('assets/js/purchase-order-grid-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/form-autofill-helper.js') ?>"></script>
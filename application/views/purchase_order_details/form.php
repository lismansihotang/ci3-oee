<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Purchase Order Details' : '<i class="icon cil-window"></i> Tambah Purchase Order Details') ?>

<form method="post">
    <?php
    $fields = [
        'id','id_po','no','kd_product','nm_product','qty','harga','subtotal','total',
        'kiriman_akhir','qty_kirim','sisa_order','status','jml_kirim','jml_retur',
        'is_deleted','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'
    ];

    foreach($fields as $field) {
        $value = isset($row) ? $row->$field : '';
        echo bs_floating_input($field, 'text', $value);
    }
    ?>

    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang">
                <i class="icon cil-save"></i> Simpan
            </button>
            <a href="<?= site_url('purchase_order_details') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Kembali ke List Data">
                <i class="icon cil-reload"></i> Kembali
            </a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Kembali ke Halaman Utama">
                <i class="icon cil-home"></i>
            </a>
        </div>
    </div>
</form>

<?= card_close() ?>

<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Purchase Orders') ?>
    <?php
    $this->load->helper('calculation');
$total = calculate_total($details, 'subtotal');
$total_view = ($total) > 0 ? number_format($total) : 0;
?>
    <div class="row">
        <div class="col-8">
        <?=generate_card_info('Total (Rp.)', $total_view, 'warning');?>
    </div>
    <div class="col-4 text-end">
    <div class="mb-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <a href="<?= site_url('purchase_orders/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
                <a href="<?= site_url('purchase_orders/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
                <a href="<?= site_url('purchase_orders') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
            </div>
        </div>
    </div>
    
</div>
    <table class="table table-bordered table-hover"> 
    <tr>
        <th>id</th>
        <td><span class="badge rounded-pill bg-dark">#<?= $row->id ?></span></td>
    </tr>
    <tr>
        <th>No. PO</th>
        <td><?= $row->no_po ?></td>
    </tr>
    <tr>
        <th>Tgl. PO</th>
        <td><?= indo_date($row->tgl_po) ?></td>
    </tr>
    <tr>
        <th>Tgl. Kirim</th>
        <td><?= indo_date($row->tgl_kirim) ?></td>
    </tr>
    <tr>
        <th>Customer</th>
        <td>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-dark"><?= $row->kd_cust ?></button>
                <a href="#" class="btn btn-success"></span> <?= $row->nm_cust ?></a>
            </div>
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td><?= $row->ket ?></td>
    </tr>
    </table>
    <?= card_open('<i class="icon cil-spreadsheet"></i> List Items Purchase Orders', ['class' => 'border-top-warning border-top-3']) ?>
   <?php

$headers_map = array(
  'Kode Produk' => ['property' => 'kd_product', 'align' => 'center'],
 'Nama Produk' => [
 'property' => 'nm_product',
 'type' => 'link',
 'url' => 'products/view_by_code/',
 'link_property' => 'kd_product'
 ],
 'Kuantitas' => ['property' => 'qty', 'align' => 'right'],
 'Harga' => ['property' => 'harga', 'format' => 'currency', 'align' => 'right'],
 'Subtotal' => ['property' => 'subtotal', 'format' => 'currency', 'align' => 'right'],
 );

// Optional: table attributes for styling (e.g., using Bootstrap)
$table_attributes = array(
    'class' => 'table table-bordered table-hover border'
);

echo generate_table_view($details, $headers_map, $table_attributes);
echo '<p class="text-end fs-5 fw-bolder text-decoration-underline">'.$total_view.'</p>';
?>
    <?= card_close() ?>
    

    <div class="row mt-3">
        <div class="col-12">Informasi Data</div>
        <div class="col-4"><?=generate_card_info(indo_date($row->created_at, true).' > Created By', $row->created_by, 'primary');?></div>
        <div class="col-4"><?=generate_card_info(indo_date($row->updated_at, true).' > Updated By', $row->updated_by);?></div>   
    </div>
<?= card_close() ?>
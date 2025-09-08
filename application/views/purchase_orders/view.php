<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Purchase_orders') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>no_po</th>
        <td><?= $row->no_po ?></td>
    </tr>
    <tr>
        <th>tgl_po</th>
        <td><?= $row->tgl_po ?></td>
    </tr>
    <tr>
        <th>tgl_kirim</th>
        <td><?= $row->tgl_kirim ?></td>
    </tr>
    <tr>
        <th>kd_cust</th>
        <td><?= $row->kd_cust ?></td>
    </tr>
    <tr>
        <th>nm_cust</th>
        <td><?= $row->nm_cust ?></td>
    </tr>
    <tr>
        <th>ket</th>
        <td><?= $row->ket ?></td>
    </tr>
    <tr>
        <th>is_deleted</th>
        <td><?= $row->is_deleted ?></td>
    </tr>
    <tr>
        <th>created_by</th>
        <td><?= $row->created_by ?></td>
    </tr>
    <tr>
        <th>updated_by</th>
        <td><?= $row->updated_by ?></td>
    </tr>
    <tr>
        <th>deleted_by</th>
        <td><?= $row->deleted_by ?></td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?= $row->created_at ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?= $row->updated_at ?></td>
    </tr>
    <tr>
        <th>deleted_at</th>
        <td><?= $row->deleted_at ?></td>
    </tr>
    </table>
    <?php var_dump($details);?>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('purchase_orders/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('purchase_orders/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('purchase_orders') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
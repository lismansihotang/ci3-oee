<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Prod_shift_log') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>kd_ms</th>
        <td><?= $row->kd_ms ?></td>
    </tr>
    <tr>
        <th>tanggal</th>
        <td><?= $row->tanggal ?></td>
    </tr>
    <tr>
        <th>shift_no</th>
        <td><?= $row->shift_no ?></td>
    </tr>
    <tr>
        <th>leader_id</th>
        <td><?= $row->leader_id ?></td>
    </tr>
    <tr>
        <th>status</th>
        <td><?= $row->status ?></td>
    </tr>
    <tr>
        <th>total_pass</th>
        <td><?= $row->total_pass ?></td>
    </tr>
    <tr>
        <th>total_reject</th>
        <td><?= $row->total_reject ?></td>
    </tr>
    <tr>
        <th>total_hold</th>
        <td><?= $row->total_hold ?></td>
    </tr>
    <tr>
        <th>finish_qty</th>
        <td><?= $row->finish_qty ?></td>
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
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('prod_shift_log/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('prod_shift_log/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('prod_shift_log') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
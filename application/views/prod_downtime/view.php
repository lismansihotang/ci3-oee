<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Prod_downtime') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>shift</th>
        <td><?= $row->shift ?></td>
    </tr>
    <tr>
        <th>downtime_id</th>
        <td><?= $row->downtime_id ?></td>
    </tr>
    <tr>
        <th>start_time</th>
        <td><?= $row->start_time ?></td>
    </tr>
    <tr>
        <th>end_time</th>
        <td><?= $row->end_time ?></td>
    </tr>
    <tr>
        <th>duration_min</th>
        <td><?= $row->duration_min ?></td>
    </tr>
    <tr>
        <th>notes</th>
        <td><?= $row->notes ?></td>
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
    <tr>
        <th>prod_id</th>
        <td><?= $row->prod_id ?></td>
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
        <th>action</th>
        <td><?= $row->action ?></td>
    </tr>
    </table>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('prod_downtime/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('prod_downtime/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('prod_downtime') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
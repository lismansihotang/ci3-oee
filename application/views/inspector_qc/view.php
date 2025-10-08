<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Inspector_qc') ?>
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
        <th>machines_id</th>
        <td><?= $row->machines_id ?></td>
    </tr>
    <tr>
        <th>shift</th>
        <td><?= $row->shift ?></td>
    </tr>
    <tr>
        <th>phase</th>
        <td><?= $row->phase ?></td>
    </tr>
    <tr>
        <th>problem</th>
        <td><?= $row->problem ?></td>
    </tr>
    <tr>
        <th>problem_description</th>
        <td><?= $row->problem_description ?></td>
    </tr>
    <tr>
        <th>report_time</th>
        <td><?= $row->report_time ?></td>
    </tr>
    <tr>
        <th>handle_time</th>
        <td><?= $row->handle_time ?></td>
    </tr>
    <tr>
        <th>end_time</th>
        <td><?= $row->end_time ?></td>
    </tr>
    <tr>
        <th>operator_id</th>
        <td><?= $row->operator_id ?></td>
    </tr>
    <tr>
        <th>solution_descrtiption</th>
        <td><?= $row->solution_descrtiption ?></td>
    </tr>
    <tr>
        <th>status_problem</th>
        <td><?= $row->status_problem ?></td>
    </tr>
    <tr>
        <th>status_produk</th>
        <td><?= $row->status_produk ?></td>
    </tr>
    </table>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('inspector_qc/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('inspector_qc/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('inspector_qc') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
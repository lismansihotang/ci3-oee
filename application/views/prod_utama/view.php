<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Prod_utama') ?>
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
        <th>kd_prod</th>
        <td><?= $row->kd_prod ?></td>
    </tr>
    <tr>
        <th>kd_ms</th>
        <td><?= $row->kd_ms ?></td>
    </tr>
    <tr>
        <th>no_spk</th>
        <td><?= $row->no_spk ?></td>
    </tr>
    <tr>
        <th>jml_pass</th>
        <td><?= $row->jml_pass ?></td>
    </tr>
    <tr>
        <th>jml_hold</th>
        <td><?= $row->jml_hold ?></td>
    </tr>
    <tr>
        <th>operators_id</th>
        <td><?= $row->operators_id ?></td>
    </tr>
    <tr>
        <th>persen</th>
        <td><?= $row->persen ?></td>
    </tr>
    <tr>
        <th>per_r</th>
        <td><?= $row->per_r ?></td>
    </tr>
    <tr>
        <th>keterangan</th>
        <td><?= $row->keterangan ?></td>
    </tr>
    <tr>
        <th>sh</th>
        <td><?= $row->sh ?></td>
    </tr>
    <tr>
        <th>jam</th>
        <td><?= $row->jam ?></td>
    </tr>
    <tr>
        <th>per_rb</th>
        <td><?= $row->per_rb ?></td>
    </tr>
    <tr>
        <th>per_bw</th>
        <td><?= $row->per_bw ?></td>
    </tr>
    <tr>
        <th>per_rs</th>
        <td><?= $row->per_rs ?></td>
    </tr>
    <tr>
        <th>per_rc</th>
        <td><?= $row->per_rc ?></td>
    </tr>
    <tr>
        <th>per_ra</th>
        <td><?= $row->per_ra ?></td>
    </tr>
    <tr>
        <th>per_rl</th>
        <td><?= $row->per_rl ?></td>
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
            <a href="<?= site_url('prod_utama/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('prod_utama/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('prod_utama') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
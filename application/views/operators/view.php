<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Operators') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>user_id</th>
        <td><?= $row->user_id ?></td>
    </tr>
    <tr>
        <th>nama</th>
        <td><?= $row->nama ?></td>
    </tr>
    <tr>
        <th>no_induk</th>
        <td><?= $row->no_induk ?></td>
    </tr>
    <tr>
        <th>password</th>
        <td><?= $row->password ?></td>
    </tr>
    <tr>
        <th>jabatan</th>
        <td><?= $row->jabatan ?></td>
    </tr>
    <tr>
        <th>divisi</th>
        <td><?= $row->divisi ?></td>
    </tr>
    <tr>
        <th>akses</th>
        <td><?= $row->akses ?></td>
    </tr>
    <tr>
        <th>grup</th>
        <td><?= $row->grup ?></td>
    </tr>
    <tr>
        <th>urutan</th>
        <td><?= $row->urutan ?></td>
    </tr>
    <tr>
        <th>tgl_keluar</th>
        <td><?= $row->tgl_keluar ?></td>
    </tr>
    <tr>
        <th>alasan</th>
        <td><?= $row->alasan ?></td>
    </tr>
    <tr>
        <th>alamat_asal</th>
        <td><?= $row->alamat_asal ?></td>
    </tr>
    <tr>
        <th>alamat_sekarang</th>
        <td><?= $row->alamat_sekarang ?></td>
    </tr>
    <tr>
        <th>nik</th>
        <td><?= $row->nik ?></td>
    </tr>
    <tr>
        <th>phone</th>
        <td><?= $row->phone ?></td>
    </tr>
    <tr>
        <th>tempat_lahir</th>
        <td><?= $row->tempat_lahir ?></td>
    </tr>
    <tr>
        <th>tgl_lahir</th>
        <td><?= $row->tgl_lahir ?></td>
    </tr>
    <tr>
        <th>pendidikan</th>
        <td><?= $row->pendidikan ?></td>
    </tr>
    <tr>
        <th>alumnus</th>
        <td><?= $row->alumnus ?></td>
    </tr>
    <tr>
        <th>tgl_masuk</th>
        <td><?= $row->tgl_masuk ?></td>
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
            <a href="<?= site_url('operators/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('operators/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('operators') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
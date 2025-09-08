<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Users') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>username</th>
        <td><?= $row->username ?></td>
    </tr>
    <tr>
        <th>password</th>
        <td><?= $row->password ?></td>
    </tr>
    <tr>
        <th>email</th>
        <td><?= $row->email ?></td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?= $row->created_at ?></td>
    </tr>
    <tr>
        <th>updated_by</th>
        <td><?= $row->updated_by ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?= $row->updated_at ?></td>
    </tr>
    </table>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('users/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('users/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
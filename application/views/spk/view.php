<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Spk') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>no_spk</th>
        <td><?= $row->no_spk ?></td>
    </tr>
    <tr>
        <th>kd_machine</th>
        <td><?= $row->kd_machine ?></td>
    </tr>
    <tr>
        <th>kd_product</th>
        <td><?= $row->kd_product ?></td>
    </tr>
    <tr>
        <th>cavity</th>
        <td><?= $row->cavity ?></td>
    </tr>
    <tr>
        <th>ct</th>
        <td><?= $row->ct ?></td>
    </tr>
    <tr>
        <th>tgl_mulai</th>
        <td><?= $row->tgl_mulai ?></td>
    </tr>
    <tr>
        <th>tgl_selesai</th>
        <td><?= $row->tgl_selesai ?></td>
    </tr>
    <tr>
        <th>no_mould</th>
        <td><?= $row->no_mould ?></td>
    </tr>
    <tr>
        <th>no_po</th>
        <td><?= $row->no_po ?></td>
    </tr>
    <tr>
        <th>jml_ord</th>
        <td><?= $row->jml_ord ?></td>
    </tr>
    <tr>
        <th>keterangan</th>
        <td><?= $row->keterangan ?></td>
    </tr>
    <tr>
        <th>tjam</th>
        <td><?= $row->tjam ?></td>
    </tr>
    <tr>
        <th>tshift</th>
        <td><?= $row->tshift ?></td>
    </tr>
    <tr>
        <th>tday</th>
        <td><?= $row->tday ?></td>
    </tr>
    <tr>
        <th>ct_print</th>
        <td><?= $row->ct_print ?></td>
    </tr>
    <tr>
        <th>ct_stamp</th>
        <td><?= $row->ct_stamp ?></td>
    </tr>
    <tr>
        <th>print_jam</th>
        <td><?= $row->print_jam ?></td>
    </tr>
    <tr>
        <th>print_shift</th>
        <td><?= $row->print_shift ?></td>
    </tr>
    <tr>
        <th>print_day</th>
        <td><?= $row->print_day ?></td>
    </tr>
    <tr>
        <th>stamp_jam</th>
        <td><?= $row->stamp_jam ?></td>
    </tr>
    <tr>
        <th>stamp_shift</th>
        <td><?= $row->stamp_shift ?></td>
    </tr>
    <tr>
        <th>stamp_day</th>
        <td><?= $row->stamp_day ?></td>
    </tr>
    <tr>
        <th>status</th>
        <td><?= $row->status ?></td>
    </tr>
    <tr>
        <th>sub</th>
        <td><?= $row->sub ?></td>
    </tr>
    <tr>
        <th>no</th>
        <td><?= $row->no ?></td>
    </tr>
    <tr>
        <th>jumlah_jam</th>
        <td><?= $row->jumlah_jam ?></td>
    </tr>
    <tr>
        <th>tgl_mulai2</th>
        <td><?= $row->tgl_mulai2 ?></td>
    </tr>
    <tr>
        <th>tgl_selesai2</th>
        <td><?= $row->tgl_selesai2 ?></td>
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
            <a href="<?= site_url('spk/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('spk/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('spk') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
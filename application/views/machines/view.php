<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Machines') ?>
    <table class="table table-bordered">
        
    <tr>
        <th>id</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>kode_mesin</th>
        <td><?= $row->kode_mesin ?></td>
    </tr>
    <tr>
        <th>nama_mesin</th>
        <td><?= $row->nama_mesin ?></td>
    </tr>
    <tr>
        <th>jenis_mesin</th>
        <td><?= $row->jenis_mesin ?></td>
    </tr>
    <tr>
        <th>urutan</th>
        <td><?= $row->urutan ?></td>
    </tr>
    <tr>
        <th>jenis</th>
        <td><?= $row->jenis ?></td>
    </tr>
    <tr>
        <th>manufacturer</th>
        <td><?= $row->manufacturer ?></td>
    </tr>
    <tr>
        <th>kapasitas_kontainer</th>
        <td><?= $row->kapasitas_kontainer ?></td>
    </tr>
    <tr>
        <th>screw_speed</th>
        <td><?= $row->screw_speed ?></td>
    </tr>
    <tr>
        <th>hp</th>
        <td><?= $row->hp ?></td>
    </tr>
    <tr>
        <th>max_mold</th>
        <td><?= $row->max_mold ?></td>
    </tr>
    <tr>
        <th>min_mold</th>
        <td><?= $row->min_mold ?></td>
    </tr>
    <tr>
        <th>max_diameter_single_head</th>
        <td><?= $row->max_diameter_single_head ?></td>
    </tr>
    <tr>
        <th>tinggi_mesin</th>
        <td><?= $row->tinggi_mesin ?></td>
    </tr>
    <tr>
        <th>lebar_mesin</th>
        <td><?= $row->lebar_mesin ?></td>
    </tr>
    <tr>
        <th>panjang_mesin</th>
        <td><?= $row->panjang_mesin ?></td>
    </tr>
    <tr>
        <th>berat_mesin</th>
        <td><?= $row->berat_mesin ?></td>
    </tr>
    <tr>
        <th>rate</th>
        <td><?= $row->rate ?></td>
    </tr>
    <tr>
        <th>operator</th>
        <td><?= $row->operator ?></td>
    </tr>
    <tr>
        <th>listrik</th>
        <td><?= $row->listrik ?></td>
    </tr>
    <tr>
        <th>depresiasi</th>
        <td><?= $row->depresiasi ?></td>
    </tr>
    <tr>
        <th>foh_lain</th>
        <td><?= $row->foh_lain ?></td>
    </tr>
    <tr>
        <th>indirect_labour</th>
        <td><?= $row->indirect_labour ?></td>
    </tr>
    <tr>
        <th>direct_labour</th>
        <td><?= $row->direct_labour ?></td>
    </tr>
    <tr>
        <th>general_adm</th>
        <td><?= $row->general_adm ?></td>
    </tr>
    <tr>
        <th>marketing</th>
        <td><?= $row->marketing ?></td>
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
            <a href="<?= site_url('machines/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('machines/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('machines') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
    </div>
<?= card_close() ?>
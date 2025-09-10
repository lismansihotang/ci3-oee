<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Machines') ?>
    
    <div class="row">
        <div class="col-8">
    </div>
    <div class="col-4 text-end">
    <div class="mb-3">
              <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('machines/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('machines/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('machines') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
        </div>
    </div>
    
</div>
    <table class="table table-bordered">
        
   <table class="table table-bordered">
        
    <tr>
        <th>ID</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>KODE</th>
        <td><?= $row->kode_mesin ?></td>
    </tr>
    <tr>
        <th>NAMA</th>
        <td><?= $row->nama_mesin ?></td>
    </tr>
    <tr>
        <th>JENIS</th>
        <td><?= $row->jenis_mesin ?></td>
    </tr>
    <tr>
        <th>URUTAN</th>
        <td><?= $row->urutan ?></td>
    </tr>
    <!-- <tr>
        <th>jenis</th>
        <td><?= $row->jenis ?></td>
    </tr> -->
    <tr>
        <th>MANUFACTURER</th>
        <td><?= $row->manufacturer ?></td>
    </tr>
    <tr>
        <th>KAPASITAS KONTAINER</th>
        <td><?= $row->kapasitas_kontainer ?></td>
    </tr>
    <tr>
        <th>SCREW SPEED</th>
        <td><?= $row->screw_speed ?></td>
    </tr>
    <tr>
        <th>HP</th>
        <td><?= $row->hp ?></td>
    </tr>
    <tr>
        <th>MAX MOLD</th>
        <td><?= $row->max_mold ?></td>
    </tr>
    <tr>
        <th>MIN MOLD</th>
        <td><?= $row->min_mold ?></td>
    </tr>
    <tr>
        <th>MAX DIAMETER SINGLE HEAD</th>
        <td><?= $row->max_diameter_single_head ?></td>
    </tr>
    <tr>
        <th>TINGGI MESIN</th>
        <td><?= $row->tinggi_mesin ?></td>
    </tr>
    <tr>
        <th>LEBAR MESIN</th>
        <td><?= $row->lebar_mesin ?></td>
    </tr>
    <tr>
        <th>PANJANG MESIN</th>
        <td><?= $row->panjang_mesin ?></td>
    </tr>
    <tr>
        <th>BERAT MESIN</th>
        <td><?= $row->berat_mesin ?></td>
    </tr>
    <tr>
        <th>RATE</th>
        <td><?= $row->rate ?></td>
    </tr>
    <tr>
        <th>OPERATOR</th>
        <td><?= $row->operator ?></td>
    </tr>
    <tr>
        <th>LISTRIK</th>
        <td><?= $row->listrik ?></td>
    </tr>
    <tr>
        <th>DEPRESIASI</th>
        <td><?= $row->depresiasi ?></td>
    </tr>
    <tr>
        <th>FOH LAIN</th>
        <td><?= $row->foh_lain ?></td>
    </tr>
    <tr>
        <th>INDIRECT LABOUR</th>
        <td><?= $row->indirect_labour ?></td>
    </tr>
    <tr>
        <th>DIRECT LABOUR</th>
        <td><?= $row->direct_labour ?></td>
    </tr>
    <tr>
        <th>GENERAL ADM</th>
        <td><?= $row->general_adm ?></td>
    </tr>
    <tr>
        <th>MARKETING</th>
        <td><?= $row->marketing ?></td>
    </tr>
    </table>
   <?php



// Optional: table attributes for styling (e.g., using Bootstrap)
$table_attributes = array(
    'class' => 'table table-bordered table-hover border'
);

?>
    <?= card_close() ?>
    

    <div class="row mt-3">
        <div class="col-12">Informasi Data</div>
        <div class="col-4"><?=generate_card_info(indo_date($row->created_at, true).' > Created By', $row->created_by, 'primary');?></div>
        <div class="col-4"><?=generate_card_info(indo_date($row->updated_at, true).' > Updated By', $row->updated_by);?></div>   
    </div>
<?= card_close() ?>
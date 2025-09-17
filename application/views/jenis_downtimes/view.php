<?= card_open('<i class="icon cil-spreadsheet"></i> Detail Jenis Downtime') ?>
    
    <div class="row">
        <div class="col-8">
    </div>
    <div class="col-4 text-end">
    <div class="mb-3">
             <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <a href="<?= site_url('jenis_downtimes/edit/'.$row->id) ?>" class="btn btn-warning" data-coreui-toggle="tooltip" data-coreui-placement"top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a>
            <a href="<?= site_url('jenis_downtimes/delete/'.$row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>
            <a href="<?= site_url('jenis_downtimes') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i> </a>
        </div>
        </div>
    </div>
    
</div>
     <table class="table table-bordered">
        
    <tr>
        <th>ID</th>
        <td><?= $row->id ?></td>
    </tr>
    <tr>
        <th>KODE</th>
        <td><?= $row->kode ?></td>
    </tr>
    <tr>
        <th>NAMA</th>
        <td><?= $row->nama ?></td>
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
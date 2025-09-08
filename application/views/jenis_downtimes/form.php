<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Jenis_downtimes' : '<i class="icon cil-window"></i> Tambah Jenis_downtimes') ?>
<form method="post">
    <?= bs_floating_input('kode', 'text', (isset($row) ? $row->kode : '')); ?>
    <?= bs_floating_input('nama', 'text', (isset($row) ? $row->nama : '')); ?>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('jenis_downtimes') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
        </div>
    </div>
</form>
<?= card_close() ?>
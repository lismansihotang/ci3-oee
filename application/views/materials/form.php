<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Materials' : '<i class="icon cil-window"></i> Tambah Materials') ?>
    <form method="post">
        <?= bs_floating_input('id', 'text', (isset($row) ? $row->id : '')); ?><?= bs_floating_input('kode', 'text', (isset($row) ? $row->kode : '')); ?><?= bs_floating_input('nama', 'text', (isset($row) ? $row->nama : '')); ?><?= bs_floating_input('qty', 'text', (isset($row) ? $row->qty : '')); ?><?= bs_floating_input('jenis', 'text', (isset($row) ? $row->jenis : '')); ?><?= bs_floating_input('lokasi_1', 'text', (isset($row) ? $row->lokasi_1 : '')); ?><?= bs_floating_input('lokasi_2', 'text', (isset($row) ? $row->lokasi_2 : '')); ?><?= bs_floating_input('keterangan', 'text', (isset($row) ? $row->keterangan : '')); ?><?= bs_floating_input('is_deleted', 'text', (isset($row) ? $row->is_deleted : '')); ?><?= bs_floating_input('created_by', 'text', (isset($row) ? $row->created_by : '')); ?><?= bs_floating_input('updated_by', 'text', (isset($row) ? $row->updated_by : '')); ?><?= bs_floating_input('deleted_by', 'text', (isset($row) ? $row->deleted_by : '')); ?><?= bs_floating_input('created_at', 'text', (isset($row) ? $row->created_at : '')); ?><?= bs_floating_input('updated_at', 'text', (isset($row) ? $row->updated_at : '')); ?><?= bs_floating_input('deleted_at', 'text', (isset($row) ? $row->deleted_at : '')); ?>
        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('materials') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Operators' : '<i class="icon cil-window"></i> Tambah Operators') ?>
    <form method="post">
        <?= bs_floating_input('user_id', 'text', (isset($row) ? $row->user_id : '')); ?><?= bs_floating_input('nama', 'text', (isset($row) ? $row->nama : '')); ?><?= bs_floating_input('no_induk', 'text', (isset($row) ? $row->no_induk : '')); ?><?= bs_floating_input('password', 'text', (isset($row) ? $row->password : '')); ?><?= bs_floating_input('jabatan', 'text', (isset($row) ? $row->jabatan : '')); ?>
        <?= bs_floating_input('divisi', 'text', (isset($row) ? $row->divisi : '')); ?><?= bs_floating_input('akses', 'text', (isset($row) ? $row->akses : '')); ?><?= bs_floating_input('grup', 'text', (isset($row) ? $row->grup : '')); ?>
        <?= bs_floating_input('urutan', 'text', (isset($row) ? $row->urutan : '')); ?><?= bs_floating_input('tgl_keluar', 'text', (isset($row) ? $row->tgl_keluar : '')); ?><?= bs_floating_input('alasan', 'text', (isset($row) ? $row->alasan : '')); ?>
        <?= bs_floating_input('alamat_asal', 'text', (isset($row) ? $row->alamat_asal : '')); ?><?= bs_floating_input('alamat_sekarang', 'text', (isset($row) ? $row->alamat_sekarang : '')); ?><?= bs_floating_input('nik', 'text', (isset($row) ? $row->nik : '')); ?><?= bs_floating_input('phone', 'text', (isset($row) ? $row->phone : '')); ?>
        <?= bs_floating_input('tempat_lahir', 'text', (isset($row) ? $row->tempat_lahir : '')); ?><?= bs_floating_input('tgl_lahir', 'text', (isset($row) ? $row->tgl_lahir : '')); ?><?= bs_floating_input('pendidikan', 'text', (isset($row) ? $row->pendidikan : '')); ?>
        <?= bs_floating_input('alumnus', 'text', (isset($row) ? $row->alumnus : '')); ?><?= bs_floating_input('tgl_masuk', 'text', (isset($row) ? $row->tgl_masuk : '')); ?>
        
        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('operators') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Users' : '<i class="icon cil-window"></i> Tambah Users') ?>
    <form method="post">
        <?= bs_floating_input('id', 'text', (isset($row) ? $row->id : '')); ?><?= bs_floating_input('username', 'text', (isset($row) ? $row->username : '')); ?><?= bs_floating_input('password', 'text', (isset($row) ? $row->password : '')); ?><?= bs_floating_input('email', 'text', (isset($row) ? $row->email : '')); ?><?= bs_floating_input('created_at', 'text', (isset($row) ? $row->created_at : '')); ?><?= bs_floating_input('updated_by', 'text', (isset($row) ? $row->updated_by : '')); ?><?= bs_floating_input('updated_at', 'text', (isset($row) ? $row->updated_at : '')); ?>
        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('users') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
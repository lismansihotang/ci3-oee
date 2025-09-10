<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Spk' : '<i class="icon cil-window"></i> Tambah Spk') ?>
    <form method="post">
        <?= bs_floating_input('no_spk', 'text', (isset($row) ? $row->no_spk : '')); ?>
        <?= bs_floating_input('kd_machine', 'text', (isset($row) ? $row->kd_machine : '')); ?>
        <?= bs_floating_input('kd_product', 'text', (isset($row) ? $row->kd_product : '')); ?>
        <?= bs_floating_input('cavity', 'text', (isset($row) ? $row->cavity : '')); ?>
        <?= bs_floating_input('ct', 'text', (isset($row) ? $row->ct : '')); ?>
        <?= bs_floating_input('tgl_mulai', 'text', (isset($row) ? $row->tgl_mulai : '')); ?>
        <?= bs_floating_input('tgl_selesai', 'text', (isset($row) ? $row->tgl_selesai : '')); ?>
        <?= bs_floating_input('no_mould', 'text', (isset($row) ? $row->no_mould : '')); ?>
        <?= bs_floating_input('no_po', 'text', (isset($row) ? $row->no_po : '')); ?>
        <?= bs_floating_input('jml_ord', 'text', (isset($row) ? $row->jml_ord : '0')); ?>
        <?= bs_floating_input('keterangan', 'text', (isset($row) ? $row->keterangan : '')); ?>
        <?= bs_floating_input('tjam', 'text', (isset($row) ? $row->tjam : '0')); ?>
        <?= bs_floating_input('tshift', 'text', (isset($row) ? $row->tshift : '0')); ?>
        <?= bs_floating_input('tday', 'text', (isset($row) ? $row->tday : '0')); ?>
        <?= bs_floating_input('ct_print', 'text', (isset($row) ? $row->ct_print : '0')); ?>
        <?= bs_floating_input('ct_stamp', 'text', (isset($row) ? $row->ct_stamp : '0')); ?>
        <?= bs_floating_input('print_jam', 'text', (isset($row) ? $row->print_jam : '0')); ?>
        <?= bs_floating_input('print_shift', 'text', (isset($row) ? $row->print_shift : '0')); ?>
        <?= bs_floating_input('print_day', 'text', (isset($row) ? $row->print_day : '0')); ?>
        <?= bs_floating_input('stamp_jam', 'text', (isset($row) ? $row->stamp_jam : '0')); ?>
        <?= bs_floating_input('stamp_shift', 'text', (isset($row) ? $row->stamp_shift : '0')); ?>
        <?= bs_floating_input('stamp_day', 'text', (isset($row) ? $row->stamp_day : '0')); ?>
        <?= bs_floating_input('status', 'text', (isset($row) ? $row->status : '-')); ?>
        <?= bs_floating_input('sub', 'text', (isset($row) ? $row->sub : '0')); ?>
        <?= bs_floating_input('no', 'text', (isset($row) ? $row->no : '0')); ?>
        <?= bs_floating_input('jumlah_jam', 'text', (isset($row) ? $row->jumlah_jam : '0')); ?>
        <?= bs_floating_input('tgl_mulai2', 'text', (isset($row) ? $row->tgl_mulai2 : '')); ?>
        <?= bs_floating_input('tgl_selesai2', 'text', (isset($row) ? $row->tgl_selesai2 : '')); ?>
        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('spk') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
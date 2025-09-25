<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Prod_detail' : '<i class="icon cil-window"></i> Tambah Prod_detail') ?>
    <form method="post">
        <?= bs_floating_input('id', 'text', (isset($row) ? $row->id : '')); ?><?= bs_floating_input('shift_id', 'text', (isset($row) ? $row->shift_id : '')); ?><?= bs_floating_input('pass_qty', 'text', (isset($row) ? $row->pass_qty : '')); ?><?= bs_floating_input('is_deleted', 'text', (isset($row) ? $row->is_deleted : '')); ?><?= bs_floating_input('created_by', 'text', (isset($row) ? $row->created_by : '')); ?><?= bs_floating_input('updated_by', 'text', (isset($row) ? $row->updated_by : '')); ?><?= bs_floating_input('deleted_by', 'text', (isset($row) ? $row->deleted_by : '')); ?><?= bs_floating_input('created_at', 'text', (isset($row) ? $row->created_at : '')); ?><?= bs_floating_input('updated_at', 'text', (isset($row) ? $row->updated_at : '')); ?><?= bs_floating_input('deleted_at', 'text', (isset($row) ? $row->deleted_at : '')); ?><?= bs_floating_input('jam', 'text', (isset($row) ? $row->jam : '')); ?><?= bs_floating_input('hold_qty', 'text', (isset($row) ? $row->hold_qty : '')); ?>
        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('prod_detail') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
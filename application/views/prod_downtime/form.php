<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Prod_downtime' : '<i class="icon cil-window"></i> Tambah Prod_downtime') ?>
    <form method="post">

        <?= bs_floating_input('prod_id', 'text', (isset($row) ? $row->prod_id : '')); ?><?= bs_floating_input('kd_ms', 'text', (isset($row) ? $row->kd_ms : '')); ?><?= bs_floating_input('downtime_id', 'text', (isset($row) ? $row->downtime_id : '')); ?><?= bs_floating_input('tanggal', 'text', (isset($row) ? $row->tanggal : '')); ?><?= bs_floating_input('start_time', 'text', (isset($row) ? $row->start_time : '')); ?><?= bs_floating_input('end_time', 'text', (isset($row) ? $row->end_time : '')); ?><?= bs_floating_input('duration_min', 'text', (isset($row) ? $row->duration_min : '')); ?><?= bs_floating_input('shift', 'text', (isset($row) ? $row->shift : '')); ?><?= bs_floating_input('notes', 'text', (isset($row) ? $row->notes : '')); ?><?= bs_floating_input('action', 'text', (isset($row) ? $row->action : '')); ?><?= bs_floating_input('is_deleted', 'text', (isset($row) ? $row->is_deleted : '')); ?><?= bs_floating_input('created_by', 'text', (isset($row) ? $row->created_by : '')); ?><?= bs_floating_input('updated_by', 'text', (isset($row) ? $row->updated_by : '')); ?><?= bs_floating_input('deleted_by', 'text', (isset($row) ? $row->deleted_by : '')); ?><?= bs_floating_input('created_at', 'text', (isset($row) ? $row->created_at : '')); ?><?= bs_floating_input('updated_at', 'text', (isset($row) ? $row->updated_at : '')); ?><?= bs_floating_input('deleted_at', 'text', (isset($row) ? $row->deleted_at : '')); ?>

        <div class="mt-3">
            <div class="btn-group" role="group" aria-label="FormCreateUpdate">
                <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
                <a href="<?= site_url('prod_downtime') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
                <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>
<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Customers' : '<i class="icon cil-window"></i> Tambah Customers') ?>
<form method="post">
    <?= bs_floating_input('id', 'text', (isset($row) ? $row->id : '')); ?>
    <?= bs_floating_input('kd_cust', 'date', (isset($row) ? $row->kd_cust : ''), 'Tanggal PO', null, ['data-coreui-datepicker' => 'true']); ?>
    <?= bs_floating_input('nm_cust', 'text', (isset($row) ? $row->nm_cust : '')); ?><?= bs_floating_input('alamat1', 'text', (isset($row) ? $row->alamat1 : '')); ?><?= bs_floating_input('alamat2', 'text', (isset($row) ? $row->alamat2 : '')); ?><?= bs_floating_input('kota', 'text', (isset($row) ? $row->kota : '')); ?><?= bs_floating_input('telepon', 'text', (isset($row) ? $row->telepon : '')); ?><?= bs_floating_input('is_deleted', 'text', (isset($row) ? $row->is_deleted : '')); ?><?= bs_floating_input('created_by', 'text', (isset($row) ? $row->created_by : '')); ?><?= bs_floating_input('updated_by', 'text', (isset($row) ? $row->updated_by : '')); ?><?= bs_floating_input('deleted_by', 'text', (isset($row) ? $row->deleted_by : '')); ?><?= bs_floating_input('created_at', 'text', (isset($row) ? $row->created_at : '')); ?><?= bs_floating_input('updated_at', 'text', (isset($row) ? $row->updated_at : '')); ?><?= bs_floating_input('deleted_at', 'text', (isset($row) ? $row->deleted_at : '')); ?>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('customers') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
        </div>
    </div>
</form>
<?= card_close() ?>
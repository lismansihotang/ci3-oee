<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit Inspector QC' : '<i class="icon cil-window"></i> Tambah Inspector QC') ?>
<form method="post" class="p-2">

    <!-- Informasi Utama -->
    <div class="card mb-3">
        <div class="card-header py-2">
            <strong>Informasi Utama</strong>
        </div>
        <div class="card-body row g-3">
            <div class="col-md-4">
                <?= bs_floating_input('tanggal', 'date', isset($row) ? $row->tanggal : ''); ?>
            </div>
            <div class="col-md-4">
                <?= bs_floating_select('machines_id', $list_machines, (isset($row) ? $row->machines_id : ''), 'kd_machine', ['class' => 'select2-init'], 'Mesin'); ?>
            </div>
            <div class="col-md-4">
                <?php 
                    $list_shift = ['1' => 'Shift 1', '2' => 'Shift 2', '3' => 'Shift 3'];
                    echo bs_floating_select('shift', $list_shift, (isset($row) ? $row->shift : ''), '', [], 'Shift');
                ?>
            </div>
        </div>
    </div>

    <!-- Detail Masalah -->
    <div class="card mb-3">
        <div class="card-header py-2">
            <strong>Detail Masalah</strong>
        </div>
        <div class="card-body row g-3">
            <div class="col-md-6">
                <?php 
                    $list_phase = [
                        '1'   => '1',
                        '2'    => '2',
                        '3'  => '3',
                        '5'=> '5',
                        '6'=> '6',
                        '7'=> '7',
                        '8'=> '8',
                        '9'=> '9',
                        '10'=> '10',
                        '11'=> '11',
                    ];
                    echo bs_floating_select('phase', $list_phase, (isset($row) ? $row->phase : ''), '', [], 'Phase');
                ?>
            </div>
            <div class="col-md-6">
                <?= bs_floating_input('problem', 'text', isset($row) ? $row->problem : ''); ?>
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi Masalah</label>
                <textarea name="problem_description" class="form-control" rows="3"><?= isset($row) ? $row->problem_description : '' ?></textarea>
            </div>
        </div>
    </div>

    <!-- Waktu Penanganan, Operator & Solusi -->
    <div class="card mb-3">
        <div class="card-header py-2">
            <strong>Waktu Penanganan, Operator & Solusi</strong>
        </div>
        <div class="card-body row g-3">
            <div class="col-md-4">
                <?= bs_floating_input('report_time', 'time', isset($row) ? $row->report_time : ''); ?>
            </div>
            <div class="col-md-4">
                <?= bs_floating_input('handle_time', 'time', isset($row) ? $row->handle_time : ''); ?>
            </div>
            <div class="col-md-4">
                <?= bs_floating_input('end_time', 'time', isset($row) ? $row->end_time : ''); ?>
            </div>
            <div class="col-md-6">                
                <?= bs_floating_select('operator_id', $list_operators, (isset($row) ? $row->operator_id : ''), 'operator_id', ['class' => 'select2-init'], 'Operators'); ?>

            </div>
            <div class="col-md-6">
                <textarea name="solution_descrtiption" class="form-control" rows="3" ><?= isset($row) ? $row->solution_descrtiption : '' ?></textarea>
            </div>
        </div>
    </div>

    <!-- Status -->
    <div class="card mb-3">
        <div class="card-header py-2">
            <strong>Status</strong>
        </div>
        <div class="card-body row g-3">
           <div class="col-md-6">
                <?php 
                    $list_status_prob = [
                        
                        'OK'=> 'OK',
                        'NOT OK'=> 'NOT OK',
                    ];
                    echo bs_floating_select('status_problem', $list_status_prob, (isset($row) ? $row->status_problem : ''), '', [], 'Status Problem');
                ?>
            </div>
            <div class="col-md-6">
                <?php 
                    $list_status_prod = [
                        
                        'PASS'=> 'PASS',
                        'REJECT'=> 'REJECT',
                    ];
                    echo bs_floating_select('status_produk', $list_status_prod, (isset($row) ? $row->status_produk : ''), '', [], 'Status Produk');
                ?>            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-4 text-end">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" title="Simpan Data">
                <i class="icon cil-save"></i> Simpan
            </button>
            <a href="<?= site_url('inspector_qc') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" title="Kembali ke List Data">
                <i class="icon cil-reload"></i> Kembali
            </a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" title="Kembali ke Halaman Utama">
                <i class="icon cil-home"></i>
            </a>
        </div>
    </div>

</form>
<?= card_close() ?>

<?= card_open(isset($row) ? '<i class="icon cil-factory"></i> Edit Produksi' : '<i class="icon cil-factory"></i> Tambah Produksi') ?>
<form method="post" id="form-produksi">

    <?= bs_floating_input('tanggal', 'date', (isset($row) ? $row->tanggal : '')); ?>
    <?= bs_floating_select('operators_id', $operator_options, (isset($row) ? $row->operators_id : '')); ?>
    <?= bs_floating_select('shift', ['1'=>'Shift 1','2'=>'Shift 2','3'=>'Shift 3'], (isset($row) ? $row->shift : '')); ?>
    <?= bs_floating_select('kd_ms', $mesin_options, (isset($row) ? $row->kd_ms : '')); ?>
    <?= bs_floating_select('no_spk', $spk_options, (isset($row) ? $row->no_spk : '')); ?>

    <hr>
    <div id="spk-target" class="mb-3" style="display:none;">
    <h5>Target SPK</h5>
    <ul>
        <li>Per Jam: <span id="target-per-jam"></span></li>
        <li>Per Shift: <span id="target-per-shift"></span></li>
        <li>Per Hari: <span id="target-per-day"></span></li>
    </ul>
</div>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="prodTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="prod-tab" data-bs-toggle="tab" data-bs-target="#tab-produksi" type="button" role="tab">Produksi Per Jam</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="downtime-tab" data-bs-toggle="tab" data-bs-target="#tab-downtime" type="button" role="tab">Downtime</button>
      </li>
    
    </ul>

    <!-- Tab panes -->
    <div class="tab-content mt-3">
      <div class="tab-pane fade show active" id="tab-produksi" role="tabpanel">
        <?php
        $headers = ['Jam','Pass','Finish','Hold','Reject'];
        $columns = ['jam','pass','finish','hold','reject_btn'];

        $column_types = [
            'jam' => 'time',
            'pass' => 'number',
            'finish' => 'number',
            'hold' => 'number',
            'reject_btn' => 'button'
        ];

        $column_attributes = [
            'reject_btn' => [
                'class' => 'btn btn-sm btn-primary btn-reject',
                'data-bs-toggle' => 'modal',
                'data-bs-target' => '#rejectModal',
                'value' => '+ Tambah Reject'
            ]
        ];

        $details = isset($produksi_details) ? $produksi_details : [];
        echo table_form_detail_generic('prodDetailTable', $headers, $columns, $details, $column_types, [], $column_attributes);
        ?>
      </div>

      <div class="tab-pane fade" id="tab-downtime" role="tabpanel">
        <?php
        $headers = ['Jam Mulai','Jam Selesai','Jenis','Keterangan','Aksi'];
        $columns = ['jam_mulai','jam_selesai','jenis','keterangan','action'];

        $column_types = [
            'jam_mulai' => 'time',
            'jam_selesai' => 'time',
            'jenis' => 'select2',
            'keterangan' => 'text',
            'action' => 'text'
        ];

        $select_options = [
            'jenis' => $downtime_options
        ];

        $details = isset($downtime_details) ? $downtime_details : [];
        echo table_form_detail_generic('downtimeTable', $headers, $columns, $details, $column_types, $select_options);
        ?>
      </div>
    </div>

    <div class="mt-3">
        <div class="btn-group">
            <button type="submit" class="btn btn-success"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('produksi') ?>" class="btn btn-secondary"><i class="icon cil-reload"></i> Kembali</a>
        </div>
        <button type="button" class="btn btn-warning float-end">End Shift</button>
    </div>

</form>
<?= card_close() ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="<?= base_url('assets/js/grid-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-autofill.js') ?>"></script>
<script src="<?= base_url('assets/js/calc-grid.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    if ($("#prodDetailTable").length) $("#prodDetailTable").gridHelper();
    if ($("#downtimeTable").length) $("#downtimeTable").gridHelper();

    $('#prodTabs button').each(function() {
        var tabTrigger = new bootstrap.Tab(this);
        $(this).click(function(e){
            e.preventDefault();
            tabTrigger.show();
        });
    });

   $('#no_spk').change(function() {
    var id_spk = $(this).val(); 
    if(id_spk) {
        $.ajax({
            url: '<?= site_url("prod_utama/get_target") ?>/' + id_spk,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#spk-target').show();
                $('#target-per-jam').text(data.per_jam);
                $('#target-per-shift').text(data.per_shift);
                $('#target-per-day').text(data.per_day);
            }
        });
    } else {
        $('#spk-target').hide();
    }
});

});
</script>

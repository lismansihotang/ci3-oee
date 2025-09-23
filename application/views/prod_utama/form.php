<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/floating-select2.css') ?>">

<?= card_open(isset($row) ? '<i class="icon cil-factory"></i> Edit Produksi' : '<i class="icon cil-factory"></i> Tambah Produksi') ?>
<form method="post" id="form-produksi">

    <?= bs_floating_input('tanggal', 'date', (isset($row) ? $row->tanggal : date('Y-m-d'))); ?>
    <?= bs_floating_select('operators_id', $operator_options, (isset($row) ? $row->operators_id : ''), 'operators_id', ['class' => 'select2-init']); ?>
    <?= bs_floating_select('shift', ['1' => 'Shift 1', '2' => 'Shift 2', '3' => 'Shift 3'], (isset($row) ? $row->shift : ''), 'shift', ['class' => 'select2-init']); ?>
    <?= bs_floating_select('kd_ms', $mesin_options, (isset($row) ? $row->kd_ms : ''), 'kd_ms', ['class' => 'select2-init']); ?>
    <?= bs_floating_select('no_spk', $spk_options, (isset($row) ? $row->no_spk : ''), 'no_spk', ['class' => 'select2-init']); ?>

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
            $headers = ['Jam', 'Pass', 'Finish', 'Hold', 'Reject'];
            $columns = ['jam', 'pass', 'finish', 'hold', 'reject_btn'];

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

            //var_dump($produksi_details);
            $details = isset($produksi_details) ? $produksi_details : [];
            echo table_form_detail_generic('prodDetailTable', $headers, $columns, $details, $column_types, [], $column_attributes);
            ?>
        </div>

        <div class="tab-pane fade" id="tab-downtime" role="tabpanel">
            <?php
            $headers = ['Jam Mulai', 'Jam Selesai', 'Jenis', 'Keterangan', 'Aksi'];
            $columns = ['jam_mulai', 'jam_selesai', 'jenis', 'keterangan', 'action'];

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

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url('assets/js/ajax-generic.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/grid-autofill.js') ?>"></script>
<script src="<?= base_url('assets/js/calc-grid.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr_config.js') ?>"></script>
<script src="<?= base_url('assets/js/cell-factory.js') ?>"></script>
<script src="<?= base_url('assets/js/shift-table.js') ?>"></script>


<script>
    $(document).ready(function() {
        if ($("#prodDetailTable").length) $("#prodDetailTable").gridHelper();
        if ($("#downtimeTable").length) $("#downtimeTable").gridHelper();

        $('#no_spk').change(function() {
            var id_spk = $(this).val();
            if (id_spk) {
                ajaxRequest('<?= site_url("prod_utama/get_spk_target") ?>/' + id_spk, {
                    onSuccess: function(data) {
                        if (data) {
                            $('#spk-target').show();
                            $('#target-per-jam').text(data.per_jam);
                            $('#target-per-shift').text(data.per_shift);
                            $('#target-per-day').text(data.per_day);
                        }
                    },
                });
            } else {
                $('#spk-target').hide();
            }
        });

        // Init Select2
        $(".select2-init").select2({
            theme: "bootstrap-5",
            width: '100%'
        });

        // Konfigurasi kolom untuk tabel produksi
        const prodColumns = [{
                name: "jam",
                type: "time"
            },
            {
                name: "pass",
                type: "number"
            },
            {
                name: "finish",
                type: "number"
            },
            {
                name: "hold",
                type: "number"
            },
            {
                name: "reject_btn",
                type: "button",
                text: "+ Tambah Reject",
                class: "btn btn-sm btn-primary btn-reject",
                attrs: {
                    "data-bs-toggle": "modal",
                    "data-bs-target": "#rejectModal"
                }
            },
            {
                name: "remove_btn",
                type: "button",
                text: "<i class=\"icon cil-minus\"></i>",
                class: "btn btn-danger btn-sm remove-row-btn",
                attrs: {}
            }
        ];

        // Custom shiftConfig (opsional, override default)
        const customShiftConfig = {
            "1": {
                start: 7,
                end: 15
            }, // contoh: 07:00–15:00
            "2": {
                start: 15,
                end: 23
            }, // contoh: 15:00–23:00
            "3": {
                start: 23,
                end: 7
            } // contoh: 23:00–07:00 (perlu handle span midnight)
        };

        // Binding shift → generate row tabel
        $(document).on('change keyup', '#shift', function() {
            $("#prodDetailTable").generateShiftRows({
                shift: $(this).val(),
                columns: prodColumns,
                shiftConfig: customShiftConfig,
                force24h: true
            });
        });

        // Init default shift (edit mode)
        const defaultShift = $("#shift").val();
        if (defaultShift) {
            $("#prodDetailTable").generateShiftRows({
                shift: defaultShift,
                columns: prodColumns,
                shiftConfig: customShiftConfig,
                force24h: true
            });
        }
    });
</script>
<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/floating-select2.css') ?>">

<?= card_open(isset($row) ? '<i class="icon cil-factory"></i> Edit Produksi' : '<i class="icon cil-factory"></i> Tambah Produksi') ?>
<form action="<?= site_url('/prod_utama/save'); ?>" method="post" id="form-produksi">

    <div class="row">
        <div class="col-7">
            <input type="hidden" name="prod_id" value="<?= isset($row->id) ? $row->id : ''; ?>" />
            <?= bs_floating_input('tanggal', 'date', (isset($row) ? $row->tanggal : date('Y-m-d'))); ?>
            <?= bs_floating_select('operators_id', $operator_options, (isset($row) ? $row->operators_id : ''), 'operators_id', ['class' => 'select2-init']); ?>
            <?= bs_floating_select('sh', ['1' => 'Shift 1', '2' => 'Shift 2', '3' => 'Shift 3'], (isset($shift) ? $shift : ''), 'shift', ['class' => 'select2-init']); ?>
            <?= bs_floating_select('kd_ms', $mesin_options, (isset($row) ? $row->kd_ms : ''), 'kd_ms', ['class' => 'select2-init']); ?>
            <div class="div-phase">

            </div>
            <?= bs_floating_select('no_spk', $spk_options, (isset($row) ? $row->no_spk : ''), 'no_spk', ['class' => 'select2-init']); ?>
        </div>
        <div class="col-5">
            <div class="row">
                <div class="col-12">
                    <div id="spk-target" class="card border-primary mb-3" style="display:none;">
                        <div class="card-header bg-primary text-white">🎯 Target SPK</div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Per Jam: <span id="target-per-jam"></span></li>
                                <li>Per Shift: <span id="target-per-shift"></span></li>
                                <li>Per Hari: <span id="target-per-day"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div id="spk-summary" class="card border-success mb-3" style="display:none;">
                        <div class="card-header bg-success text-white">📊 Hasil Produksi (Shift)</div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>Total Pass (Aktual): <span id="sum-pass">0</span></li>
                                <li>Total Reject: <span id="sum-reject">0</span></li>
                                <li>Total Hold: <span id="sum-hold">0</span></li>
                                <li>Persentase Pencapaian: <span id="sum-percent">0%</span></li>
                                <li>Persentase Reject: <span id="sum-reject-percent">0%</span></li>
                                <li>Persentase Downtime: <span id="sum-downtime-percent">0%</span></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="prodTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="prod-tab" data-bs-toggle="tab" data-bs-target="#tab-produksi" type="button" role="tab">Produksi Per Jam</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="downtime-tab" data-bs-toggle="tab" data-bs-target="#tab-downtime" type="button" role="tab">Downtime</button>
        </li>

    </ul>
    <div id="summary-hidden"></div>
    <div id="reject-hidden-container"></div>
    <!-- Tab panes -->
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="tab-produksi" role="tabpanel">
            <?php
            $headers = ['Jam', 'Pass',   'Reject', 'Hold'];
            $columns = ['jam', 'pass_qty',  'reject_btn', 'hold_qty'];

            $column_types = [
                'jam' => 'time',
                'pass_qty' => 'number',
                //'finish' => 'number',
                'reject_btn' => 'button',
                'hold_qty' => 'number',
                'id'        => 'hidden',
            ];

            $column_attributes = [
                'id' => ['row-id-field' => true],
                'reject_btn' => [
                    'class' => 'btn btn-sm btn-primary btn-reject',
                    'data-bs-toggle' => 'modal',
                    'data-bs-target' => '#rejectModalTemplate',
                    'data-detail-id' => '{id}',
                    'value' => '+ Tambah Reject'
                ]
            ];

            $details = isset($produksi_details) ? $produksi_details : [];
            //var_dump($details);
            echo table_form_detail_generic('prodDetailTable', $headers, $columns, $details, $column_types, [], $column_attributes);
            ?>
        </div>

        <div class="tab-pane fade" id="tab-downtime" role="tabpanel">
            <?php
            $headers = ['Jam Mulai', 'Jam Selesai', 'Jenis', 'Keterangan', 'Perbaikan',];
            $columns = ['jam_mulai', 'jam_selesai', 'jenis', 'keterangan', 'action',];

            $column_types = [
                'jam_mulai' => 'time',
                'jam_selesai' => 'time',
                'jenis' => 'select2',
                'keterangan' => 'text',
                'action' => 'text',
            ];

            $column_attributes = [
                'jam_mulai'   => ['display' => 'input'],      // editable input type="time"
                'jam_selesai' => ['display' => 'input'],
            ];

            $select_options = [
                'jenis' => $downtime_options
            ];

            $details = isset($downtime_details) ? $downtime_details : [];
            echo table_form_detail_generic('downtimeTable', $headers, $columns, $details, $column_types, $select_options, $column_attributes);

            ?>
        </div>
    </div>

    <div class="mt-3">
        <div class="btn-group">
            <button type="submit" class="btn btn-success"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('prod_utama') ?>" class="btn btn-secondary"><i class="icon cil-reload"></i> Kembali</a>
        </div>
        <!-- <button type="button" class="btn btn-warning float-end">End Shift</button> -->
    </div>

</form>
<?= card_close() ?>
<?php
$this->load->helper('modal');

$reject_headers = ['Jenis Reject',  'Qty'];
$reject_columns = ['jenis_reject', 'qty_reject'];

$reject_column_types = [
    'jenis_reject' => 'select2',
    'qty_reject' => 'number',
];

$reject_column_attributes = [];

$reject_select_options = [
    'jenis_reject' => $reject_options
];

$reject_details = [];
$content_reject_modal = table_form_detail_generic('rejectTables', $reject_headers, $reject_columns, $reject_details, $reject_column_types, $reject_select_options, $reject_select_options);

echo modal_template(
    'rejectModalTemplate',
    'Tambah Reject',
    $content_reject_modal,
    '<button type="submit" class="btn btn-success">Simpan Reject</button>
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>',
    'reject-form'
);
?>

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
<script src="<?= base_url('assets/js/prod-reject-helper.js') ?>"></script>
<script src="<?= base_url('assets/js/prod-summary-helper.js') ?>"></script>

<script>
    let shiftData = {}; // simpan ringkasan per shift
    let currentRow = null;

    $(document).ready(function() {
        if ($("#prodDetailTable").length) $("#prodDetailTable").gridHelper();
        if ($("#downtimeTable").length) $("#downtimeTable").gridHelper();

        // === Target SPK ===
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

        // === Select2 ===
        $(".select2-init").select2({
            theme: "bootstrap-5",
            width: '100%'
        });

        // === Konfigurasi kolom produksi ===
        const prodColumns = [{
                name: "jam",
                type: "time",
                display: "readonly"
            },
            {
                name: "pass_qty",
                type: "number",
                defaultValue: 0
            },
            {
                name: "reject_btn",
                type: "button",
                text: "+ Tambah Reject",
                class: "btn btn-sm btn-primary btn-reject",
                attrs: {
                    "data-bs-toggle": "modal",
                    "data-bs-target": "#rejectModalTemplate"
                }
            },
            {
                name: "hold_qty",
                type: "number",
                defaultValue: 0
            },
            {
                name: "save_btn",
                type: "button",
                text: "<i class='icon cil-save'></i>",
                class: "btn btn-success btn-sm save-row-btn",
                attrs: {}
            },
            // {
            //     name: "edit_btn",
            //     type: "button",
            //     text: "<i class='icon cil-pencil'></i>",
            //     class: "btn btn-warning btn-sm edit-row-btn",
            //     attrs: {}
            // }
        ];

        // === Config shift ===
        const customShiftConfig = {
            "1": {
                start: 8,
                end: 16
            },
            "2": {
                start: 16,
                end: 24
            },
            "3": {
                start: 0,
                end: 8
            }
        };

        // === Ganti Shift ===
        $(document).on('change', '#shift', function() {
            let shiftVal = $(this).val();

            saveShiftSummary(); // simpan dulu ringkasan shift lama

            // generate tabel sesuai shift
            $("#prodDetailTable").generateShiftRows({
                shift: shiftVal,
                columns: prodColumns,
                shiftConfig: customShiftConfig,
                refresh: true,
                clearMode: "all"
            });

            loadShiftSummary(shiftVal); // tampilkan ringkasan shift terpilih
        });

        $("#no_spk").trigger("change");

        $(document).on("change", "#kd_ms", function() {
            ajaxRequest('<?= site_url("prod_utama/get_jenis_mesin") ?>/' + $(this).val(), {
                onSuccess: function(data) {
                    let $div = $(".div-phase");
                    $div.empty();
                    if (data && data === 'stamping') {
                        // Buat wrapper form-floating
                        let $wrapper = $('<div>', {
                            class: 'form-floating mb-2'
                        });

                        // Buat select
                        let $select = $('<select>', {
                            name: 'phase',
                            id: 'phase',
                            class: 'form-select select2-init',
                            'aria-label': 'Phase'
                        });

                        // Tambahkan options 1–15
                        for (let i = 1; i <= 15; i++) {
                            $select.append(
                                $("<option>", {
                                    value: i,
                                    text: i
                                })
                            );
                        }

                        // Buat label
                        let $label = $('<label>', {
                            for: 'phase',
                            text: 'Phase'
                        });

                        // Masukkan select + label ke wrapper
                        $wrapper.append($select).append($label);

                        // Append ke div-phase
                        $div.append($wrapper);

                        // Re-init select2
                        $select.select2({
                            theme: "bootstrap-5",
                            width: '100%'
                        });
                    }
                },
            });
        });

    });

    $(function() {
        $.rejectHelper.init(); // => bind + update semua tombol berdasarkan hidden input
    });

    // OR jika Anda belum me-render hidden inputs dan ingin inject dari JSON:
    const rejectDetails = <?= $reject_details_json ?? '{}' ?>;
    // contoh bentuk rejectDetails: { "17": [{jenis_reject:"3",qty_reject:"10"}, ...], "20": [...] }
    for (let rowId in rejectDetails) {
        $.rejectHelper.saveToHidden(rowId, rejectDetails[rowId]);
    }
    // lalu inisialisasi tombol (agar tombol yg ada di tabel ikut diperbarui)
    $.rejectHelper.bindEvents();

    // aktifkan summary handler
    $.summaryHelper.init({
        prodTable: "#prodDetailTable",
        downTable: "#downtimeTable",
        targetEl: "#target-per-shift",
        shiftEl: "#shift",
        summaryEl: "#spk-summary",
        hiddenContainer: "#summary-hidden"
    });

    // === Simpan ringkasan shift aktif ===
    function saveShiftSummary() {
        let shiftVal = $("#shift").val();
        if (!shiftVal) return;

        shiftData[shiftVal] = {
            pass: $("#sum-pass").text(),
            reject: $("#sum-reject").text(),
            hold: $("#sum-hold").text(),
            percent: $("#sum-percent").text(),
            rejectPercent: $("#sum-reject-percent").text()
        };
    }

    // === Load ringkasan shift tertentu ===
    function loadShiftSummary(shiftVal) {
        if (shiftData[shiftVal]) {
            let d = shiftData[shiftVal];
            $("#sum-pass").text(d.pass);
            $("#sum-reject").text(d.reject);
            $("#sum-hold").text(d.hold);
            $("#sum-percent").text(d.percent);
            $("#sum-reject-percent").text(d.rejectPercent);
            $("#spk-summary").show();
        } else {
            $("#sum-pass").text("0");
            $("#sum-reject").text("0");
            $("#sum-hold").text("0");
            $("#sum-percent").text("0%");
            $("#sum-reject-percent").text("0%");
            $("#spk-summary").hide();
        }
    }
</script>
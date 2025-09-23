<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/floating-select2.css') ?>">

<?= card_open('<i class="icon cil-window"></i> Surat Perintah Kerja') ?>
<form method="post">
    <div class="row">
        <div class="col-6">
            <?= bs_floating_input('no_spk', 'text', (isset($row) ? $row->no_spk : ''), null, 'no_spk', [], 'No. SPK'); ?>
            <?= bs_floating_select('kd_machine', $list_machines, (isset($row) ? $row->no_spk : ''), 'kd_machine', ['class' => 'select2-init'], 'Mesin'); ?>
            <?= bs_floating_select('no_po', $list_po, (isset($row) ? $row->no_spk : ''), 'no_po', ['class' => 'select2-init'], 'No. PO'); ?>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="kd_product_display" value="<?= isset($row) ? $row->kd_product . ' - ' . $row->nama_produk : '-' ?>" readonly>
                <label for="kd_product_display">Produk</label>
            </div>
            <input type="hidden" name="kd_product" id="kd_product" value="<?= isset($row) ? $row->kd_product : '' ?>">
            <?= bs_floating_input('no_mould', 'text', (isset($row) ? $row->no_mould : ''), null, 'no_mould', [], 'No. Mould'); ?>
            <?= bs_floating_input('jml_ord', 'number', (isset($row) ? $row->jml_ord : ''), null, 'jml_ord', [], 'Jumlah Order (Pcs)'); ?>
            <?= bs_floating_input('tgl_mulai', 'date', (isset($row) ? $row->tgl_mulai : ''), null, 'tgl_mulai', [], 'Tanggal Mulai'); ?>
            <?= bs_floating_input('tgl_selesai', 'date', (isset($row) ? $row->tgl_selesai : ''), null, 'tgl_selesai', [], 'Tanggal Selesai'); ?>
            <?= bs_floating_textarea('keterangan', (isset($row) ? $row->keterangan : ''), null, 'keterangan', null, 'Keterangan'); ?>
            <?= bs_floating_select('status', ['open' => 'Aktif', 'closed' => 'Selesai'], (isset($row) ? $row->status : ''), 'status', [], 'Status'); ?>
        </div>
        <div class="col-6">
            <?= card_open('<i class="icon cil-settings"></i> Detail Produksi', ['class' => 'border-info']) ?>
            <?= bs_floating_input('cavity', 'text', (isset($row) ? $row->cavity : ''), null, null, [], 'Cavity'); ?>
            <?= bs_floating_input('ct', 'text', (isset($row) ? $row->ct : ''), null, null, [], 'Cycle Time (Produksi)'); ?>
            <?= bs_floating_input('ct_print', 'text', (isset($row) ? $row->ct_print : ''), null, null, [], 'Cycle Time (Printing)'); ?>
            <?= bs_floating_input('ct_stamp', 'text', (isset($row) ? $row->ct_stamp : ''), null, null, [], 'Cycle Time (Stamping)'); ?>
            <?= card_close() ?>
            <?= card_open('<i class="icon cil-settings"></i> Target Produksi', ['class' => 'border-primary']) ?>
            <p class="mt-1 mb-0">T/Jam</p>
            <div class="row">
                <div class="col-4">
                    <?= bs_floating_input('tjam', 'number', (isset($row) ? $row->tjam : ''), null, 'tjam', [], 'Produksi'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('print_jam', 'number', (isset($row) ? $row->printjam : ''), null, 'print_jam', [], 'Printing'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('stamp_jam', 'number', (isset($row) ? $row->stampjam : ''), null, 'stamp_jam', [], 'Stamping'); ?>
                </div>
            </div>

            <p class="mt-1 mb-0">T/Shift</p>
            <div class="row">
                <div class="col-4">
                    <?= bs_floating_input('tshift', 'number', (isset($row) ? $row->tshift : ''), null, 'tshift', [], 'Produksi'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('print_shift', 'number', (isset($row) ? $row->printshift : ''), null, 'print_shift', [], 'Printing'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('stamp_shift', 'number', (isset($row) ? $row->stampshift : ''), null, 'stamp_shift', [], 'Stamping'); ?>
                </div>
            </div>

            <p class="mt-1 mb-0">T/Day</p>
            <div class="row">
                <div class="col-4">
                    <?= bs_floating_input('tday', 'number', (isset($row) ? $row->tday : ''), null, 'tday', [], 'Produksi'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('print_day', 'number', (isset($row) ? $row->printday : ''), null, 'print_day', [], 'Printing'); ?>
                </div>
                <div class="col-4">
                    <?= bs_floating_input('stamp_day', 'number', (isset($row) ? $row->stampday : ''), null, 'stamp_day', [], 'Stamping'); ?>
                </div>
            </div>

            <?= card_close() ?>
        </div>
    </div>

    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('spk') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
        </div>
    </div>

</form>
<?= card_close() ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr_config.js') ?>"></script>
<script src="<?= base_url('assets/js/ajax-generic.js') ?>"></script>
<script src="<?= base_url('assets/js/calc-spk.js') ?>"></script>

<script>
    $(document).ready(function() {
        // Hitung SPK
        $(document).initSpkForm({
            urlPoDetail: "<?= site_url('spk/get_po_detail/') ?>",
            config: {
                cavity: '#cavity',
                processes: [{
                        cycle: '#ct',
                        prefix: 't'
                    },
                    {
                        cycle: '#ct_print',
                        prefix: 'print'
                    },
                    {
                        cycle: '#ct_stamp',
                        prefix: 'stamp'
                    }
                ],
                order: '#jml_ord',
                startDate: '#tgl_mulai',
                endDate: '#tgl_selesai',
                jamPerShift: 8,
                shiftPerHari: 3
            }
        });

        // Init Select2
        $(".select2-init").select2({
            theme: "bootstrap-5",
            width: '100%'
        });
    });
</script>
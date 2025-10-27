<link rel="stylesheet" href="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.css') ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/css/floating-select2.css') ?>">

<?= card_open(isset($row) ? '<i class="icon cil-window"></i> Edit QC' : '<i class="icon cil-window"></i> Tambah QC') ?>
<form action="<?= site_url('/prod_qc/save'); ?>" method="post">
    <?= bs_floating_input('tanggal', 'date', (isset($row) ? $row->tanggal : date('Y-m-d'))); ?>
    <?= bs_floating_select('prod_id', $product_options, (isset($row) ? $row->prod_id : ''), 'prod_id', ['class' => 'select2-init'], 'Products'); ?>
    <?= bs_floating_select('kd_ms', $mesin_options, (isset($row) ? $row->kd_ms : ''), 'kd_ms', ['class' => 'select2-init'], 'Mesin'); ?>
    <div class="table-responsive">
        <div class="content_qc"><?= isset($qc_html) ? $qc_html : '' ?></div>
    </div>
    <div class="mt-3">
        <div class="btn-group" role="group" aria-label="FormCreateUpdate">
            <button type="submit" class="btn btn-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Simpan Data Sekarang"><i class="icon cil-save"></i> Simpan</button>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke List Data"><i class="icon cil-reload"></i> Kembali</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-dark" data-coreui-toggle="tooltip" data-coreui-placement="top" title="< Kembali ke Halaman Utama"><i class="icon cil-home"></i></a>
        </div>
    </div>
</form>
<?= card_close() ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url('assets/js/ajax-generic.js') ?>"></script>
<script src="<?= base_url('assets/node_modules/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/js/flatpickr_config.js') ?>"></script>
<script>
    $(document).ready(function() {
        let kd_prod = 0;
        let kd_ms = 0;
        let baseUrl = "<?= site_url('prod_qc/get_qc_ajax') ?>/";

        // Init Select2
        $(".select2-init").select2({
            theme: "bootstrap-5",
            width: '100%'
        });

        // Re-init helpers after injecting HTML
        function reinitInjectedContent(container) {
            // 1) Initialize Select2 inside injected content (if any select2 elements)
            $(container).find('.select2-init').each(function() {
                if (!$(this).data('select2')) {
                    $(this).select2({
                        theme: "bootstrap-5",
                        width: '100%'
                    });
                }
            });

            // 2) Re-enable tooltips (CoreUI uses data-coreui-*, bootstrap uses data-bs-*)
            // If you use bootstrap tooltips:
            var tooltipTriggerList = [].slice.call((container).querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(el) {
                return new bootstrap.Tooltip(el);
            });

            // 3) Ensure collapse instances exist for all accordion-collapse in container
            (container).querySelectorAll('.accordion-collapse').forEach(function(el) {
                // If instance exists, fine; otherwise create with toggle: false so initial state preserved
                if (!bootstrap.Collapse.getInstance(el)) {
                    new bootstrap.Collapse(el, {
                        toggle: false
                    });
                }
            });

            // Optional: if you want "auto-collapse others when clicking" and generate_accordion
            // already used data-bs-parent then bootstrap handles it; otherwise you can add custom:
            // (we avoid overriding default behaviour unless necessary)
        }

        function buildUrl(prod, ms) {
            prod = prod || 0;
            ms = ms || 0;
            // build to /controller/get_qc_ajax/{prod}/{ms}
            return baseUrl + '/' + prod + '/' + ms;
        }

        function handleResponseInject(html) {
            // inject HTML into container
            $(".content_qc").html(html);

            // re-init stuff inside .content_qc
            reinitInjectedContent(document.querySelector('.content_qc'));
        }

        $("#prod_id").on("change keyup", function() {
            kd_prod = $(this).val() || 0;
            kd_ms = $("#kd_ms").val() || 0;
            let url = buildUrl(kd_prod, kd_ms);

            if (kd_prod !== null) {
                ajaxRequest(url, {
                    onSuccess: function(data) {
                        if (data) {
                            if (data) {
                                // If server returns JSON with html field:
                                if (typeof data === 'object' && data.html) {
                                    handleResponseInject(data.html);
                                } else {
                                    // assume HTML string
                                    handleResponseInject(data);
                                }
                            }
                        }
                    },
                });
            }
            console.log("Selected kd_prod: " + kd_prod);
        });

        $("#kd_ms").on("change keyup", function() {
            kd_ms = $(this).val() || 0;
            kd_prod = $("#kd_prod").val() || 0;
            let url = buildUrl(kd_prod, kd_ms);

            if (kd_ms !== null) {
                ajaxRequest(url, {
                    onSuccess: function(data) {
                        if (data) {
                            if (typeof data === 'object' && data.html) {
                                handleResponseInject(data.html);
                            } else {
                                handleResponseInject(data);
                            }
                        }
                    },
                });
            }
            console.log("Selected kd_ms: " + kd_ms);
        });
    });
</script>
<?= card_open('<i class="icon cil-window"></i> Surat Perintah Kerja') ?>
<form method="post">

    <!-- NO SPK -->
    <div class="form-group mb-3">
        <label for="no_spk">No. SPK</label>
        <input type="text" id="no_spk" name="no_spk" class="form-control" 
               value="<?= isset($row) ? $row->no_spk : '' ?>">
    </div>

    <!-- MESIN -->
    <div class="form-group mb-3">
        <label for="kd_machine">Mesin</label>
        <select id="kd_machine" name="kd_machine" class="form-control select2-init">
            <?php foreach ($list_machines as $id => $machine_label): ?>
                <option value="<?= $id ?>" <?= isset($row) && $row->kd_machine == $id ? 'selected' : '' ?>>
                    <?= $machine_label ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- PO & Produk -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="no_po">No. PO</label>
            <select id="no_po" name="no_po" class="form-control select2-init">
                <?php foreach ($list_po as $po_id => $po_label): ?>
                    <option value="<?= $po_id ?>" <?= isset($row) && $row->no_po == $po_id ? 'selected' : '' ?>>
                        <?= $po_label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="kd_product">Produk</label>
            <!-- Hidden untuk database -->
<input type="hidden" name="kd_product" id="kd_product" value="<?= isset($row) ? $row->kd_product : '' ?>">

<!-- Hanya untuk tampil ke user -->
<input type="text" id="kd_product_display" class="form-control" readonly
       value="<?= isset($row) ? $row->kd_product . ' - ' . $row->nama_produk : '' ?>">
        </div>
    </div>

    <!-- NO MOULD & ORDER -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="no_mould">No. Mould</label>
            <input type="text" id="no_mould" name="no_mould" class="form-control" 
                   value="<?= isset($row) ? $row->no_mould : '' ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="jml_ord">Jumlah Order (Pcs)</label>
            <input type="number" id="jml_ord" name="jml_ord" class="form-control" 
                   value="<?= isset($row) ? $row->jml_ord : '' ?>">
        </div>
    </div>

    <!-- Cavity & Cycle Time -->
    <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2">Detail Produksi</legend>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cavity">Cavity</label>
                <input type="text" id="cavity" name="cavity" class="form-control" readonly 
                       value="<?= isset($row) ? $row->cavity : '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="ct">Cycle Time (Produksi)</label>
                <input type="text" id="ct" name="ct" class="form-control" readonly 
                       value="<?= isset($row) ? $row->ct : '' ?>">
            </div>
          
        </div>

        <div class="row">
            
            <div class="col-md-6 mb-3">
                <label for="ct_print">Cycle Time Printing</label>
                <input type="text" id="ct_print" name="ct_print" class="form-control" 
                       value="<?= isset($row) ? $row->ct_print : '' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="ct_stamp">Cycle Time Stamping</label>
                <input type="text" id="ct_stamp" name="ct_stamp" class="form-control" 
                       value="<?= isset($row) ? $row->ct_stamp : '' ?>">
            </div>
        </div>
    </fieldset>

    <!-- Target -->
    <fieldset class="border p-3 mb-3">
        <legend class="w-auto px-2">Target Produksi</legend>
        <div class="row text-center fw-bold">
            <div class="col-md-4">Produksi</div>
            <div class="col-md-4">Printing</div>
            <div class="col-md-4">Stamping</div>
        </div>

        <div class="row align-items-center mb-2">
            <div class="col-md-2"><label>T/Jam</label></div>
            <div class="col-md-3"><input type="number" name="tjam" id="tjam" value="<?= isset($row) ? $row->tjam : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="print_jam" id="print_jam" value="<?= isset($row) ? $row->print_jam : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="stamp_jam" id="stamp_jam" value="<?= isset($row) ? $row->stamp_jam : '' ?>" class="form-control"></div>
        </div>
        <div class="row align-items-center mb-2">
            <div class="col-md-2"><label>T/Shift</label></div>
            <div class="col-md-3"><input type="number" name="tshift" id="tshift" value="<?= isset($row) ? $row->tshift : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="print_shift" id="print_shift" value="<?= isset($row) ? $row->print_shift : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="stamp_shift" id="stamp_shift" value="<?= isset($row) ? $row->stamp_shift : '' ?>" class="form-control"></div>
        </div>
        <div class="row align-items-center mb-2">
            <div class="col-md-2"><label>T/Day</label></div>
            <div class="col-md-3"><input type="number" name="tday" id="tday" value="<?= isset($row) ? $row->tday : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="print_day" id="print_day" value="<?= isset($row) ? $row->print_day : '' ?>" class="form-control"></div>
            <div class="col-md-3"><input type="number" name="stamp_day" id="stamp_day" value="<?= isset($row) ? $row->stamp_day : '' ?>" class="form-control"></div>
        </div>

    </fieldset>

    <!-- Tanggal -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tgl_mulai">Mulai Produksi</label>
            <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" 
                   value="<?= isset($row) ? $row->tgl_mulai : '' ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tgl_selesai">Selesai Produksi</label>
            <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" 
                   value="<?= isset($row) ? $row->tgl_selesai : '' ?>">
        </div>
    </div>

    <!-- Keterangan -->
    <div class="form-group mb-3">
        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" class="form-control"><?= isset($row) ? $row->keterangan : '' ?></textarea>
    </div>

    <!-- Status -->
    <div class="form-group mb-3">
        <label for="status">Status</label>
        <select id="status" name="status" class="form-control">
            <option value="open" <?= isset($row) && $row->status == 'open' ? 'selected' : '' ?>>Aktif</option>
            <option value="closed" <?= isset($row) && $row->status == 'closed' ? 'selected' : '' ?>>Selesai</option>
        </select>
    </div>

    <!-- Tombol -->
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-secondary">Batal</button>
    </div>

</form>
<?= card_close() ?>




<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Theme Bootstrap-5 untuk Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('#no_po').on('change', function() {
        var id_po = $(this).val();
        console.log("PO dipilih:", id_po);

        if (id_po) {
            $.ajax({
                url: "<?= site_url('spk/get_po_detail/') ?>" + id_po,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Data dari server:", data);

                    if (data) {
                        $('#kd_product').val(data.kd_product);
                        $('#kd_product_display').val(data.kd_product + ' - ' + data.nama_produk);
                        $('#cavity').val(data.cavity);
                        $('#ct').val(data.ct);
                        $('#ct_print').val(data.ct_print);
                        $('#ct_stamp').val(data.ct_stamp);
                        $('#no_mould').val(data.no_mould);

                        // Hanya hitung target ketika PO dipilih
                        hitungTarget();

                        console.log("Set ke input:", 
                            $('#kd_product').val(),
                            $('#cavity').val(),
                            $('#ct').val()
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error:", status, error);
                }
            });
        }
    });

    // Hitung target produksi
    function hitungTarget() {
    let cavity   = parseFloat($('#cavity').val()) || 0;
    let ct       = parseFloat($('#ct').val()) || 0;
    let ctPrint  = parseFloat($('#ct_print').val()) || 0;
    let ctStamp  = parseFloat($('#ct_stamp').val()) || 0;

    // === Target produksi utama ===
    if (cavity > 0 && ct > 0) {
        let tJam   = (3600 / ct) * cavity;
        let tShift = tJam * 8;
        let tDay   = tShift * 3;

        $('#tjam').val(Math.floor(tJam));
        $('#tshift').val(Math.floor(tShift));
        $('#tday').val(Math.floor(tDay));
    }

    // === Target printing ===
    if (cavity > 0 && ctPrint > 0) {
        let pJam   = (3600 / ctPrint) * cavity;
        let pShift = pJam * 8;
        let pDay   = pShift * 3;

        $('#print_jam').val(Math.floor(pJam));
        $('#print_shift').val(Math.floor(pShift));
        $('#print_day').val(Math.floor(pDay));
    }

    // === Target stamping ===
    if (cavity > 0 && ctStamp > 0) {
        let sJam   = (3600 / ctStamp) * cavity;
        let sShift = sJam * 8;
        let sDay   = sShift * 3;

        $('#stamp_jam').val(Math.floor(sJam));
        $('#stamp_shift').val(Math.floor(sShift));
        $('#stamp_day').val(Math.floor(sDay));
    }
}


    // Hitung tanggal selesai produksi
    function hitungTanggalSelesai() {
        let jmlOrder = parseFloat($('#jml_ord').val()) || 0;
        let tDay     = parseFloat($('#tday').val()) || 0;
        let tglMulai = $('#tgl_mulai').val();

        if (jmlOrder > 0 && tDay > 0 && tglMulai) {
            let lamaHari = Math.ceil(jmlOrder / tDay);

            let startDate = new Date(tglMulai);
            startDate.setDate(startDate.getDate() + lamaHari);

            let yyyy = startDate.getFullYear();
            let mm   = String(startDate.getMonth() + 1).padStart(2, '0');
            let dd   = String(startDate.getDate()).padStart(2, '0');
            let hasil = yyyy + '-' + mm + '-' + dd;

            $('#tgl_selesai').val(hasil);
        }
    }

    // Trigger otomatis
    $('#cavity, #ct').on('input change', function() {
        hitungTarget(); // hanya target
    });

    $('#jml_ord, #tgl_mulai').on('input change', function() {
        hitungTanggalSelesai(); // hanya tanggal selesai
    });

});
</script>

<script>
$(document).ready(function() {
    $(".select2-init").select2({
        theme: "bootstrap-5",
        width: '100%' // biar full sesuai parent col-md
    });
});
</script>


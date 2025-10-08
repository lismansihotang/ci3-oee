<div class="card">
    <div class="card-header bg-success text-white">
        <strong>DATA INSPEKSI HARIAN QC</strong>
    </div>
    <div class="card-body p-2">

        <!-- Filter Produk -->
        <div class="mb-3">
            <label for="produk" class="form-label">Produk</label>
           <select name="produk" id="produk" class="form-select">
            <?php foreach ($produk_list as $kd => $label): ?>
                <option value="<?= $kd ?>" <?= ($kd_produk == $kd ? 'selected' : '') ?>>
                    <?= $label ?>
                </option>
            <?php endforeach; ?>
        </select>

        </div>

        <!-- Form QC -->
        <form method="post">
            <table class="table table-bordered table-sm text-center align-middle">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Type of Defect</th>
                        <th>Standard</th>
                        <th>Input</th>
                    </tr>
                </thead>
                <tbody id="qc-table">
                    <?php if (!empty($defects)): ?>
                        <?php $no=1; foreach($defects as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d['label'] ?></td>
                                <td><?= $d['standard'] ?></td>
                                <td>
                                    <input type="text" 
                                           name="hasil[<?= $d['field'] ?>]" 
                                           class="form-control" />
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Pilih produk terlebih dahulu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="cil-save"></i> Simpan
                </button>
                <a href="<?= site_url('prod_qc') ?>" class="btn btn-secondary">
                    <i class="cil-reload"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    function loadDefects(kd_produk){
        if(kd_produk){
            $.ajax({
                url: "<?= site_url('prod_qc/get_defects_ajax') ?>",
                type: "POST",
                data: { kd_produk: kd_produk },
                dataType: "json",
                success: function(res){
                    let html = '';
                    if(res.length > 0){
                        res.forEach((d, i) => {
                            html += `
                                <tr>
                                    <td>${i+1}</td>
                                    <td>${d.label}</td>
                                    <td>${d.standard}</td>
                                    <td><input type="text" name="hasil[${d.field}]" class="form-control" /></td>
                                </tr>
                            `;
                        });
                    } else {
                        html = `<tr><td colspan="4" class="text-center">Tidak ada defect untuk produk ini</td></tr>`;
                    }
                    $('#qc-table').html(html);
                }
            });
        } else {
            $('#qc-table').html(`<tr><td colspan="4" class="text-center">Pilih produk terlebih dahulu</td></tr>`);
        }
    }

    // Auto load jika ada kd_produk yang sudah dipilih
    let selected = $('#produk').val();
    if(selected) loadDefects(selected);

    // On change dropdown
    $('#produk').on('change', function(){
        let kd_produk = $(this).val();
        loadDefects(kd_produk);
    });
});
</script>

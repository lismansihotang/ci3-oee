<h2>Generator Tool</h2>
<form method="post" action="<?= base_url('generatortool/generate') ?>">
    <div class="mb-3">
        <label for="table">Pilih Tabel</label>
        <select name="table" class="form-control" required>
            <option value="">-- pilih tabel --</option>
            <?php foreach ($tables as $t): ?>
                <option value="<?= $t ?>"><?= $t ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Generate</button>
</form>
<div class="container mt-5">
    <h3>CRUD Generator</h3>
    <form method="post" action="<?= site_url('generatortool/create') ?>">
        <div class="mb-3">
            <label for="table" class="form-label">Pilih Tabel</label>
            <select name="table" class="form-control">
                <?php foreach ($tables as $t): ?>
                    <option value="<?= $t ?>"><?= $t ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generate</button>
    </form>
</div>
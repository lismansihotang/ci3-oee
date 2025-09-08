<?= card_open('<i class="icon cil-list"></i> List of Purchase Orders') ?>
    <?= build_index_header('purchase_orders', [
        'search_term' => $search_term,
        'total_rows' => $total_rows,
        'from_rows' => $from_rows,
        'to_rows' => $to_rows,
    ]) ?>
    <?= build_table([
        'headers' => array(
  //'id' => 'Id',
  'no_po' => 'No. PO',
  'tgl_po' => 'Tgl. PO',
  'tgl_kirim' => 'Tgl. Kirim',
  'kd_cust' => 'Kode Cust',
  'nm_cust' => 'Nama Cust',
  /**'ket' => 'Ket',
  'is_deleted' => 'Is_deleted',
  'created_by' => 'Created_by',
  'updated_by' => 'Updated_by',
  'deleted_by' => 'Deleted_by',
  'created_at' => 'Created_at',
  'updated_at' => 'Updated_at',
  'deleted_at' => 'Deleted_at', */
),
        'rows' => $rows,
        'actions' => [
            'view' => 'purchase_orders/view',
            'edit' => 'purchase_orders/edit',
            'delete' => 'purchase_orders/delete'
        ]
    ], $offset) ?>
    <?= $pagination ?>
<?= card_close() ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url('assets/js/sweetalert-helper.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Tangani tombol delete
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault(); // stop default link
            const url = $(this).attr('href');

            SwalHelper.confirm(
                "Apakah Anda yakin ingin menghapus data ini?",
                function() {
                    // jika user pilih YA
                    window.location.href = url; // redirect ke controller delete
                },
                function() {
                    // jika user pilih BATAL, bisa kosong atau console
                    console.log("User batal hapus");
                }
            );
        });
    });
</script>
<?= card_open('<i class="icon cil-list"></i> List of Spk') ?>
<?= build_index_header('spk', [
    'search_term' => $search_term,
    'total_rows' => $total_rows,
    'from_rows' => $from_rows,
    'to_rows' => $to_rows,
]) ?>
<?= build_table([
    'headers' => [
        'no_spk'     => 'No. SPK',
        'nama_mesin' => 'Nama Mesin',
        'nama_produk' => 'Nama Produk',
    ],
    'rows' => $rows,
    'actions' => [
        'view'   => 'spk/view',
        'edit'   => 'spk/edit',
        'delete' => 'spk/delete'
    ]
], $offset) ?>


<?= $pagination ?>
<?= card_close() ?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('build_index_header')) {
    /**
     * Membangun header untuk halaman list (indeks) yang berisi tombol aksi dan form pencarian.
     *
     * @param string $controller_name Nama controller saat ini (misal: 'customers').
     * @param array $options Opsi tambahan (misal: 'search_term', 'total_rows', 'from_rows', 'to_rows').
     * @return string Kode HTML yang siap digunakan di view.
     */
    function build_index_header($controller_name, $options = [])
    {
        $ci = &get_instance();

        // Ambil opsi dari array $options
        $search_term = $options['search_term'] ?? '';
        $total_rows = $options['total_rows'] ?? 0;
        $from_rows = $options['from_rows'] ?? 0;
        $to_rows = $options['to_rows'] ?? 0;

        $html = '<div class="d-flex justify-content-between align-items-center mb-3">';

        // Bagian tombol aksi: Tambah Data dan Kembali
        $html .= '<div class="btn-group" role="group">';
        $html .= '<a href="' . site_url($controller_name . '/create') . '" class="btn btn-primary btn-sm"><i class="icon cil-plus"></i> Tambah Data</a>';
        $html .= '<a href="' . site_url('/') . '" class="btn btn-outline-primary btn-sm"><i class="icon cil-home"></i></a>';
        $html .= '</div>';

        // Bagian form pencarian
        $html .= '<form action="' . site_url($controller_name . '/index') . '" method="get" class="d-flex">';
        $html .= '<div class="input-group input-group-sm">';
        $html .= '<input type="text" class="form-control" placeholder="Cari..." name="q" value="' . html_escape($search_term) . '">';
        $html .= '<button class="btn btn-outline-secondary" type="submit"><i class="icon cil-zoom"></i> Cari Data</button>';

        // Tampilkan tombol reset jika ada kata kunci pencarian
        if (!empty($search_term)) {
            $html .= '<a href="' . site_url($controller_name) . '" class="btn btn-outline-danger"><i class="icon cil-x"></i> Reset</a>';
        }
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';

        // Tampilkan informasi jumlah data jika ada data
        if ($total_rows > 0) {
            $html .= '<p class="text-secondary text-center small mb-2">';
            $html .= "Menampilkan data {$from_rows} - {$to_rows} dari total {$total_rows}";
            $html .= '</p>';
        }

        return $html;
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Helper untuk membuat tabel bootstrap otomatis.
 *
 * @param array $params Parameter untuk konfigurasi tabel.
 * @param int   $offset Nilai offset untuk memulai counter.
 *
 * Contoh penggunaan dengan alias:
 * $params = [
 * 'headers' => [
 * 'id' => 'ID',
 * 'nama_produk' => 'Nama Produk',
 * 'berat_std' => 'Berat Standar',
 * ],
 * 'rows'    => $products, // Ini adalah data dari database
 * 'actions' => [
 * 'view'   => 'products/view',
 * 'edit'   => 'products/edit',
 * 'delete' => 'products/delete',
 * ]
 * ];
 * echo build_table($params, $offset);
 */
if (!function_exists('build_table')) {
    function build_table($params = [], $offset = 0)
    {
        // Pastikan headers adalah array asosiatif,
        // jika tidak, ubah formatnya.
        $headers = $params['headers'] ?? [];
        if (!empty($headers) && is_int(key($headers))) {
            $formatted_headers = [];
            foreach ($headers as $h) {
                $formatted_headers[str_replace(' ', '_', strtolower($h))] = $h;
            }
            $headers = $formatted_headers;
        }

        $rows    = $params['rows'] ?? [];
        $actions = $params['actions'] ?? [];

        $CI = &get_instance();

        $html  = '<div class="table-responsive mb-2"><table class="table border table-hover mb-0">';
        $html .= '<thead class="fw-semibold text-nowrap"><tr class="align-middle">';

        // headers
        $html .= '<th class="bg-body-secondary text-center">#</th>';
        foreach ($headers as $alias) {
            $html .= '<th class="bg-body-secondary">' . htmlspecialchars($alias) . '</th>';
        }
        if (!empty($actions)) {
            $html .= '<th class="bg-body-secondary text-center">Aksi</th>';
        }
        $html .= '</tr></thead><tbody>';

        // isi data
        if (!empty($rows)) {
            $counter = $offset + 1;
            foreach ($rows as $r) {
                $html .= '<tr class="text-center">';
                $html .= '<td>' . htmlspecialchars($counter) . '</td>';

                // Gunakan key dari array headers sebagai nama field
                foreach ($headers as $field_name => $alias) {
                    $value = isset($field_name) ? $r->$field_name : '';
                    $html .= '<td>' . htmlspecialchars($value) . '</td>';
                }

                // kolom aksi
                if (!empty($actions)) {
                    $html .= '<td>';
                    if (isset($actions['view'])) {
                        $html .= '<a href="' . site_url($actions['view'] . '/' . $r->id) . '" class="btn btn-sm btn-info" data-coreui-toggle="tooltip" data-coreui-placement="top" title="View Data Ini"><i class="icon cil-browser"></i> View</a> ';
                    }
                    if (isset($actions['edit'])) {
                        $html .= '<a href="' . site_url($actions['edit'] . '/' . $r->id) . '" class="btn btn-sm btn-warning" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a> ';
                    }
                    if (isset($actions['delete'])) {
                        $html .= '<a href="' . site_url($actions['delete'] . '/' . $r->id) . '" class="btn btn-sm btn-danger btn-delete" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>';
                    }
                    $html .= '</td>';
                }
                $html .= '</tr>';
                $counter++;
            }
        } else {
            $colspan = count($headers) + (!empty($actions) ? 1 : 0);
            $html .= '<tr><td colspan="' . $colspan . '" class="text-center">Tidak ada data</td></tr>';
        }

        $html .= '</tbody></table></div>';

        return $html;
    }
}

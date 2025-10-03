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
            $colspan = (count($headers) + (!empty($actions) ? 1 : 0)) + 1;
            $html .= '<tr><td colspan="' . $colspan . '" class="text-center">Tidak ada data</td></tr>';
        }

        $html .= '</tbody></table></div>';

        return $html;
    }
}


if (!function_exists('build_table_view')) {
    /**
     * Menghasilkan tabel HTML dinamis. Berfungsi ganda:
     * 1. Mode Detail (Single Row): Merender Key-Value (Label | Nilai) jika $data hanya berisi satu objek/array.
     * 2. Mode Tabular (Multiple Rows): Untuk daftar data.
     *
     * @param array $data Array data. Harus berupa array meskipun hanya berisi satu elemen untuk mode detail.
     * @param array $headers_map Array konfigurasi kolom.
     * @param array $attributes HTML attributes untuk tag <table>.
     * @return string HTML table string atau pesan 'No data to display.'.
     */
    function build_table_view($data, $headers_map, $attributes = [])
    {
        if (empty($data) || !is_array($data) || empty($headers_map)) {
            return '<p>No data to display.</p>';
        }

        $is_single_row = (count($data) === 1 && (is_object(reset($data)) || is_array(reset($data))));

        // table attributes
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $attr_string .= ' ' . html_escape($key) . '="' . html_escape($val) . '"';
        }

        $table = '<table' . $attr_string . '>';

        // --- LOGIKA SINGLE ROW (KEY-VALUE / DETAIL) ---
        if ($is_single_row) {

            $row = reset($data); // Ambil objek tunggal
            $table .= '<tbody>';

            foreach ($headers_map as $label => $col) {

                // Konfigurasi kolom
                $property = is_array($col) ? ($col['property'] ?? null) : $col;
                $format = is_array($col) && isset($col['format']) ? $col['format'] : null;
                $params = is_array($col) && isset($col['params']) ? $col['params'] : null;
                $td_class = is_array($col) && isset($col['class']) ? $col['class'] : '';
                $type = is_array($col) && isset($col['type']) ? $col['type'] : 'text'; // Ambil Tipe

                // Akses nilai
                $value = '';
                if ($property) {
                    if (is_object($row) && isset($row->$property)) {
                        $value = $row->$property;
                    } elseif (is_array($row) && isset($row[$property])) {
                        $value = $row[$property];
                    }
                }

                $content = '';

                // PENANGANAN CONTENT (Button, Callback, Wrapper)
                switch ($type) {
                    case 'button':
                        // Asumsi render_button_cell helper tersedia
                        $content = render_button_cell($row, $col);
                        break;

                    case 'callback':
                        if (isset($col['callback']) && is_callable($col['callback'])) {
                            $content = call_user_func($col['callback'], $row, $value);
                        }
                        break;

                    default:
                        // Tipe default (text/wrapper)
                        $content = format_value($value, $format, $params);

                        // PENANGANAN WRAPPER KUSTOM (untuk badge, span, dsb.)
                        if (isset($col['wrapper']) && !empty($col['wrapper'])) {
                            // Menggunakan sprintf untuk mengganti %s dengan nilai
                            $content = sprintf($col['wrapper'], $content);
                        }
                        break;
                }

                $table .= '<tr>';
                $table .= '<th>' . html_escape($label) . '</th>'; // Kolom 1: Label
                $table .= '<td class="' . html_escape($td_class) . '">' . $content . '</td>'; // Kolom 2: Nilai
                $table .= '</tr>';
            }

            $table .= '</tbody></table>';
            return $table; // Mengakhiri fungsi di mode Detail
        }

        // --- LOGIKA MULTIPLE ROW (TABULAR) ---

        // --- DETEKSI & PERATAAN DATA GROUP ---
        $flat_data = [];
        $is_grouped = FALSE;

        if (!empty($data)) {
            $first_group = reset($data);

            if (is_array($first_group)) {
                $first_key = key($data);
                if (!is_numeric($first_key) || (is_numeric($first_key) && is_array($first_group) && count($first_group) > 0 && (is_object(reset($first_group)) || is_array(reset($first_group))))) {
                    $is_grouped = TRUE;
                }
            }
        }

        if ($is_grouped) {
            foreach ($data as $group_key => $group_rows) {
                $flat_data = array_merge($flat_data, $group_rows);
            }
        } else {
            $flat_data = $data;
        }

        if (empty($flat_data)) {
            return '<p>No data to display.</p>';
        }
        $data_to_loop = $flat_data;
        // --- AKHIR DETEKSI & PERATAAN ---


        // headers
        $table .= '<thead><tr>';
        foreach ($headers_map as $header_title => $col) {
            $th_align = is_array($col) && isset($col['align']) ? $col['align'] : 'left';
            $label    = is_array($col) && isset($col['label']) ? $col['label'] : $header_title;
            $table .= '<th style="text-align:' . html_escape($th_align) . ';">' . html_escape($label) . '</th>';
        }
        $table .= '</tr></thead>';

        // body
        $table .= '<tbody>';

        foreach ($data_to_loop as $row) {
            $table .= '<tr>';
            foreach ($headers_map as $header_title => $col) {
                $property = is_array($col) ? ($col['property'] ?? null) : $col;
                $type     = is_array($col) && isset($col['type']) ? $col['type'] : 'text';
                $format   = is_array($col) && isset($col['format']) ? $col['format'] : null;
                $params   = is_array($col) && isset($col['params']) ? $col['params'] : null;
                $align    = is_array($col) && isset($col['align']) ? $col['align'] : 'left';

                // Akses property
                $value = '';
                if ($property) {
                    if (is_object($row) && isset($row->$property)) {
                        $value = $row->$property;
                    } elseif (is_array($row) && isset($row[$property])) {
                        $value = $row[$property];
                    }
                }

                $content_html = '';
                switch ($type) {
                    // Logika link, button, dropdown, dan callback mode tabular tetap di sini
                    case 'link':
                        $link_property = $col['link_property'] ?? $property;
                        $link_value = is_object($row) ? ($row->$link_property ?? '') : ($row[$link_property] ?? '');
                        $url = base_url(($col['url'] ?? '') . $link_value);
                        $text = $col['link_text'] ?? $value;
                        $content_html  = '<a href="' . html_escape($url) . '" class="link-info link-underline link-underline-opacity-0">' . html_escape($text) . '</a>';
                        break;

                    case 'button':
                        $content_html = render_button_cell($row, $col);
                        break;

                    case 'dropdown':
                        $content_html = render_dropdown_cell($row, $col);
                        break;

                    case 'dropdown_post':
                        $content_html = render_dropdown_post_cell($row, $col);
                        break;

                    case 'callback':
                        if (isset($col['callback']) && is_callable($col['callback'])) {
                            $content_html = call_user_func($col['callback'], $row, $value);
                        } else {
                            $content_html = format_value($value, $format, $params);
                        }
                        break;

                    default:
                        // Penanganan wrapper kustom di mode tabular (jika ada)
                        $content_html = format_value($value, $format, $params);
                        if (isset($col['wrapper']) && !empty($col['wrapper'])) {
                            $content_html = sprintf($col['wrapper'], $content_html);
                        }
                        break;
                }

                $table .= '<td style="text-align:' . html_escape($align) . ';">' . $content_html . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';

        $table .= '</table>';
        return $table;
    }
}

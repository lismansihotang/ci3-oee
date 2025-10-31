<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Generate dynamic HTML table with support for:
 * - Custom headers (label, align)
 * - Field type: text, link, button, dropdown, dropdown_post
 * - Formatting (currency, date, custom callback)
 * - Row actions with POST hidden field (dropdown_post)
 *
 * Example usage:
 * $headers_map = [
 *   'Kode Produk' => ['property' => 'kd_product', 'align' => 'center'],
 *   'Nama Produk' => [
 *      'property' => 'nm_product',
 *      'type' => 'link',
 *      'url'  => 'products/view_by_code/',
 *      'link_property' => 'kd_product'
 *   ],
 *   'Harga' => ['property' => 'harga', 'format' => 'currency', 'align' => 'right'],
 *   'Aksi'  => [
 *      'type' => 'dropdown_post',
 *      'action' => 'purchase_orders/update_status',
 *      'id_field' => 'id',
 *      'items' => [
 *          ['label'=>'Set Pending','value'=>1,'class'=>'text-warning'],
 *          ['label'=>'Set Complete','value'=>2,'class'=>'text-success'],
 *      ]
 *   ]
 * ];
 *
 * echo generate_table_view($data, $headers_map, ['class'=>'table table-bordered']);
 */
if (!function_exists('generate_table_view')) {
    function generate_table_view($data, $headers_map, $attributes = [])
    {
        if (empty($data) || !is_array($data) || empty($headers_map)) {
            return '<p>No data to display.</p>';
        }

        // --- MODIFIKASI DIMULAI DI SINI ---

        $flat_data = [];
        $is_grouped = FALSE;

        if (!empty($data)) {
            $first_group = reset($data);

            // Cek apakah data masukan adalah array multidimensi (grup)
            // Kriteria: $data adalah array, elemen pertama adalah array, dan elemen tersebut bukan object/array baris
            if (is_array($first_group)) {

                // Pemeriksaan yang lebih andal: Cek kunci array utama, dan cek apakah isinya array baris/object
                $first_key = key($data);

                // Jika kunci bukan 0 (misalnya '1', '2') DAN nilai pertama adalah array
                if (!is_numeric($first_key) || is_numeric($first_key) && is_array($first_group) && count($first_group) > 0 && (is_object(reset($first_group)) || is_array(reset($first_group)))) {

                    // Ini adalah data yang dikelompokkan (hasil group_array)
                    $is_grouped = TRUE;
                }
            }
        }


        if ($is_grouped) {
            // Data sudah dikelompokkan. Kita ratakan.
            foreach ($data as $group_key => $group_rows) {
                // Tambahkan semua baris dari grup ke array rata
                $flat_data = array_merge($flat_data, $group_rows);
            }
        } else {
            // Data adalah array biasa, tidak dikelompokkan. Gunakan data aslinya.
            $flat_data = $data;
        }

        // Jika setelah perataan data kosong, kembalikan 'No data'
        if (empty($flat_data)) {
            return '<p>No data to display.</p>';
        }

        // Gunakan $flat_data untuk perulangan tabel selanjutnya
        $data_to_loop = $flat_data;

        // --- MODIFIKASI BERAKHIR DI SINI ---


        // table attributes
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $attr_string .= ' ' . html_escape($key) . '="' . html_escape($val) . '"';
        }

        $table = '<table' . $attr_string . '>';

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

        // Gunakan $data_to_loop yang sudah diratakan
        foreach ($data_to_loop as $row) {
            // ... sisa logika loop untuk baris dan kolom tetap sama

            $table .= '<tr>';
            foreach ($headers_map as $header_title => $col) {
                // ... (Logika mengambil nilai dan tipe kolom) ...
                $property = is_array($col) ? ($col['property'] ?? null) : $col;
                $type     = is_array($col) && isset($col['type']) ? $col['type'] : 'text';
                $format   = is_array($col) && isset($col['format']) ? $col['format'] : null;
                $params   = is_array($col) && isset($col['params']) ? $col['params'] : null;
                $align    = is_array($col) && isset($col['align']) ? $col['align'] : 'left';

                // Akses property, tangani object atau array
                $value = '';
                if ($property) {
                    if (is_object($row) && isset($row->$property)) {
                        $value = $row->$property;
                    } elseif (is_array($row) && isset($row[$property])) {
                        $value = $row[$property];
                    }
                }

                // ... (Logika switch case untuk link, button, dropdown, dsb.) ...
                $content_html = '';
                switch ($type) {
                    case 'link':
                        // Pastikan penanganan link juga mendukung object/array jika $row adalah array
                        $link_property = $col['link_property'] ?? $property;
                        $link_value = is_object($row) ? ($row->$link_property ?? '') : ($row[$link_property] ?? '');
                        // $url = base_url(($col['url'] ?? '') . $link_value);
                        $url = site_url(($col['url'] ?? '') . $link_value);
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
                        $content_html = format_value($value, $format, $params);
                        break;
                }
                // ... (Akhir logika switch case) ...

                $table .= '<td style="text-align:' . html_escape($align) . ';">' . $content_html . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';

        $table .= '</table>';
        return $table;
    }
}

/* ==========================================================
 * HELPER PARTS
 * ==========================================================
 */

if (!function_exists('format_value')) {
    function format_value($value, $format, $params = null)
    {
        switch ($format) {
            case 'currency':
                return 'Rp ' . number_format((float) $value, 2, ',', '.');
            case 'date':
                if (!empty($value) && strtotime($value)) {
                    return date($params ?: 'Y-m-d', strtotime($value));
                }
                return $value;
            default:
                return html_escape($value);
        }
    }
}

if (!function_exists('render_button_cell')) {
    function render_button_cell($row, $col)
    {
        $buttons = $col['buttons'] ?? [];
        $html = '';
        foreach ($buttons as $btn) {
            $url   = base_url(($btn['url'] ?? '') . ($row->{$btn['id_field'] ?? 'id'} ?? ''));
            $label = $btn['label'] ?? 'Action';
            $class = $btn['class'] ?? 'btn btn-sm btn-primary';
            $html .= '<a href="' . html_escape($url) . '" class="' . html_escape($class) . '">' . html_escape($label) . '</a> ';
        }
        return $html;
    }
}

if (!function_exists('render_dropdown_cell')) {
    function render_dropdown_cell($row, $col)
    {
        $items  = $col['items'] ?? [];
        $id     = $row->{$col['id_field'] ?? 'id'} ?? '';
        $menuId = 'dropdownMenu' . $id;

        $html  = '<div class="dropdown">';
        $html .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="' . $menuId . '" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>';
        $html .= '<ul class="dropdown-menu" aria-labelledby="' . $menuId . '">';

        foreach ($items as $item) {
            $url   = base_url(($item['url'] ?? '') . $id);
            $label = $item['label'] ?? 'Action';
            $class = $item['class'] ?? '';
            $html .= '<li><a class="dropdown-item ' . html_escape($class) . '" href="' . html_escape($url) . '">' . html_escape($label) . '</a></li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

if (!function_exists('render_dropdown_post_cell')) {
    function render_dropdown_post_cell($row, $col)
    {
        $items   = $col['items'] ?? [];
        $action  = $col['action'] ?? '';
        $idField = $col['id_field'] ?? 'id';
        $rowId   = $row->$idField ?? '';
        $menuId  = 'dropdownPostMenu' . $rowId;

        $html  = '<div class="dropdown">';
        $html .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="' . $menuId . '" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>';
        $html .= '<ul class="dropdown-menu" aria-labelledby="' . $menuId . '">';

        foreach ($items as $item) {
            $label = $item['label'] ?? 'Action';
            $value = $item['value'] ?? '';
            $class = $item['class'] ?? '';

            $html .= '<li>';
            $html .= '<form method="post" action="' . base_url($action) . '" style="display:inline;">';
            $html .= '<input type="hidden" name="' . html_escape($idField) . '" value="' . html_escape($rowId) . '">';
            $html .= '<input type="hidden" name="status" value="' . html_escape($value) . '">';
            $html .= '<button type="submit" class="dropdown-item ' . html_escape($class) . '">' . html_escape($label) . '</button>';
            $html .= '</form>';
            $html .= '</li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

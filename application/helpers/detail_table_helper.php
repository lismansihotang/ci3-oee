<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Table Helper
 *
 * Membantu membuat tabel HTML dinamis dengan konfigurasi kolom fleksibel.
 *
 * ===========================
 * 🔧 Cara Pakai
 * ===========================
 *
 * $headers_map = [
 *   'kd_product' => [
 *       'label' => 'Kode Produk',
 *       'align' => 'center'
 *   ],
 *   'nm_product' => [
 *       'label' => 'Nama Produk',
 *       'property' => 'nm_product',
 *       'type' => 'link',
 *       'url' => 'products/view_by_code/',
 *       'link_property' => 'kd_product'
 *   ],
 *   'qty' => [
 *       'label' => 'Kuantitas',
 *       'align' => 'right'
 *   ],
 *   'harga' => [
 *       'label' => 'Harga',
 *       'format' => 'currency',
 *       'align' => 'right'
 *   ],
 *   'subtotal' => [
 *       'label' => 'Subtotal',
 *       'format' => 'currency',
 *       'align' => 'right'
 *   ],
 *   'status' => [
 *       'label' => 'Status',
 *       'callback' => function($row) {
 *           return ($row->qty > 50)
 *               ? '<span class="badge bg-success">Ready</span>'
 *               : '<span class="badge bg-warning">Low Stock</span>';
 *       },
 *       'align' => 'center'
 *   ],
 *   'actions' => [
 *       'label' => 'Aksi',
 *       'type'  => 'dropdown', // atau 'buttons'
 *       'items' => [
 *           [
 *               'label' => 'Edit',
 *               'url'   => 'products/edit/',
 *               'property' => 'id'
 *           ],
 *           [
 *               'label' => 'Delete',
 *               'url'   => 'products/delete/',
 *               'property' => 'id',
 *               'class' => 'text-danger'
 *           ]
 *       ],
 *       'align' => 'center'
 *   ]
 * ];
 *
 * echo generate_table_view($data, $headers_map, ['class' => 'table table-bordered']);
 */

/**
 * Generate table view
 */
if (!function_exists('generate_table_view')) {
    function generate_table_view($data, $headers_map, $attributes = [])
    {
        if (empty($data) || !is_array($data) || empty($headers_map)) {
            return '<p>No data to display.</p>';
        }

        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $attr_string .= ' ' . html_escape($key) . '="' . html_escape($val) . '"';
        }

        $table = '<table' . $attr_string . '>';
        $table .= render_table_header($headers_map);
        $table .= render_table_body($data, $headers_map);
        $table .= '</table>';

        return $table;
    }
}

/**
 * Render table header
 */
if (!function_exists('render_table_header')) {
    function render_table_header($headers_map)
    {
        $html = '<thead><tr>';
        foreach ($headers_map as $key => $col) {
            $label = is_array($col) && isset($col['label']) ? $col['label'] : ucfirst($key);
            $align = is_array($col) && isset($col['align']) ? $col['align'] : 'left';
            $html .= '<th style="text-align:' . html_escape($align) . ';">' . html_escape($label) . '</th>';
        }
        $html .= '</tr></thead>';
        return $html;
    }
}

/**
 * Render table body
 */
if (!function_exists('render_table_body')) {
    function render_table_body($data, $headers_map)
    {
        $html = '<tbody>';
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($headers_map as $key => $col) {
                $html .= render_table_cell($row, $col, $key);
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        return $html;
    }
}

/**
 * Render single cell
 */
if (!function_exists('render_table_cell')) {
    function render_table_cell($row, $col, $key)
    {
        $property_name = is_array($col) && isset($col['property']) ? $col['property'] : $key;
        $type   = is_array($col) && isset($col['type']) ? $col['type'] : null;
        $format = is_array($col) && isset($col['format']) ? $col['format'] : null;
        $params = is_array($col) && isset($col['params']) ? $col['params'] : null;
        $align  = is_array($col) && isset($col['align']) ? $col['align'] : 'left';

        $cell_value = isset($row->$property_name) ? $row->$property_name : '';
        $content_html = '';

        if (!empty($col['callback']) && is_callable($col['callback'])) {
            $content_html = call_user_func($col['callback'], $row, $col);
        } elseif ($type === 'link') {
            $content_html = render_link_cell($row, $col, $cell_value);
        } elseif ($type === 'buttons') {
            $content_html = render_buttons_cell($row, $col);
        } elseif ($type === 'dropdown') {
            $content_html = render_dropdown_cell($row, $col);
        } else {
            $content_html = render_formatted_cell($cell_value, $format, $params);
        }

        return '<td style="text-align:' . html_escape($align) . ';">' . $content_html . '</td>';
    }
}

/**
 * Render link cell
 */
if (!function_exists('render_link_cell')) {
    function render_link_cell($row, $col, $cell_value)
    {
        $link_property = isset($col['link_property']) ? $col['link_property'] : $col['property'];
        $link_value    = isset($row->$link_property) ? $row->$link_property : '';
        $url = base_url($col['url'] . $link_value);
        $text = isset($col['link_text']) ? $col['link_text'] : $cell_value;
        return '<a href="' . html_escape($url) . '" class="link-info">' . html_escape($text) . '</a>';
    }
}

/**
 * Render buttons cell
 */
if (!function_exists('render_buttons_cell')) {
    function render_buttons_cell($row, $col)
    {
        $html = '';
        foreach ($col['items'] as $btn) {
            $prop = isset($btn['property']) ? $btn['property'] : 'id';
            $val  = isset($row->$prop) ? $row->$prop : '';
            $url  = base_url($btn['url'] . $val);
            $label = isset($btn['label']) ? $btn['label'] : 'Action';
            $class = isset($btn['class']) ? $btn['class'] : 'btn btn-sm btn-primary';
            $html .= '<a href="' . html_escape($url) . '" class="' . html_escape($class) . '">' . html_escape($label) . '</a> ';
        }
        return $html;
    }
}

/**
 * Render dropdown cell
 */
if (!function_exists('render_dropdown_cell')) {
    function render_dropdown_cell($row, $col)
    {
        $html  = '<div class="dropdown">';
        $html .= '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"><i class="icon cil-options"></i> Aksi </button>';
        $html .= '<ul class="dropdown-menu">';
        foreach ($col['items'] as $item) {
            $prop = isset($item['property']) ? $item['property'] : 'id';
            $val  = isset($row->$prop) ? $row->$prop : '';
            $url  = base_url($item['url'] . $val);
            $label = isset($item['label']) ? $item['label'] : 'Action';
            $class = isset($item['class']) ? $item['class'] : '';
            $html .= '<li><a class="dropdown-item ' . html_escape($class) . '" href="' . html_escape($url) . '">' . html_escape($label) . '</a></li>';
        }
        $html .= '</ul></div>';
        return $html;
    }
}

/**
 * Render formatted cell
 */
if (!function_exists('render_formatted_cell')) {
    function render_formatted_cell($value, $format = null, $params = null)
    {
        switch ($format) {
            case 'currency':
                return 'Rp ' . number_format($value, 2, ',', '.');
            case 'date':
                if (!empty($value) && strtotime($value) !== false) {
                    return date($params ?: 'Y-m-d', strtotime($value));
                }
                return $value;
            default:
                return html_escape($value);
        }
    }
}

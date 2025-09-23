<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('build_attr_string')) {
    function build_attr_string(array $attrs): string
    {
        $parts = [];
        foreach ($attrs as $key => $val) {
            $k = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            if (is_array($val)) {
                $json = json_encode($val, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                $json = str_replace("'", '&#39;', $json); // aman utk single-quote
                $parts[] = "{$k}='{$json}'";
            } else {
                $parts[] = "{$k}='" . htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8') . "'";
            }
        }
        return $parts ? ' ' . implode(' ', $parts) : '';
    }
}

if (!function_exists('table_form_detail_generic')) {
    function table_form_detail_generic($table_id, $headers, $columns, $details = [], $column_types = [], $select_options = [], $column_attributes = [], $fetch_urls = [])
    {
        $fetch_urls_json = htmlspecialchars(json_encode($fetch_urls), ENT_QUOTES, 'UTF-8');

        $out  = '<div class="table-responsive">';
        $out .= '<table class="table table-bordered" id="' . html_escape($table_id) . '" data-fetch-urls="' . $fetch_urls_json . '">';
        $out .= '<thead><tr>';
        foreach ($headers as $header) {
            $out .= '<th>' . html_escape($header) . '</th>';
        }
        $out .= '<th class="align-middle text-center"><button type="button" class="btn btn-success btn-sm add-row-btn" title="Tambah Baris"><i class="icon cil-plus"></i></button></th>';
        $out .= '</tr></thead><tbody>';

        if (!empty($details)) {
            foreach ($details as $detail_row) {
                $out .= render_detail_row_generic($detail_row, $columns, $column_types, $select_options, $column_attributes);
            }
        } else {
            $out .= render_detail_row_generic([], $columns, $column_types, $select_options, $column_attributes);
        }

        $out .= '</tbody></table></div>';
        return $out;
    }
}

if (!function_exists('render_detail_row_generic')) {
    function render_detail_row_generic($row_data, $columns, $column_types, $select_options, $column_attributes)
    {
        $out = '<tr>';

        foreach ($columns as $column) {
            $type = $column_types[$column] ?? 'text';

            if ($type === 'hidden') {
                $field = html_escape($column) . '[]';
                $val   = isset($row_data->$column) ? $row_data->$column : '';
                $attrs = $column_attributes[$column] ?? [];
                $out  .= '<input type="hidden" name="' . $field . '" value="' . html_escape($val) . '"' . build_attr_string($attrs) . ' />';
                continue;
            }

            $out .= '<td>';
            $field = html_escape($column) . '[]';
            $attrs = $column_attributes[$column] ?? [];

            // default class
            $attrs['class'] = trim('form-control ' . ($attrs['class'] ?? ''));

            if ($type === 'select2') {
                $selected = $row_data->$column ?? '';
                $options  = $select_options[$column] ?? [];
                $out     .= form_select2($field, $options, $selected, $attrs);
            } elseif (isset($select_options[$column])) {
                $selected = $row_data->$column ?? '';
                $class    = 'form-select ' . ($attrs['class'] ?? '');
                unset($attrs['class']);
                $out .= form_dropdown(
                    ['name' => $field, 'class' => $class],
                    $select_options[$column],
                    $selected,
                    build_attr_string($attrs)
                );
            } else {
                $val = $row_data->$column ?? '';
                if ($type === 'date') {
                    $attrs['class'] .= ' flatpickr-input';
                }
                $class = $attrs['class'];
                unset($attrs['class']);

                $out .= '<input name="' . $field . '" type="' . html_escape($type) . '"'
                    . ' value="' . html_escape($val) . '"'
                    . ' class="' . html_escape($class) . '"'
                    . build_attr_string($attrs)
                    . ' />';
            }
            $out .= '</td>';
        }

        $out .= '<td class="align-middle text-center"><button type="button" class="btn btn-danger btn-sm remove-row-btn" title="Hapus Baris"><i class="icon cil-minus"></i></button></td>';
        $out .= '</tr>';
        return $out;
    }
}

if (!function_exists('form_select2')) {
    function form_select2($name, $options = [], $selected_value = null, $extra_attributes = [])
    {
        // Hapus [] dan tambahkan uniqid supaya setiap baris dapat id berbeda
        $id = preg_replace('/\[\]$/', '', $name) . '_' . uniqid();

        $classes = $extra_attributes['class'] ?? '';
        unset($extra_attributes['class']);

        $class_attr = 'class="form-select ' . html_escape($classes) . '"';
        $attr_string = build_attr_string($extra_attributes);

        $out  = '<select id="' . html_escape($id) . '" name="' . html_escape($name) . '" ' . $class_attr . $attr_string . '>';
        foreach ($options as $value => $label) {
            $sel  = ($value == $selected_value) ? ' selected' : '';
            $out .= '<option value="' . html_escape($value) . '"' . $sel . '>' . html_escape($label) . '</option>';
        }
        $out .= '</select>';
        return $out;
    }
}

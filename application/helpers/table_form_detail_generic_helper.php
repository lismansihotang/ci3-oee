<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Utility: build_attr_string
 * -------------------------------------------
 * Mengubah array atribut menjadi string HTML.
 */
if (!function_exists('build_attr_string')) {
    function build_attr_string(array $attrs): string
    {
        $parts = [];
        foreach ($attrs as $key => $val) {
            $k = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            if (is_array($val)) {
                $json = json_encode($val, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                $json = str_replace("'", '&#39;', $json);
                $parts[] = "{$k}='{$json}'";
            } else {
                $parts[] = "{$k}='" . htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8') . "'";
            }
        }
        return $parts ? ' ' . implode(' ', $parts) : '';
    }
}

/**
 * form_time
 * -------------------------------------------
 * Membuat input waktu dengan 3 mode: readonly, input, hidden
 */
if (!function_exists('form_time')) {
    function form_time(string $name, string $value = '', array $attrs = [], string $mode = 'readonly'): string
    {
        if ($value) {
            $ts = strtotime($value);
            if ($ts !== false) $value = date('H:i', $ts);
        }

        $class = $attrs['class'] ?? '';
        unset($attrs['class']);
        $attr_string = build_attr_string($attrs);

        $out = '';
        if ($mode === 'readonly') {
            $out .= '<input type="text" readonly class="form-control-plaintext" value="' . html_escape($value) . '" />';
            $out .= '<input type="hidden" name="' . html_escape($name) . '" value="' . html_escape($value) . '" class="' . html_escape($class) . '"' . $attr_string . ' />';
        } elseif ($mode === 'input') {
            $out .= '<input type="time" name="' . html_escape($name) . '" value="' . html_escape($value) . '" class="form-control ' . html_escape($class) . '"' . $attr_string . ' />';
        } elseif ($mode === 'hidden') {
            $out .= '<input type="hidden" name="' . html_escape($name) . '" value="' . html_escape($value) . '" class="' . html_escape($class) . '"' . $attr_string . ' />';
        }
        return $out;
    }
}

/**
 * form_select2
 * -------------------------------------------
 */
if (!function_exists('form_select2')) {
    function form_select2($name, $options = [], $selected_value = null, $extra_attributes = [])
    {
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

/**
 * render_detail_row_generic
 * -------------------------------------------
 */
if (!function_exists('render_detail_row_generic')) {
    function render_detail_row_generic($row_data, $columns, $column_types, $select_options, $column_attributes)
    {
        // cari row-id field
        $rowIdField = null;
        foreach ($column_attributes as $col => $attrs) {
            if (!empty($attrs['row-id-field'])) {
                $rowIdField = $col;
                break;
            }
        }

        $rowId = ($rowIdField && isset($row_data->$rowIdField)) ? $row_data->$rowIdField : '';

        $out = '<tr data-row-id="' . html_escape($rowId) . '">';

        // PERBAIKAN: Selalu render input hidden id[] di sini jika rowIdField ada
        if ($rowIdField !== null) {
            $val = $row_data->$rowIdField ?? '';
            // Gunakan name="id[]" agar controller dapat menangkap array ID.
            // Posisikan di sini agar tidak memakan kolom <td> di tabel.
            $out .= '<input type="hidden" name="id[]" value="' . html_escape($val) . '" />';
        }

        foreach ($columns as $column) {
            $type = $column_types[$column] ?? 'text';
            $attrs = $column_attributes[$column] ?? [];
            $field = html_escape($column) . '[]';

            $out .= '<td>';

            // HAPUS LOGIKA LAMA untuk row-id-field di sini, karena sudah diatasi di atas
            // if ($column === $rowIdField) {
            //     $val = $row_data->$column ?? '';
            //     $out .= '<input type="hidden" name="id[]" value="' . html_escape($val) . '">';
            // }

            // render sesuai type
            if ($type === 'hidden') {
                // Lewati rendering jika ini adalah kolom ID yang sudah di-render di atas
                if ($column === $rowIdField) {
                    // Pastikan input ID tidak di-render lagi jika sudah diatasi di luar loop.
                    // Jika ada hidden field lain selain ID, tetap render.
                } else {
                    $val = $row_data->$column ?? '';
                    $out .= '<input type="hidden" name="' . $field . '" value="' . html_escape($val) . '"' . build_attr_string($attrs) . ' />';
                }
            } elseif ($type === 'select2') {
                $selected = $row_data->$column ?? '';
                $options = $select_options[$column] ?? [];
                $out .= form_select2($field, $options, $selected, $attrs);
            } elseif (isset($select_options[$column])) {
                // form_dropdown
            } elseif ($type === 'time') {
                $val = $row_data->$column ?? '';
                $mode = $attrs['display'] ?? 'readonly';
                unset($attrs['display']);
                $out .= form_time($field, $val, $attrs, $mode);
            } elseif ($type === 'button') {
                $btnText = $attrs['value'] ?? $column;
                unset($attrs['value']);
                $btnClass = 'btn ' . ($attrs['class'] ?? 'btn-secondary');
                unset($attrs['class']);
                // ganti {id} di semua atribut
                foreach ($attrs as $k => $v) {
                    if (is_string($v)) $attrs[$k] = str_replace('{id}', $rowId, $v);
                }
                $out .= '<button type="button" class="' . html_escape($btnClass) . '"' . build_attr_string($attrs) . '>' . $btnText . '</button>';
            } else {
                $val = $row_data->$column ?? '';
                if ($type === 'date') $attrs['class'] .= ' flatpickr-input';
                $class = $attrs['class'] ?? '';
                unset($attrs['class']);
                $out .= '<input name="' . $field . '" type="' . html_escape($type) . '" value="' . html_escape($val) . '" class="form-control ' . html_escape($class) . '"' . build_attr_string($attrs) . ' />';
            }

            $out .= '</td>';
        }

        // tombol hapus baris
        $out .= '<td class="align-middle text-center">'
            . '<button type="button" class="btn btn-danger btn-sm remove-row-btn" title="Hapus Baris">'
            . '<i class="icon cil-minus"></i>'
            . '</button></td>';

        $out .= '</tr>';
        return $out;
    }
}

/**
 * table_form_detail_generic
 * -------------------------------------------
 */
if (!function_exists('table_form_detail_generic')) {
    function table_form_detail_generic(
        $table_id,
        $headers,
        $columns,
        $details = [],
        $column_types = [],
        $select_options = [],
        $column_attributes = [],
        $fetch_urls = []
    ) {
        $fetch_urls_json = htmlspecialchars(json_encode($fetch_urls), ENT_QUOTES, 'UTF-8');

        $out  = '<div class="table-responsive">';
        $out .= '<table class="table table-bordered" id="' . html_escape($table_id) . '" data-fetch-urls="' . $fetch_urls_json . '">';
        $out .= '<thead><tr>';
        foreach ($headers as $header) $out .= '<th>' . html_escape($header) . '</th>';
        $out .= '<th class="align-middle text-center"><button type="button" class="btn btn-success btn-sm add-row-btn" title="Tambah Baris"><i class="icon cil-plus"></i></button></th>';
        $out .= '</tr></thead><tbody>';

        if (!empty($details)) {
            foreach ($details as $detail_row) {
                $out .= render_detail_row_generic($detail_row, $columns, $column_types, $select_options, $column_attributes);
            }
        } else {
            $out .= render_detail_row_generic((object)[], $columns, $column_types, $select_options, $column_attributes);
        }

        $out .= '</tbody></table></div>';
        return $out;
    }
}

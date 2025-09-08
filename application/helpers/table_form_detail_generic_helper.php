<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('table_form_detail_generic')) {
    /**
     * Helper untuk membuat tabel form detail yang generik.
     *
     * @param string $table_id ID untuk elemen tabel.
     * @param array $headers Array berisi label header kolom.
     * @param array $columns Array berisi nama kolom/field.
     * @param array $details Array berisi data detail yang ada (dari database).
     * @param array $column_types Array asosiatif untuk menentukan tipe input (e.g., ['qty' => 'number']).
     * @param array $select_options Array asosiatif untuk opsi dropdown (e.g., ['kd_product' => [...]]).
     * @param array $column_attributes Array asosiatif untuk atribut tambahan (e.g., ['qty' => ['class' => 'qty-input']]).
     * @param array $fetch_urls Array asosiatif untuk URL fetch data (e.g., ['kd_product' => '...']).
     * @return string Kode HTML untuk tabel.
     */
    function table_form_detail_generic($table_id, $headers, $columns, $details = [], $column_types = [], $select_options = [], $column_attributes = [], $fetch_urls = [])
    {
        $ci = &get_instance();
        $output = '';

        // Konversi URL fetch ke format JSON untuk digunakan oleh JavaScript
        $fetch_urls_json = htmlspecialchars(json_encode($fetch_urls), ENT_QUOTES, 'UTF-8');

        $output .= '<div class="table-responsive">';
        // Tambahkan atribut data-fetch-urls ke tabel
        $output .= '<table class="table table-bordered" id="' . html_escape($table_id) . '" data-fetch-urls="' . $fetch_urls_json . '">';
        $output .= '<thead>';
        $output .= '<tr>';
        foreach ($headers as $header) {
            $output .= '<th>' . html_escape($header) . '</th>';
        }
        $output .= '<th class="align-middle text-center"><button type="button" class="btn btn-success btn-sm add-row-btn" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Tambah Baris"><i class="icon cil-plus"></i></button></th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';

        // Render baris yang ada jika ada data detail
        if (!empty($details)) {
            foreach ($details as $detail_row) {
                $output .= render_detail_row_generic($detail_row, $columns, $column_types, $select_options, $column_attributes);
            }
        } else {
            // Render satu baris kosong untuk form baru
            $output .= render_detail_row_generic([], $columns, $column_types, $select_options, $column_attributes);
        }

        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '</div>';

        return $output;
    }
}

if (!function_exists('render_detail_row_generic')) {
    /**
     * Helper untuk membuat baris tabel form detail.
     *
     * @param object|array $row_data Data baris tunggal dari database.
     * @param array $columns Nama-nama kolom/field.
     * @param array $column_types Tipe input untuk setiap kolom.
     * @param array $select_options Opsi untuk field select.
     * @param array $column_attributes Atribut tambahan untuk field input.
     * @return string Kode HTML untuk baris tabel.
     */
    function render_detail_row_generic($row_data, $columns, $column_types, $select_options, $column_attributes)
    {
        $output = '<tr>';
        foreach ($columns as $column) {
            $output .= '<td>';
            $field_name = html_escape($column) . '[]';

            // Dapatkan atribut tambahan untuk field
            $extra_attrs = isset($column_attributes[$column]) ? $column_attributes[$column] : [];
            $input_class = 'form-control ' . ($extra_attrs['class'] ?? '');

            // Periksa jika field adalah select (dropdown)
            if (isset($select_options[$column])) {
                $selected_value = isset($row_data->$column) ? $row_data->$column : '';
                $output .= form_dropdown([
                    'name' => $field_name,
                    'class' => 'form-select ' . ($extra_attrs['class'] ?? ''),
                ], $select_options[$column], $selected_value);
            } else {
                // Tentukan tipe input dan nilai
                $input_type = isset($column_types[$column]) ? $column_types[$column] : 'text';
                $value = isset($row_data->$column) ? $row_data->$column : '';

                // Jika tipe date, tambahkan class flatpickr
                if ($input_type === 'date') {
                    $input_class .= ' flatpickr-input';
                }

                $output .= form_input([
                    'name' => $field_name,
                    'type' => $input_type,
                    'value' => html_escape($value),
                    'class' => $input_class,
                ]);
            }
            $output .= '</td>';
        }

        // Tombol hapus baris
        $output .= '<td class="align-middle text-center"><button type="button" class="btn btn-danger btn-sm remove-row-btn" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Baris"><i class="icon cil-minus"></i></button></td>';
        $output .= '</tr>';

        return $output;
    }
}

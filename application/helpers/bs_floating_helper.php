<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Helper untuk membuat elemen form Bootstrap 5 dengan class "form-floating"
 *
 * @param string $name Nama dari input, juga digunakan untuk 'id' jika $id tidak diset.
 * @param string|null $type Tipe input (misalnya 'email', 'password', 'text').
 * @param string|null $value Nilai default untuk input.
 * @param string|null $placeholder Teks placeholder untuk input.
 * @param string|null $id ID unik untuk input.
 * @param array $extra_attributes Array asosiatif berisi atribut tambahan seperti ['data-coreui-datepicker' => 'true'].
 * @return string Kode HTML untuk input form.
 */
if (! function_exists('bs_floating_input')) {
    function bs_floating_input($name, $type = 'text', $value = null, $placeholder = null, $id = null, $extra_attributes = [])
    {
        $id = $id ?? $name . '_' . uniqid();
        $placeholder = $placeholder ?? "Entry Data " . ucfirst(str_replace('_', ' ', $name));

        $attr_string = '';
        foreach ($extra_attributes as $key => $val) {
            $attr_string .= " " . html_escape($key) . "=\"" . html_escape($val) . "\"";
        }

        $class_string = 'class="form-control';
        if ($type === 'date') {
            $class_string .= ' flatpickr-input';
        }
        $class_string .= '"';

        // Tangani nilai null atau string kosong dengan hati-hati
        $input_value = ($value !== null && $value !== '') ? html_escape($value) : '';

        $html = '<div class="form-floating mb-2">';
        $html .= '<input type="' . html_escape($type) . '" ' . $class_string . ' id="' . html_escape($id) . '" name="' . html_escape($name) . '" placeholder="' . html_escape($placeholder)  . '" value="' . $input_value . '"' . $attr_string . '>';
        $html .= '<label for="' . html_escape($id) . '">' . html_escape(strtoupper(str_replace('_', ' ', $name))) . '</label>';
        $html .= '</div>';

        return $html;
    }
}

/**
 * Helper untuk membuat elemen textarea Bootstrap 5 dengan class "form-floating"
 *
 * @param string $name Nama dari textarea, juga digunakan untuk 'id' jika $id tidak diset.
 * @param string|null $value Nilai default untuk textarea.
 * @param string|null $placeholder Teks placeholder untuk textarea.
 * @param string|null $id ID unik untuk textarea.
 * @param string|null $style Atribut style tambahan untuk textarea (misalnya 'height: 100px').
 * @return string Kode HTML untuk textarea form.
 */
if (! function_exists('bs_floating_textarea')) {
    function bs_floating_textarea($name, $value = null, $placeholder = null, $id = null, $style = null)
    {
        $id = $id ?? $name . '_' . uniqid();
        $placeholder = $placeholder ?? "Entry Data " . ucfirst(str_replace('_', ' ', $name));
        $style_attr = !empty($style) ? ' style="' . $style . '"' : '';

        $html = '<div class="form-floating mb-2">';
        $html .= '<textarea class="form-control" id="' . html_escape($id) . '" name="' . html_escape($name) . '" placeholder="' . html_escape($placeholder)  . '"' . $style_attr . '>' . html_escape($value ?? '') . '</textarea>';
        $html .= '<label for="' . html_escape($id) . '">' . html_escape(strtoupper(str_replace('_', ' ', $name))) . '</label>';
        $html .= '</div>';

        return $html;
    }
}

/**
 * Helper untuk membuat elemen select Bootstrap 5 dengan class "form-floating"
 *
 * @param string $name Nama dari select, juga digunakan untuk 'id' jika $id tidak diset.
 * @param array $options Array asosiatif berisi value dan label untuk opsi.
 * @param string|null $selected_value Nilai yang akan dipilih secara default.
 * @param string|null $id ID unik untuk select.
 * @param array $extra_attributes Array asosiatif berisi atribut tambahan seperti ['data-target-input' => 'nm_cust'].
 * @return string Kode HTML untuk select form.
 */
if (! function_exists('bs_floating_select')) {
    function bs_floating_select($name, $options = [], $selected_value = null, $id = null, $extra_attributes = []) // ADDED $extra_attributes
    {
        $id = $id ?? $name . '_' . uniqid();

        $attr_string = '';
        foreach ($extra_attributes as $key => $val) {
            $attr_string .= " " . html_escape($key) . "=\"" . html_escape($val) . "\"";
        }

        $html = '<div class="form-floating mb-2">';
        $html .= '<select class="form-select" id="' . html_escape($id) . '" name="' . html_escape($name) . '" aria-label="Floating label select example"' . $attr_string . '>';

        foreach ($options as $value => $label) {
            $selected = ($value == $selected_value) ? ' selected' : '';
            $html .= '<option value="' . html_escape($value) . '"' . $selected . '>' . html_escape($label) . '</option>';
        }

        $html .= '</select>';
        $html .= '<label for="' . html_escape($id) . '">' . html_escape(strtoupper(str_replace('_', ' ', $name))) . '</label>';
        $html .= '</div>';

        return $html;
    }
}

/**
 * Helper untuk menampilkan informasi waktu dalam format Bootstrap 5.
 *
 * @param string $datetime_str String waktu (misalnya: '2025-08-27 21:58:55.237602').
 * @param string $label Teks label yang akan ditampilkan di atas waktu (misalnya: 'New Clients').
 * @param string $border_color Warna border Bootstrap ('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark').
 * @return string Kode HTML untuk menampilkan informasi waktu.
 */
if (! function_exists('bs_floating_datetime')) {
    function bs_floating_datetime($datetime_str, $label, $border_color = 'info')
    {
        try {
            $dt = new DateTime($datetime_str);
            $formatted_time = $dt->format('d F Y H:i:s');
        } catch (Exception $e) {
            $formatted_time = 'Invalid Date';
        }

        $html = '<div class="border-start border-start-4 border-start-' . html_escape($border_color) . ' px-3 mb-3">';
        $html .= '<div class="small text-body-secondary text-truncate">' . html_escape($label) . '</div>';
        $html .= '<div class="fs-5 fw-semibold">' . html_escape($formatted_time) . '</div>';
        $html .= '</div>';

        return $html;
    }
}

/**
 * Helper untuk menampilkan informasi waktu dalam baris tabel dengan format Bootstrap.
 *
 * @param string $datetime_str String waktu (misalnya: '2025-08-27 21:58:55.237602').
 * @param string $status_label Label status (misalnya: 'New', 'Updated').
 * @param string $main_label Teks utama (misalnya: 'Registered').
 * @return string Kode HTML untuk menampilkan informasi waktu.
 */
if (! function_exists('bs_table_datetime')) {
    function bs_table_datetime($datetime_str, $status_label, $main_label)
    {
        try {
            $dt = new DateTime($datetime_str);
            $formatted_date = $dt->format('M j, Y H:i:s');
        } catch (Exception $e) {
            $formatted_date = 'Invalid Date';
        }

        $html = '<div class="small text-body-secondary text-nowrap">';
        $html .= '<span>' . html_escape($status_label) . '</span> | ';
        $html .= '<span>' . html_escape($main_label) . ': ' . $formatted_date . '</span>';
        $html .= '</div>';

        return $html;
    }
}

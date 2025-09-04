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
 * @return string Kode HTML untuk input form.
 */
if (! function_exists('bs_floating_input')) {
    function bs_floating_input($name, $type = 'text', $value = null, $placeholder = null, $id = null)
    {
        $id = $id ?? $name . '-' . time();
        $placeholder = $placeholder ?? "Entry Data " . ucfirst($name);

        $html = '<div class="form-floating mb-2">';
        $html .= '<input type="' . $type . '" class="form-control" id="' . $id . '" name="' . $name . '" placeholder="' . strtoupper($placeholder)  . '" value="' . html_escape($value ?? '') . '">';
        $html .= '<label for="' . $id . '">' . strtoupper($name) . '</label>';
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
        $id = $id ?? $name . '-' . time();
        $placeholder = $placeholder ?? "Entry Data " . ucfirst($name);
        $style_attr = !empty($style) ? ' style="' . $style . '"' : '';

        $html = '<div class="form-floating mb-2">';
        $html .= '<textarea class="form-control" id="' . $id . '" name="' . $name . '" placeholder="' . strtoupper($placeholder)  . '"' . $style_attr . '>' . html_escape($value ?? '') . '</textarea>';
        $html .= '<label for="' . $id . '">' . strtoupper($name) . '</label>';
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
 * @return string Kode HTML untuk select form.
 */
if (! function_exists('bs_floating_select')) {
    function bs_floating_select($name, $options = [], $selected_value = null, $id = null)
    {
        $id = $id ?? $name . '-' . time();

        $html = '<div class="form-floating mb-2">';
        $html .= '<select class="form-select" id="' . $id . '" name="' . $name . '" aria-label="Floating label select example">';

        foreach ($options as $value => $label) {
            $selected = ($value == $selected_value) ? ' selected' : '';
            $html .= '<option value="' . html_escape($value) . '"' . $selected . '>' . html_escape($label) . '</option>';
        }

        $html .= '</select>';
        $html .= '<label for="' . $id . '">' . strtoupper($name) . '</label>';
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
        // Ubah string datetime menjadi objek DateTime untuk format yang lebih mudah
        try {
            $dt = new DateTime($datetime_str);
            // Format datetime menjadi format yang lebih rapi (misalnya: "27 Agustus 2025 21:58")
            $formatted_time = $dt->format('d F Y H:i:s');
        } catch (Exception $e) {
            // Tangani error jika format tanggal tidak valid
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
        // Ubah string datetime menjadi objek DateTime untuk format yang lebih mudah
        try {
            $dt = new DateTime($datetime_str);
            // Format datetime menjadi format yang lebih rapi (misalnya: "Jan 1, 2023")
            $formatted_date = $dt->format('M j, Y H:i:s');
        } catch (Exception $e) {
            // Tangani error jika format tanggal tidak valid
            $formatted_date = 'Invalid Date';
        }

        $html = '<div class="small text-body-secondary text-nowrap">';
        $html .= '<span>' . html_escape($status_label) . '</span> | ';
        $html .= '<span>' . html_escape($main_label) . ': ' . $formatted_date . '</span>';
        $html .= '</div>';

        return $html;
    }
}

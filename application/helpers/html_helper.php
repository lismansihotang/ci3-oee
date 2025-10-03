<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('generate_card_info')) {
    /**
     * Generates an HTML card with a customizable border, title, and value.
     *
     * @param   string  $title          The title text for the card.
     * @param   string  $value          The main value to display.
     * @param   string  $border_color   The color class for the border (e.g., 'primary', 'info', 'success', 'danger').
     * @return  string
     */
    function generate_card_info($title, $value, $border_color = 'info')
    {
        $html = '<div class="border-start border-start-4 border-start-' . html_escape($border_color) . ' px-3 mb-3">';
        $html .= '<div class="small text-body-secondary text-truncate">' . html_escape($title) . '</div>';
        $html .= '<div class="fs-5 fw-semibold">' . html_escape($value) . '</div>';
        $html .= '</div>';

        return $html;
    }
}

if (!function_exists('generate_btn_group')) {
    /**
     * Menghasilkan komponen HTML Bootstrap Button Group.
     *
     * @param array $buttons Array konfigurasi tombol.
     * Format: [
     * ['label' => 'Text', 'class' => 'btn-primary', 'href' => 'url', 'type' => 'link|button'],
     * ['label' => 'Text', 'class' => 'btn-secondary', 'onclick' => 'jsFunction()', 'type' => 'button'],
     * ...
     * ]
     * @param array $group_attributes HTML attributes untuk div.btn-group.
     * @return string HTML dari Button Group.
     */
    function generate_btn_group($buttons, $group_attributes = [])
    {
        if (empty($buttons) || !is_array($buttons)) {
            return '';
        }

        // --- Atribut Div Group ---
        $default_attributes = [
            'class' => 'btn-group',
            'role' => 'group',
            'aria-label' => 'Button group'
        ];
        $attributes = array_merge($default_attributes, $group_attributes);

        $attr_string = '';
        foreach ($attributes as $key => $val) {
            // Menggunakan html_escape untuk keamanan
            $attr_string .= ' ' . html_escape($key) . '="' . html_escape($val) . '"';
        }

        $html = '<div' . $attr_string . '>';

        // --- Iterasi Tombol ---
        foreach ($buttons as $btn) {
            $label = $btn['label'] ?? 'Aksi';
            $type = $btn['type'] ?? 'button';
            $btn_class = 'btn ' . ($btn['class'] ?? 'btn-secondary');

            // --- Atribut Tombol (Link atau Button) ---
            $btn_attr_string = '';
            $tag = '';

            if ($type === 'link' || isset($btn['href'])) {
                // Render sebagai tag <a>
                $tag = 'a';
                $href = $btn['href'] ?? '#';
                $btn_attr_string .= ' href="' . html_escape($href) . '"';
                $btn_attr_string .= ' role="button"';
            } else {
                // Render sebagai tag <button>
                $tag = 'button';
                $btn_attr_string .= ' type="' . html_escape($btn['html_type'] ?? 'button') . '"'; // Default type="button"
            }

            // Tambahkan kelas dan event (onclick)
            $btn_attr_string .= ' class="' . html_escape($btn_class) . '"';
            if (isset($btn['onclick'])) {
                $btn_attr_string .= ' onclick="' . html_escape($btn['onclick']) . '"';
            }
            if (isset($btn['id'])) {
                $btn_attr_string .= ' id="' . html_escape($btn['id']) . '"';
            }
            if (isset($btn['data-bs-toggle'])) {
                $btn_attr_string .= ' data-bs-toggle="' . html_escape($btn['data-bs-toggle']) . '"';
            }

            // Render HTML tombol
            $html .= '<' . $tag . $btn_attr_string . '>' . html_escape($label) . '</' . $tag . '>';
        }

        $html .= '</div>';
        return $html;
    }
}

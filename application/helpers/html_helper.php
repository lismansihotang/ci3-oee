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

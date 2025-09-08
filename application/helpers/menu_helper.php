<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_menu')) {
    /**
     * Men-generate menu HTML dari sebuah array.
     *
     * @param array $menu_items
     * @return string
     */
    function generate_menu($menu_items)
    {
        $CI = &get_instance();
        $html = '<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>';

        foreach ($menu_items as $item) {
            // Cek tipe item menu: link atau nav-title
            if (isset($item['type']) && $item['type'] === 'nav-title') {
                $html .= '<li class="nav-title">' . $item['label'] . '</li>';
            } else {
                $active_class = '';
                // Menentukan class 'active' berdasarkan URL saat ini
                if ($CI->uri->segment(1) === $item['url']) {
                    $active_class = 'active';
                }

                $html .= '<li class="nav-item">';
                $html .= '<a class="nav-link ' . $active_class . '" href="' . site_url($item['url']) . '">';
                $html .= $item['label'];
                $html .= '</a>';
                $html .= '</li>';
            }
        }

        $html .= '</ul>';

        return $html;
    }
}

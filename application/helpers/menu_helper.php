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
        if (isset($item['type']) && $item['type'] === 'nav-title') {
            $html .= '<li class="nav-title">' . $item['label'] . '</li>';

        } elseif (isset($item['type']) && $item['type'] === 'collapse') {
            $collapse_id = 'menu_' . strtolower(str_replace(' ', '_', $item['label']));
            $html .= '<li class="nav-item">';

            // Tambahkan caret/dropdown icon
            $html .= '<a class="nav-link collapsed d-flex justify-content-between align-items-center" 
                        data-coreui-toggle="collapse" href="#' . $collapse_id . '" role="button" aria-expanded="false" aria-controls="' . $collapse_id . '">';
            $html .= '<span>' . $item['label'] . '</span>';
            $html .= '<i class="nav-icon cil-chevron-bottom"></i>'; // icon dropdown CoreUI
            $html .= '</a>';

            $html .= '<ul class="collapse list-unstyled ms-3" id="' . $collapse_id . '">';

            if (!empty($item['children'])) {
                foreach ($item['children'] as $child) {
                    $active_class = ($CI->uri->segment(1) === $child['url']) ? 'active' : '';
                    $html .= '<li class="nav-item">';
                    $html .= '<a class="nav-link ' . $active_class . '" href="' . site_url($child['url']) . '">';
                    $html .= $child['label'];
                    $html .= '</a>';
                    $html .= '</li>';
                }
            }

            $html .= '</ul>';
            $html .= '</li>';
        }
        else {
            // default = link
            $active_class = (isset($item['url']) && $CI->uri->segment(1) === $item['url']) ? 'active' : '';
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

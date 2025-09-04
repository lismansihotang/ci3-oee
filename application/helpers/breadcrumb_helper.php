<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Generate breadcrumb HTML
 *
 * @param array|null $custom Optional custom names ['segment' => 'Title']
 * @param string $divider HTML divider, default '/'
 * @return string HTML breadcrumb
 */
function breadcrumb($custom = null, $divider = '/')
{
    $CI = &get_instance();
    $segments = $CI->uri->segment_array();
    $breadcrumb = [];
    $url = site_url();

    // Home selalu pertama
    $breadcrumb[] = '<li class="nav-item"><a class="nav-link" href="' . site_url() . '">Home</a></li>';

    $total = count($segments);
    foreach ($segments as $i => $seg) {
        $isLast = ($i == $total);
        $url .= '/' . $seg;

        // Jika ada custom, pakai judul custom
        $title = $custom[$seg] ?? ucfirst(str_replace('_', ' ', $seg));

        if ($isLast) {
            $breadcrumb[] = '<li class="nav-item active" aria-current="page"><a class="nav-link" href="#">' . $title . '</a></li>';
        } else {
            $breadcrumb[] = '<li class="nav-item"><a class="nav-link" href="' . $url . '">' . $title . '</a></li>';
        }
    }

    return '<ul class="header-nav d-none d-lg-flex">' . implode('', $breadcrumb) . '</ul>';
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Helper Pagination Bootstrap 5
 * 
 * Contoh:
 * echo build_pagination(site_url('users/index'), $total_rows, $per_page, $current_page);
 */
if (!function_exists('build_pagination')) {
    function build_pagination($base_url, $total_rows, $per_page = 10, $current_page = 0)
    {
        $CI = &get_instance();
        $CI->load->library('pagination');

        $config['base_url']        = $base_url;
        $config['total_rows']      = $total_rows;
        $config['per_page']        = $per_page;
        $config['use_page_numbers'] = TRUE;

        // styling bootstrap
        $config['full_tag_open']   = '<nav><ul class="pagination">';
        $config['full_tag_close']  = '</ul></nav>';
        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';
        $config['attributes']      = ['class' => 'page-link'];

        $CI->pagination->initialize($config);

        return $CI->pagination->create_links();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('prepare_search_and_pagination')) {
    /**
     * Mengelola logika pencarian dan paginasi.
     *
     * @param CI_Controller $ci Instance CI Controller
     * @param string $base_url URL dasar untuk paginasi
     * @param int $total_rows Jumlah total baris data
     * @param int $per_page Jumlah data per halaman
     * @return array Berisi 'search_term', 'offset', 'per_page', dan 'pagination'
     */
    function prepare_search_and_pagination($ci, $base_url, $total_rows, $per_page = 10)
    {
        // Mendapatkan kata kunci pencarian dari GET request
        $search_term = $ci->input->get('q', TRUE);

        // Konfigurasi Paginasi
        $ci->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'p';
        $config['reuse_query_string'] = TRUE;

        // Konfigurasi Tampilan Bootstrap 5
        $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $ci->pagination->initialize($config);

        // Hitung offset berdasarkan parameter 'p'
        $offset = $ci->input->get('p', TRUE) ? (int)$ci->input->get('p', TRUE) : 0;

        // Kembalikan semua data yang relevan
        return [
            'search_term' => $search_term,
            'offset' => $offset,
            'per_page' => $per_page,
            'pagination' => $ci->pagination->create_links()
        ];
    }
}

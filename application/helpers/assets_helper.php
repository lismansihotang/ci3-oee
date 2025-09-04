<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('load_css')) {
    function load_css($files = [])
    {
        $CI = &get_instance();
        $CI->load->config('assets');
        $assets = $CI->config->item('assets');

        $template_folder = isset($assets['template_folder']) ? $assets['template_folder'] : 'coreui-template-main';

        // kalau kosong pakai default dari config/assets.php
        if (empty($files)) {
            $files = isset($assets['css']) ? $assets['css'] : [];
        }

        $output = '';
        foreach ((array) $files as $file) {
            $output .= '<link rel="stylesheet" href="'
                . base_url('assets/' . $template_folder . '/' . $file)
                . '">' . PHP_EOL;
        }
        return $output;
    }
}

if (!function_exists('load_js')) {
    function load_js($files = [])
    {
        $CI = &get_instance();
        $CI->load->config('assets');
        $assets = $CI->config->item('assets');

        $template_folder = isset($assets['template_folder']) ? $assets['template_folder'] : 'coreui-template-main';

        if (empty($files)) {
            $files = isset($assets['js']) ? $assets['js'] : [];
        }

        $output = '';
        foreach ((array) $files as $file) {
            $output .= '<script src="'
                . base_url('assets/' . $template_folder . '/' . $file)
                . '"></script>' . PHP_EOL;
        }
        return $output;
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['assets'] = [
    // you can change this folder anytime
    'template_folder' => 'coreui-template-main/dist',

    'css' => [
        'css/vendors/simplebar.css',
        'vendors/@coreui/icons/css/free.min.css',
        'css/style.css',
    ],
    'js' => [
        'vendors/@coreui/coreui/js/coreui.bundle.min.js',
        'vendors/simplebar/js/simplebar.min.js',
        'js/tooltips.js',
    ],
];

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Controller.php';

class Auth_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Require login for all pages extending this controller
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            exit;
        }
    }
}

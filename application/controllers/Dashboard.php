<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/Auth_Controller.php';

class Dashboard extends Auth_Controller
{
    public function index()
    {
        $this->setTitle('Dashboard');
        $this->render('dashboard/index');
    }
}

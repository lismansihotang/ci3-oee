<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $layout = 'layouts/main'; // default layout
    protected $data   = [];             // shared view data

    public function __construct()
    {
        parent::__construct();
        // Common helpers/libraries
        $this->load->helper(['url', 'form', 'assets', 'breadcrumb']);
        $this->load->library(['session']);
        // Default page title
        $this->data['title'] = 'Dashboard';

        // cek login, kecuali Auth controller
        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() != 'auth') {
            redirect('auth/login');
        }
    }

    /**
     * Render a view inside layout.
     * $view: application/views/<view>.php
     * $data: array merged with $this->data
     */
    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content'] = $this->load->view($view, $data, TRUE);
        $this->load->view($this->layout, $data);
    }

    /** Set page title shown in <title> and header */
    protected function setTitle($title)
    {
        $this->data['title'] = $title;
    }
}

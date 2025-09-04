<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url', 'form']);
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            return redirect('dashboard');
        }

        $data = [];
        if ($this->input->post()) {
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));

            // TODO: replace with your user table check
            if ($username === 'admin' && $password === '1234') {
                $this->session->set_userdata([
                    'logged_in' => TRUE,
                    'username'  => $username,
                    'user_id'   => 1,
                    'logged_in' => true,
                ]);
                return redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username/password';
            }
        }
        $this->load->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}

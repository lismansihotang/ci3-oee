<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Users_model $model
 */
class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model','model');
        $this->controller_name = 'users';
    }

    public function index($view = '')
    {
        $this->setTitle('Users');
        
        parent::index('users/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Users');
        parent::form(null, 'users/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Users');
        parent::form($id, 'users/form');
    }

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Users');
        parent::view($id, 'users/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

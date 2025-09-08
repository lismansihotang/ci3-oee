<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Machines_model $model
 */
class Machines extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Machines_model','model');
        $this->controller_name = 'machines';
    }

    public function index($view = '')
    {
        $this->setTitle('Machines');
        
        parent::index('machines/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Machines');
        parent::form(null, 'machines/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Machines');
        parent::form($id, 'machines/form');
    }

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Machines');
        parent::view($id, 'machines/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

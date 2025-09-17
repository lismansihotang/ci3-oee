<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Operators_model $model
 */
class Operators extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Operators_model','model');
        $this->controller_name = 'operators';
    }

    public function index($view = '')
    {
        $this->setTitle('Operators');
        
        parent::index('operators/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Operators');
        parent::form(null, 'operators/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Operators');
        parent::form($id, 'operators/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Operators');
        parent::view($id, 'operators/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

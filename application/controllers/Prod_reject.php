<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Prod_reject_model $model
 */
class Prod_reject extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_reject_model','model');
        $this->controller_name = 'prod_reject';
        $this->model->set_group_by([]);
        $this->model->set_order_by('id');
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_reject');
        
        parent::index('prod_reject/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_reject');
        parent::form(null, 'prod_reject/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_reject');
        parent::form($id, 'prod_reject/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_reject');
        parent::view($id, 'prod_reject/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

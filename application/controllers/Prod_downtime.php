<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Prod_downtime_model $model
 */
class Prod_downtime extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_downtime_model','model');
        $this->controller_name = 'prod_downtime';
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_downtime');
        
        parent::index('prod_downtime/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_downtime');
        parent::form(null, 'prod_downtime/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_downtime');
        parent::form($id, 'prod_downtime/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_downtime');
        parent::view($id, 'prod_downtime/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

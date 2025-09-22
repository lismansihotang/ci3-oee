<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Prod_detail_model $model
 */
class Prod_detail extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_detail_model','model');
        $this->controller_name = 'prod_detail';
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_detail');
        
        parent::index('prod_detail/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_detail');
        parent::form(null, 'prod_detail/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_detail');
        parent::form($id, 'prod_detail/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_detail');
        parent::view($id, 'prod_detail/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

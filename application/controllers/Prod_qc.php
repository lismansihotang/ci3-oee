<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Prod_qc_model $model
 */
class Prod_qc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_qc_model','model');
        $this->controller_name = 'prod_qc';
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_qc');
        
        parent::index('prod_qc/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_qc');
        parent::form(null, 'prod_qc/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_qc');
        parent::form($id, 'prod_qc/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_qc');
        parent::view($id, 'prod_qc/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

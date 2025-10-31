<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Inspector_qc_model $model
 */
class Inspector_qc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inspector_qc_model','model');
        $this->load->model('Machines_model');
        $this->load->model('Operators_model');
        $this->controller_name = 'inspector_qc';
        $this->model->set_group_by([]);
        $this->model->set_order_by('id');
    }

    public function index($view = '')
    {
        $this->setTitle('Inspector_qc');
        
        parent::index('inspector_qc/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Inspector_qc');
        $this->data['list_machines'] = $this->Machines_model->get_dropdown();
        $this->data['list_operators'] = $this->Operators_model->get_dropdown();
        parent::form(null, 'inspector_qc/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Inspector_qc');
        $this->data['list_machines'] = $this->Machines_model->get_dropdown();
        $this->data['list_operators'] = $this->Operators_model->get_dropdown();
        parent::form($id, 'inspector_qc/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Inspector_qc');
        parent::view($id, 'inspector_qc/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

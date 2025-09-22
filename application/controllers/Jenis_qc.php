<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Jenis_qc_model $model
 */
class Jenis_qc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_qc_model','model');
        $this->controller_name = 'jenis_qc';
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Jenis_qc');
        
        parent::index('jenis_qc/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Jenis_qc');
        parent::form(null, 'jenis_qc/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Jenis_qc');
        parent::form($id, 'jenis_qc/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Jenis_qc');
        parent::view($id, 'jenis_qc/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

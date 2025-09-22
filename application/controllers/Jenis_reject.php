<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Jenis_reject_model $model
 */
class Jenis_reject extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_reject_model','model');
        $this->controller_name = 'jenis_reject';
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Jenis_reject');
        
        parent::index('jenis_reject/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Jenis_reject');
        parent::form(null, 'jenis_reject/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Jenis_reject');
        parent::form($id, 'jenis_reject/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Jenis_reject');
        parent::view($id, 'jenis_reject/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

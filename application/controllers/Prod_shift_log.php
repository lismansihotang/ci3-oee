<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Prod_shift_log_model $model
 */
class Prod_shift_log extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_shift_log_model', 'model');
        $this->controller_name = 'prod_shift_log';
        $this->model->set_group_by([]);
        $this->model->set_order_by('id');
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_shift_log');

        parent::index('prod_shift_log/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_shift_log');
        parent::form(null, 'prod_shift_log/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_shift_log');
        parent::form($id, 'prod_shift_log/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_shift_log');
        parent::view($id, 'prod_shift_log/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

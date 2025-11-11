<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Products_model $model
 */
class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'model');
        $this->controller_name = 'products';
        $this->model->set_group_by([]);
        $this->model->set_order_by('id');
    }

    public function index($view = '')
    {
        $this->setTitle('Products');

        parent::index('products/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Products');
        parent::form(null, 'products/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Products');
        parent::form($id, 'products/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Products');
        parent::view($id, 'products/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function view_by_code($code, $view = '')
    {
        $this->setTitle('Detail Products');
        parent::view_by_code($code, 'products/view');
    }
}

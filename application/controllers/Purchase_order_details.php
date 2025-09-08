<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Purchase_order_details_model $model
 */
class Purchase_order_details extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Purchase_order_details_model','model');
        $this->controller_name = 'purchase_order_details';
    }

    public function index($view = '')
    {
        $this->setTitle('Purchase_order_details');
        
        parent::index('purchase_order_details/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Purchase_order_details');
        parent::form(null, 'purchase_order_details/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Purchase_order_details');
        parent::form($id, 'purchase_order_details/form');
    }

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Purchase_order_details');
        parent::view($id, 'purchase_order_details/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

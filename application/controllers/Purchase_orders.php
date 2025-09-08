<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Purchase_orders_model $model
 * @property Products_model $Products_model
 */
class Purchase_orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Purchase_orders_model', 'model');
        $this->load->model('Products_model');
        $this->load->model('Customers_model');
        $this->controller_name = 'purchase_orders';
    }

    public function index($view = '')
    {
        $this->setTitle('Purchase Orders');
        parent::index('purchase_orders/index');
    }

    public function create()
    {
        $this->setTitle('Tambah Purchase Order');
        $data['cust_options'] = [];
        $customers = $this->Customers_model->get_all_for_select();

        foreach ($customers as $cust) {
            if (!empty($cust->kd_cust)) {
                $data['cust_options'][$cust->kd_cust] = $cust->nm_cust;
            }
        }
        $products = $this->Products_model->get_all_for_select();
        $data['products_options'] = [];
        foreach ($products as $product) {
            if (!empty($product->kd_produk)) {
                $data['products_options'][$product->kd_produk] = $product->nama_produk;
            }
        }

        $this->form_with_details(null, 'purchase_orders/form', $data);
    }

    public function edit($id)
    {
        $this->setTitle('Edit Purchase Order');
        $products = $this->Products_model->get_all_for_select();
        $data['products_options'] = [];
        foreach ($products as $product) {
            if (!empty($product->kd_produk)) {
                $data['products_options'][$product->kd_produk] = $product->nama_produk;
            }
        }
        $this->form_with_details($id, 'purchase_orders/form', $data);
    }

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Purchase Order');
        parent::view($id, 'purchase_orders/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

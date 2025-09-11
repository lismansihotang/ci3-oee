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
        $this->load->model('Purchase_order_details_model', 'Purchase_order_details');
        $this->controller_name = 'purchase_orders';

        $this->model->set_group_by(['no_po']);
        $this->model->set_order_by('no_po');
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

    public function edit($id = null)
    {
        if ($id === null || !is_numeric($id)) {
            redirect('purchase_orders/index');
        }

        $this->setTitle('Edit Purchase Order');
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
        $this->form_with_details($id, 'purchase_orders/form', $data);
    }

    public function view($id = null, $view = '', $data = [])
    {
        if ($id === null || !is_numeric($id)) {
            redirect('purchase_orders/index');
        }

        $this->setTitle('Detail Purchase Order');
        $row = $this->model->get($id);
        $models = $this->model->get_data(['no_po' => ($row) ? $row->no_po : null]);
        $arrKeys = array_column_object($models, 'id');

        $data['detail_orders'] = $this->Purchase_order_details->get_data([], $arrKeys, 'id_po');
        parent::view($id, 'purchase_orders/view', $data);
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function update_status($id)
    {
        if ($this->input->post()) {
            $post_data = $this->input->post();

            if ($this->Purchase_order_details->update($post_data['id'], ['status' => $post_data['status']])) {
                $this->session->set_flashdata('swal_flash', json_encode([
                                    'status' => 'success',
                                    'message' => 'Status Data berhasil diubah!'
                                ]));
            } else {
                $this->session->set_flashdata('swal_flash', json_encode([
                                    'status' => 'error',
                                    'message' => 'Status Data gagal diubah'
                                ]));
            }
            redirect('purchase_orders/view/'.$id);
        }
    }
}

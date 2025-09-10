<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Customers_model $model
 */
class Customers extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_model', 'model');
        $this->controller_name = 'customers';
    }

    // Metode index() harus memiliki parameter opsional agar kompatibel.
    public function index($view = '')
    {
        $this->setTitle('Customers');
        // Panggil metode induk dengan view yang benar
        parent::index('customers/index');
    }

    // Metode create() harus memiliki parameter yang sama dengan parent::form().
    // CI akan mengisi parameter ini saat URL diakses.
    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Customer');
        parent::form(null, 'customers/form');
    }

    // Metode edit() harus memiliki parameter wajib $id.
    public function edit($id, $view = '')
    {
        $this->setTitle('Edit Customer');
        parent::form($id, 'customers/form');
    }

    // Metode view() harus memiliki parameter wajib $id.
    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Customer');
        parent::view($id, 'customers/view', $data = []);
    }

    // Metode delete() harus memiliki parameter wajib $id.
    public function delete($id)
    {
        parent::delete($id);
    }

    public function get_customer_data($customer_code)
    {

        $this->load->model('Customers_model');
        $customer = $this->Customers_model->get_by_code($customer_code);

        if ($customer) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'data' => $customer]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Customer not found']));
        }
    }
}

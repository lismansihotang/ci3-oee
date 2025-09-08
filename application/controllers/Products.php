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

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Products');
        parent::view($id, 'products/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    /**
     * Mengambil data produk berdasarkan kode produk dan mengembalikan JSON.
     * Endpoint ini akan digunakan oleh JavaScript untuk auto-fill.
     * * @param string $product_code Kode produk yang dicari.
     * @return void Mengeluarkan data JSON.
     */
    public function get_product_data($product_code)
    {
        // Pastikan ini adalah AJAX request atau cek hak akses

        $product = $this->model->get_by_code($product_code);

        if ($product) {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'data' => $product]));
        } else {
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => false, 'message' => 'Product not found']));
        }
    }
}

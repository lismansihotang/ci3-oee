<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Prod_qc_model $model
 */
class Prod_qc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_qc_model','model');
        $this->load->model('jenis_qc_model');
        $this->load->model('Products_model');
        $this->controller_name = 'prod_qc';
        $this->model->set_group_by([]);
        $this->model->set_order_by('id');
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_qc');
        
        parent::index('prod_qc/index');
    }

  Public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_qc');

        // Ambil kd_produk dari GET (misalnya ?kd_produk=2)
        $kd_produk = $this->input->get('kd_produk') ?? '';

        // Dropdown produk
        $data['produk_list'] = $this->Products_model->get_dropdown();
        $data['kd_produk']   = $kd_produk;

        // Default kosong
        $data['defects'] = [];

        // Jika produk dipilih, ambil defect + standar
        if ($kd_produk) {
            $data['defects'] = $this->Products_model->get_defects_with_standard($kd_produk);
        }

        $this->form_with_details(null, 'prod_qc/form', $data);
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_qc');
        parent::form($id, 'prod_qc/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_qc');
        parent::view($id, 'prod_qc/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }

   public function get_defects_ajax()
{
    $kd_produk = $this->input->post('kd_produk');
    $product = $this->db->where('kd_produk', $kd_produk)->get('products')->row_array();
    if(!$product){
        echo json_encode(['error' => "Produk $kd_produk tidak ditemukan"]);
        return;
    }
    $defects = $this->Products_model->get_defects_with_standard($kd_produk);
    echo json_encode($defects);
}


}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Spk_model $model
 */
class Spk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Spk_model', 'model');
        $this->load->model('Purchase_orders_model');
        $this->load->model('Machines_model');
        $this->controller_name = 'spk';
    }

    public function index($view = '')
    {
        $this->setTitle('Spk');

        parent::index('spk/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Spk');


        $this->data['list_po'] = $this->Purchase_orders_model->get_dropdown();
        $this->data['list_machines'] = $this->Machines_model->get_dropdown();

        parent::form(null, 'spk/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Spk');
        parent::form($id, 'spk/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Spk');
        parent::view($id, 'spk/view', $data = []);
    }

    public function delete($id)
    {
        parent::delete($id);
    }

    public function get_po_detail($id_po)
    {
        $this->load->model('Purchase_orders_model', 'po');
        $detail = $this->po->get_detail_by_po($id_po);

        if (!$detail) {
            log_message('debug', 'PO detail kosong untuk ID: ' . $id_po);
            echo json_encode([]);
            return;
        }

        $result = [
            'kd_product' => $detail->kd_product,
            'nama_produk' => $detail->nama_produk,
            'cavity'     => $detail->cavity,
            'ct'         => $detail->ct,
            'ct_print'         => $detail->ct_print,
            'ct_stamp'         => $detail->ct_stamp,
            'no_mould'         => $detail->no_mould,
        ];

        /**
        $result = [
            'kd_product' => "LWN089A",
            'nama_produk' => "Botol SH Zin 680ML 21 WT* (L)-A",
            'cavity'     => "2",
            'ct'         => "25.00",
            'ct_print'         => "2",
            'ct_stamp'         => "2",
            'no_mould'         => null,
        ]; */

        echo json_encode($result);
    }
}

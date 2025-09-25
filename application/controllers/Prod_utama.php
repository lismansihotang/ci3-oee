<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Prod_utama_model $model
 */
class Prod_utama extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_utama_model', 'model');
        $this->load->model('Machines_model');
        $this->load->model('Operators_model');
        $this->load->model('Spk_model');
        $this->load->model('jenis_downtimes_model');
        $this->controller_name = 'prod_utama';
        $this->load->helper('shift');
        $this->model->set_group_by([]);
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_utama');


        parent::index('prod_utama/index');
    }

    public function create()
    {
        $this->setTitle('Tambah Data Prod_utama');

        $data['mesin_options']    = $this->Machines_model->get_dropdown();
        $data['operator_options']    = $this->Operators_model->get_dropdown();
        $this->load->helper('shift'); // pastikan helper sudah di-load
        $data['produksi_details'] = get_shift_hours_rev(1);

        // kalau sudah ada model lain tinggal isi
        $data['spk_options']      = $this->Spk_model->get_dropdown();
        $data['downtime_options'] = $this->jenis_downtimes_model->get_dropdown();; // $this->Downtime_model->get_dropdown();
        $data['reject_options']   = []; // $this->Reject_model->get_dropdown();

        $this->form_with_details(null, 'prod_utama/form', $data);
    }


    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_utama');
        parent::form($id, 'prod_utama/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_utama');
        parent::view($id, 'prod_utama/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
    public function get_shift_hours($shift)
    {
        $hours = get_shift_hours($shift); // ambil dari helper
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($hours));
    }

    public function get_spk_target($id_spk)
    {
        $spk = $this->Spk_model->get_by_id($id_spk); // pakai id

        if ($spk) {
            $data = [
                'per_jam'   => $spk->tjam,
                'per_shift' => $spk->tshift,
                'per_day'   => $spk->tday,
                'ct'   => $spk->ct,
            ];
        } else {
            $data = [
                'per_jam'   => 0,
                'per_shift' => 0,
                'per_day'   => 0
            ];
        }

        echo json_encode($data);
    }
}

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
        $this->load->model('Prod_detail_model', 'prod_detail_model');
        $this->load->model('Prod_reject_model', 'prod_reject_model');
        $this->load->model('Prod_downtime_model', 'prod_downtime_model');
        $this->load->model('Machines_model');
        $this->load->model('Operators_model');
        $this->load->model('Spk_model');
        $this->load->model('Jenis_reject_model', 'jenis_reject_model');
        $this->load->model('jenis_downtimes_model');
        $this->controller_name = 'prod_utama';
        $this->load->helper('shift');
        $this->load->helper('time');
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
        $data['produksi_details'] = get_shift_hours_rev(1);

        // kalau sudah ada model lain tinggal isi
        $data['spk_options']      = $this->Spk_model->get_dropdown();
        $data['downtime_options'] = $this->jenis_downtimes_model->get_dropdown();; // $this->Downtime_model->get_dropdown();
        $data['reject_options']   = $this->jenis_reject_model->get_dropdown();

        $this->form_with_details(null, 'prod_utama/form', $data);
    }

    public function save()
    {
        $post_data = $this->input->post();

        // Begin transaction
        $this->db->trans_start();

        // prod_utama / prod_utama_model
        $main_data = [
            'tanggal' => $post_data['tanggal'],
            'kd_prod' => "-",
            'kd_ms' => $post_data['kd_ms'],
            'no_spk' => $post_data['no_spk'],
            'operators_id' => $post_data['operators_id'],
            'jml_pass' => $post_data['jml_pass'],
            'jml_hold' => $post_data['jml_hold'],
            'persen_pass' => $post_data['persen_pass'],
            'persen_reject' => $post_data['persen_reject'],
            'persen_down' => $post_data['persen_down']
        ];

        $this->model->insert($main_data);
        $prod_id = $this->db->insert_id();

        // prod_detail / prod_detail_model
        for ($i = 0; $i < count($post_data['jam']); $i++) {
            $details[] = [
                'prod_id' => $prod_id,
                'shift_id' => $post_data['shift'],
                'jam' => $post_data['jam'][$i],
                'pass_qty' => $post_data['pass'][$i],
                'hold_qty' => $post_data['hold'][$i]
            ];
        }

        // prod_reject / model prod_reject_model
        // apabila ada rejects
        $rejects = []; // untuk batch insert nanti

        for ($i = 0; $i < count($post_data['jam']); $i++) {
            $detail_data = [
                'prod_id'   => $prod_id,
                'shift_id'  => $post_data['shift'],
                'jam'       => $post_data['jam'][$i],
                'pass_qty'  => $post_data['pass'][$i],
                'hold_qty'  => $post_data['hold'][$i],
            ];

            $this->prod_detail_model->insert($detail_data);
            $detail_id = $this->db->insert_id();

            // kumpulkan reject jika ada
            if (isset($post_data['rejects'][$i]) && !empty($post_data['rejects'][$i])) {
                foreach ($post_data['rejects'][$i] as $reject) {
                    $rejects[] = [
                        'prod_detail_id' => $detail_id,
                        'kd_reject'      => $reject['jenis_reject'],
                        'qty'            => $reject['qty_reject'],
                    ];
                }
            }
        }

        // batch insert rejects
        if (!empty($rejects)) {
            $this->prod_reject_model->insert_batch($rejects);
        }

        // prod_downtime / model prod_downtime_modal
        $downtimes = [];
        for ($i = 0; $i < count($post_data['jam_mulai']); $i++) {
            $arr_time     = time_diff($post_data['jam_mulai'][$i], $post_data['jam_selesai'][$i]);
            $duration_min = $arr_time['total_minutes'];

            $downtimes[] = [
                'prod_id'      => $prod_id,
                'shift'        => $post_data['shift'],
                'kd_ms'        => $post_data['kd_ms'],
                'tanggal'      => $post_data['tanggal'],
                'downtime_id'  => $post_data['jenis'][$i],
                'start_time'   => $post_data['jam_mulai'][$i],
                'end_time'     => $post_data['jam_selesai'][$i],
                'duration_min' => $duration_min,
                'notes'        => $post_data['keterangan'][$i],
                'action'       => $post_data['action'][$i],
            ];
        }

        if (!empty($downtimes)) {
            $this->prod_downtime_model->insert_batch($downtimes);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Data gagal disimpan!');
        } else {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        }

        redirect('prod_utama');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_utama');
        $data['mesin_options']    = $this->Machines_model->get_dropdown();
        $data['operator_options']    = $this->Operators_model->get_dropdown();
        $data['produksi_details'] = get_shift_hours_rev(1);

        // kalau sudah ada model lain tinggal isi
        $data['spk_options']      = $this->Spk_model->get_dropdown();
        $data['downtime_options'] = $this->jenis_downtimes_model->get_dropdown();; // $this->Downtime_model->get_dropdown();
        $data['reject_options']   = $this->jenis_reject_model->get_dropdown();

        //parent::form($id, 'prod_utama/form');

        $this->form_with_details($id, 'prod_utama/form', $data);
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_utama');
        $data['prod_details'] = $this->prod_detail_model->get_data(['prod_id' => $id]);
        $data['prod_downtimes'] = $this->prod_downtime_model->get_data(['prod_id' => $id]);
        parent::view($id, 'prod_utama/view', $data);
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

        $data = [
            'per_jam'   => 757,
            'per_shift' => 6063,
            'per_day'   => 18189
        ];
        echo json_encode($data);
    }
}

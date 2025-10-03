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
        $this->load->helper('prod');
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_utama');


        parent::index('prod_utama/index');
    }

    /**
     * Mengisi data umum untuk create/edit
     */
    private function _commonFormData()
    {
        return [
            'mesin_options'    => $this->Machines_model->get_dropdown(),
            'operator_options' => $this->Operators_model->get_dropdown(),
            'spk_options'      => $this->Spk_model->get_dropdown(),
            'downtime_options' => $this->jenis_downtimes_model->get_dropdown(),
            'reject_options'   => $this->jenis_reject_model->get_dropdown(),
        ];
    }

    private function _process_shift_data($prod_id, $new_shift)
    {
        // Panggil helper global
        $old_shift_string = get_single_value('prod_utama_model', ['id' => $prod_id], 'sh');

        // Pastikan nilai kosong diganti string kosong, bukan NULL
        $old_shift_string = $old_shift_string ?? '';

        // 1. Gabungkan nilai lama dan baru ke dalam satu string, dipisahkan koma
        $combined_shifts = $old_shift_string . ',' . $new_shift;

        // 2. Bersihkan, Unikkan, dan Gabungkan kembali
        $shift_array = explode(',', $combined_shifts);
        $shift_array = array_map('trim', $shift_array);
        $shift_array = array_filter($shift_array);
        $shift_array = array_unique($shift_array);

        return implode(',', $shift_array);
    }

    public function create()
    {
        $this->setTitle('Tambah Data Prod_utama');

        $data['shift'] = 1;
        $data = $this->_commonFormData();
        $data['produksi_details'] = get_shift_hours_rev(1);
        $data['downtime_details'] = [];
        $data['reject_details']   = [];
        $data['reject_details_json'] = '{}';

        $this->form_with_details(null, 'prod_utama/form', $data);
    }

    public function save()
    {
        $post_data = $this->input->post();

        // Begin transaction
        $this->db->trans_start();

        $is_edit = !empty($post_data['prod_id']); // cek apakah edit
        $prod_id = $is_edit ? $post_data['prod_id'] : null;
        // shift
        $shift = isset($post_data['sh']) ? $post_data['sh'] : '1';

        // --- prod_utama / prod_utama_model ---
        $main_data = [
            'tanggal'      => $post_data['tanggal'],
            'sh'           => $this->_process_shift_data($prod_id, $shift),
            'kd_prod'      => "-", // bisa generate otomatis
            'kd_ms'        => $post_data['kd_ms'],
            'no_spk'       => $post_data['no_spk'],
            'operators_id' => $post_data['operators_id'],
            'jml_pass'     => $post_data['jml_pass'],
            'jml_hold'     => $post_data['jml_hold'],
            'persen_pass'  => $post_data['persen_pass'],
            'persen_reject' => $post_data['persen_reject'],
            'persen_down'  => $post_data['persen_down'],
        ];

        if ($is_edit) {
            $where_detail = ['prod_id' => $prod_id, 'shift' => $shift];
            $this->model->update($prod_id, $main_data);
            $prod_details = $this->prod_detail_model->get_data($where_detail);
            $prod_detail_ids = array_column($prod_details, 'id');

            if (!empty($prod_detail_ids)) {
                // hapus detail lama supaya clean insert lagi
                $this->prod_reject_model->delete_all(['prod_detail_id' => $prod_detail_ids]);
            }
            $this->prod_detail_model->delete_all($where_detail);
            $this->prod_downtime_model->delete_all($where_detail);
        } else {
            $this->model->insert($main_data);
            $prod_id = $this->db->insert_id();
        }

        // --- prod_detail ---
        $detail_ids = [];
        $jam_data = $post_data['jam'] ?? [];
        $id_data = $post_data['id'] ?? [];
        for ($i = 0; $i < count($jam_data); $i++) {
            $rowId = $id_data[$i] ?? $i;
            $detail_data = [
                'prod_id'   => $prod_id,
                'shift'  => $shift,
                'jam'       => $jam_data[$i],
                'pass_qty'  => ($post_data['pass_qty'][$i] !== '') ? $post_data['pass_qty'][$i] : 0,
                'hold_qty'  => ($post_data['hold_qty'][$i] !== '') ? $post_data['hold_qty'][$i] : 0,
            ];

            $this->prod_detail_model->insert($detail_data);
            $detail_id = $this->db->insert_id();

            // mapping rowId ke detail_id
            $detail_ids[$rowId] = $detail_id;
        }

        // --- prod_rejects ---
        $rejects = mapRejects($post_data['rejects'] ?? [], $detail_ids);
        if (!empty($rejects)) {
            $this->prod_reject_model->insert_batch($rejects);
        }

        // --- prod_downtime ---
        $downtimes = [];
        if (!empty($post_data['jam_mulai'])) {
            for ($i = 0; $i < count($post_data['jam_mulai']); $i++) {
                if ($post_data['jam_mulai'][$i] !== '' && $post_data['jam_selesai'][$i] !== '') {
                    $arr_time     = time_diff($post_data['jam_mulai'][$i], $post_data['jam_selesai'][$i]);
                    $duration_min = $arr_time['total_minutes'];
                    $downtimes[] = [
                        'prod_id'      => $prod_id,
                        'shift'        => $shift,
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
            }

            if (!empty($downtimes)) {
                $this->prod_downtime_model->insert_batch($downtimes);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Data gagal disimpan!');
        } else {
            $msg = $is_edit ? 'Data berhasil diperbarui!' : 'Data berhasil disimpan!';
            $this->session->set_flashdata('success', $msg);
        }

        redirect('prod_utama');
    }

    private function get_detail_rejects($prod_details = [])
    {
        $results = [];
        foreach ($prod_details as $detail) {
            $rejects = $this->prod_reject_model->get_data(['prod_detail_id' => $detail->id]);
            if ($rejects) {
                foreach ($rejects as $r) {
                    $results[$detail->id][] = (object) [
                        'jenis_reject' => $r->kd_reject,
                        'qty_reject'   => $r->qty
                    ];
                }
            } else {
                $results[$detail->id] = [];
            }
        }
        return $results;
    }

    private function get_data_downtimes($where = [])
    {
        $results = [];
        $downtimes = $this->prod_downtime_model->get_data($where);
        if ($downtimes) {
            foreach ($downtimes as $row) {
                $results[] = (object) [
                    'jam_mulai' => $row->start_time,
                    'jam_selesai' => $row->end_time,
                    'jenis' => $row->downtime_id,
                    'keterangan' => $row->notes,
                    'action' => $row->action,
                ];
            }
        }

        return $results;
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Prod_utama');
        $data = $this->_commonFormData();
        $prod_utama = $this->model->get_data(['id' => $id], [], '', true);
        $shift = 1;
        $arrShift = explode(',', $prod_utama->sh);
        if (!empty($arrShift)) {
            $count = count($arrShift);
            $shift = $arrShift[$count - 1];
        }
        $data['shift'] = $shift;
        $data['produksi_details'] = $this->prod_detail_model->get_data(['prod_id' => $id, 'shift' => $shift]);
        $data['downtime_details'] = $this->get_data_downtimes(['prod_id' => $id, 'shift' => $shift]);
        $data['reject_details'] = $this->get_detail_rejects($data['produksi_details']);
        $data['reject_details_json'] = json_encode($data['reject_details']);

        $this->form_with_details($id, 'prod_utama/form', $data);
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Prod_utama');
        $data['prod_details'] = $this->prod_detail_model->get_data(['prod_id' => $id]);
        $data['reject_details'] = $this->get_detail_rejects($data['prod_details']);
        $data['prod_downtimes'] = $this->prod_downtime_model->get_data(['prod_id' => $id]);
        $data['prod_id'] = $id;
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

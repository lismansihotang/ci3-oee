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
        $this->load->helper('calculation');
        $this->model->set_group_by(['kode_produksi']);
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

    // Tentukan shift
    $shift = isset($post_data['sh']) ? $post_data['sh'] : '1';
   $kode_produksi = str_replace("-", "", $post_data['tanggal']) . $post_data['kd_ms'] . $post_data['no_spk'];

    // Mulai transaksi
    $this->db->trans_start();

    $existing = $this->db->get_where('prod_utama', [
        'tanggal'    => $post_data['tanggal'],
        'kd_ms'      => $post_data['kd_ms'],
        'no_spk'     => $post_data['no_spk'],
        'sh'         => $shift,   
        'is_deleted' => 0
    ])->row();

    // --- Siapkan data utama ---
    $main_data = [
        'kode_produksi' => $kode_produksi, 
        'tanggal'       => $post_data['tanggal'],
        'kd_prod'       => $post_data['kd_prod'],
        'kd_ms'         => $post_data['kd_ms'],
        'no_spk'        => $post_data['no_spk'],
        'operators_id'  => $post_data['operators_id'],
        'persen_pass'   => $post_data['persen_pass'],
        'persen_reject' => $post_data['persen_reject'],
        'persen_down'   => $post_data['persen_down'],
        'sh'            => $shift,
    ];

    if (isset($post_data['phase'])) {
        $main_data['phase'] = $post_data['phase'];
    }

    if ($existing) {
        // === UPDATE + AKUMULASI per shift ===
        $main_data['jml_pass'] = $existing->jml_pass + (int)$post_data['jml_pass'];
        $main_data['jml_hold'] = $existing->jml_hold + (int)$post_data['jml_hold'];

        // Rata-rata persen per shift
        $main_data['persen_pass']   = round(($existing->persen_pass + $post_data['persen_pass']) / 2, 2);
        $main_data['persen_reject'] = round(($existing->persen_reject + $post_data['persen_reject']) / 2, 2);
        $main_data['persen_down']   = round(($existing->persen_down + $post_data['persen_down']) / 2, 2);

        $this->db->where('id', $existing->id)->update('prod_utama', $main_data);
        $prod_id = $existing->id;
    } else {
        // === INSERT BARU per shift ===
        $main_data['jml_pass'] = (int)$post_data['jml_pass'];
        $main_data['jml_hold'] = (int)$post_data['jml_hold'];
        $this->model->insert($main_data);
        $prod_id = $this->db->insert_id();
    }

    // === PROD DETAIL per shift ===
    $detail_ids = [];
    $jam_data = $post_data['jam'] ?? [];
    $id_data  = $post_data['id'] ?? [];

    for ($i = 0; $i < count($jam_data); $i++) {
        $rawId = $id_data[$i] ?? '';
        $rowId = ($rawId !== '') ? $rawId : 'new_' . $i;

        $detail_data = [
            'prod_id'   => $prod_id,
            'kode_produksi' => $kode_produksi, 
            'shift'     => $shift,
            'jam'       => $jam_data[$i],
            'pass_qty'  => ($post_data['pass_qty'][$i] !== '') ? $post_data['pass_qty'][$i] : 0,
            'hold_qty'  => ($post_data['hold_qty'][$i] !== '') ? $post_data['hold_qty'][$i] : 0,
        ];

        $this->prod_detail_model->insert($detail_data);
        $detail_id = $this->db->insert_id();
        $detail_ids[$rowId] = $detail_id;
    }

    // === PROD REJECTS ===
    $rejects = mapRejects($post_data['rejects'] ?? [], $detail_ids);
    if (!empty($rejects)) {
        $this->prod_reject_model->insert_batch($rejects);
    }

    // === PROD DOWNTIME ===
    $downtimes = [];
    if (!empty($post_data['jam_mulai'])) {
        for ($i = 0; $i < count($post_data['jam_mulai']); $i++) {
            if ($post_data['jam_mulai'][$i] !== '' && $post_data['jam_selesai'][$i] !== '') {
                $arr_time     = time_diff($post_data['jam_mulai'][$i], $post_data['jam_selesai'][$i]);
                $duration_min = $arr_time['total_minutes'];
                $downtimes[] = [
                    'prod_id'      => $prod_id,
                    'kode_produksi' => $kode_produksi, 
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

    // Commit transaksi
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        $this->session->set_flashdata('error', 'Data gagal disimpan!');
    } else {
        $this->session->set_flashdata('success', 'Data berhasil disimpan & diakumulasikan per shift!');
    }

    // Redirect ke shift berikutnya atau view
    $int_shift = (int)$shift;
    $page_redirect = ($int_shift < 3)
        ? 'prod_utama/edit/' . $prod_id . '/' . min($int_shift + 1, 3)
        : 'prod_utama/view/' . $prod_id;

    redirect($page_redirect);
}



    private function get_detail_rejects($prod_details = [])
    {
        $results = [];
        if (!empty($prod_details)) {
            $counter = 1;

            foreach ($prod_details as $detail) {
                if (isset($detail->id)) {
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
                } else {
                    $results[$counter] = [];
                }
                $counter++;
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
        $arrUri = $this->uri->segment_array();

        $this->setTitle('Ubah Data Prod_utama');
        $data = $this->_commonFormData();
        $prod_utama = $this->model->get_data(['id' => $id], [], '', true);
        // default shift
        $shift = 1;
        $arrShift = explode(',', $prod_utama->sh);
        if (!empty($arrShift)) {
            $count = count($arrShift);
            $shift = $arrShift[$count - 1];
        }
        // check via uri & assign shift if exists
        if (array_key_exists(4, $arrUri) === true) {
            $uri_segment = $arrUri[4];
            $arrShift = [1, 2, 3];
            if (in_array($uri_segment, $arrShift) === true) {
                $shift = $uri_segment;
            }
        }

        $data['shift'] = $shift;
        $details = $this->prod_detail_model->get_data(['prod_id' => $id, 'shift' => $shift]);
        $data['produksi_details'] = ($details) ? $details : get_shift_hours_rev($shift);
        $data['downtime_details'] = $this->get_data_downtimes(['prod_id' => $id, 'shift' => $shift]);
        $data['reject_details'] = $this->get_detail_rejects($data['produksi_details']);
        $data['reject_details_json'] = json_encode($data['reject_details']);

        $this->form_with_details($id, 'prod_utama/form', $data);
    }

    public function view($id, $view = '', $data = [])
{
    $this->setTitle('Detail Prod_utama');

    // ambil detail berdasarkan kode_produksi
    $data['prod_details']    = $this->prod_detail_model->get_with_reject(['prod_detail.prod_id' => $id]);
    $data['reject_details']  = $this->get_detail_rejects($data['prod_details']);
    $data['prod_downtimes']  = $this->prod_downtime_model->get_data(['prod_downtime.prod_id' => $id]);
    $data['prod_id']   = $id;

    // jangan kirim $kode_produksi ke parent (karena parent view biasanya baca ID)
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
    $spk = $this->Spk_model->get_by_id($id_spk); // ambil data SPK dari model

    if ($spk) {
        $data = [
            'per_jam'   => (float)$spk->tjam,
            'per_shift' => (float)$spk->tshift,
            'per_day'   => (float)$spk->tday,
            'ct'        => (float)$spk->ct,
            'kd_product' => $spk->kd_product ?? '', // jika ingin menampilkan nama produk juga
            'nama_produk' => $spk->nama_produk ?? '',
            'produk_gabung' => trim(($spk->kd_product ?? '') . ' - ' . ($spk->nama_produk ?? ''))
        ];
    } else {
        $data = [
            'per_jam'   => 0,
            'per_shift' => 0,
            'per_day'   => 0,
            'ct'        => 0,
            'kd_product' => '',
            'nama_produk' => '',
            'produk_gabung' => ''
        ];
    }

    echo json_encode($data);
}

    public function get_jenis_mesin($mesin_id)
    {
        echo json_encode(strtolower(get_single_value('Machines_model', ['id' => $mesin_id], 'jenis_mesin')));
    }
    
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Prod_qc_model $model
 */
class Prod_qc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prod_qc_model', 'model');
        $this->load->model('Products_model');
        $this->load->model('Machines_model');
        $this->load->model('Jenis_qc_model');
        $this->load->helper(['qc']);
        $this->controller_name = 'prod_qc';
        $this->model->set_group_by(['prod_id', 'kd_ms', 'tanggal']);
        $this->model->set_order_by('id', 'ASC');
    }

    public function index($view = '')
    {
        $this->setTitle('Prod_qc');

        parent::index('prod_qc/index');
    }

    public function _common_data()
    {
        return [
            'mesin_options'    => $this->Machines_model->get_dropdown(),
            'product_options' => $this->Products_model->get_dropdown(),
        ];
    }
    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Prod_qc');

        // Ambil kd_produk dari GET (misalnya ?kd_produk=2)
        $kd_produk = $this->input->get('kd_produk') ?? '';

        // Dropdown produk
        $data = $this->_common_data();
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

        // 🔹 Ambil data header utama
        $row = $this->model->get_data(['id' => $id], [], '', true);
        if (!$row) {
            show_404();
        }

        $data = $this->_common_data();
        $data['row'] = $row;

        // 🔹 Ambil semua hasil QC lama berdasarkan prod_id, kd_ms, dan tanggal
        $qc_rows = $this->model->get_data([
            'prod_id' => $row->prod_id,
            'kd_ms'   => $row->kd_ms,
            'tanggal' => $row->tanggal,
        ], [], '', false);

        $ms_row = $this->Machines_model->get_data(['id' => $row->kd_ms], [], '', true);
        // 🔹 Ambil daftar defect (master QC)
        $defects = $this->Jenis_qc_model->get_data(['kd_ms' => $ms_row->kode_mesin], [], '', false);

        $prod_row = $this->Products_model->get_data(['id' => $row->prod_id], [], '', true);
        $product_defects = $this->Products_model->get_defects_with_standard($prod_row->kd_produk);

        //var_dump($product_defects);
        //exit;
        // 🔹 Jika master kosong, ambil unique defect dari hasil lama
        if (empty($defects) && !empty($qc_rows)) {
            $unique_qc = [];
            foreach ($qc_rows as $r) {
                $unique_qc[$r->kd_qc] = (object)[
                    'kd_qc'   => $r->kd_qc,
                    'nama_qc' => $r->kd_qc,
                    'standar' => '',
                ];
            }
            $defects = array_values($unique_qc);
        }

        // 🔹 Siapkan struktur nilai dari database lama (shift → kode → jam → nilai)
        $existing = [];
        if (!empty($qc_rows)) {
            foreach ($qc_rows as $r) {
                $shift = (int) $r->shift;
                $kode  = trim($r->kd_qc);
                $jam   = date('H:i', strtotime($r->jam)); // format yang konsisten dgn get_shift_hours()
                $existing[$shift][$kode][$jam] = $r->nilai ?? '';
            }
        }

        // 🔹 Tentukan shift yang digunakan (bisa 1–3)
        $shifts = [1, 2, 3];

        // 🔹 Gabungkan defect dari master + hasil lama agar semua muncul
        $qc_defects = [];
        foreach ($defects as $d) {
            $kode = trim($d->kd_qc);
            $qc_defects[$kode] = [
                'kode'    => $kode,
                'nama'    => $d->nama_qc,
                'standar' => $d->standar,
            ];
        }
        if (!empty($qc_rows)) {
            foreach ($qc_rows as $r) {
                $kode = trim($r->kd_qc);
                if (!isset($qc_defects[$kode])) {
                    $qc_defects[$kode] = [
                        'kode'    => $kode,
                        'nama'    => $kode,
                        'standar' => '',
                    ];
                }
            }
        }
        $qc_defects = array_values($qc_defects);

        // 🔹 Bangun data gabungan untuk ditampilkan (shift × defect × jam)
        $qc_data = [];
        foreach ($shifts as $shift) {
            $hours = get_shift_hours($shift);
            foreach ($qc_defects as $def) {
                $kode = trim($def['kode']);
                foreach ($hours as $h) {
                    $jam = $h['jam_mulai'];
                    $qc_data[$shift][$kode][$jam] = $existing[$shift][$kode][$jam] ?? '';
                }
            }
        }

        // 🔹 Render tabel QC per shift (accordion)
        $data['qc_html'] = render_qc_grid(
            $shifts,
            $qc_defects,
            $qc_data,
            [
                'accordion' => true,
                'accordion_id' => 'qcAccordion',
                'accordion_default_open' => 0,
                'accordion_flush' => true,
                'accordion_auto_collapse_except_opened' => true,
            ]
        );
        /**echo "<pre>";
        print_r($defects);
        //print_r($qc_defects);
        echo "data";
        //print_r($qc_data);
        echo "</pre>";
        exit;**/
        return $this->render('prod_qc/form', $data);
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
        if (!$product) {
            echo json_encode(['error' => "Produk $kd_produk tidak ditemukan"]);
            return;
        }
        $defects = $this->Products_model->get_defects_with_standard($kd_produk);
        echo json_encode($defects);
    }

    public function get_qc_ajax($kd_produk = null, $kd_mesin = null, $with_data = false)
    {
        $json = [];
        if ($kd_mesin !== null) {
            $kode_mesin = get_single_value('Machines_model', ['id' => $kd_mesin], 'kode_mesin');
            $data_mesin = $this->Jenis_qc_model->get_data(['kd_ms' => $kode_mesin], [], '', false);
            if ($data_mesin) {
                foreach ($data_mesin as $row_mesin) {
                    $json[] = ['kode' => $row_mesin->kd_qc, 'nama' => $row_mesin->nama_qc, 'standar' => $row_mesin->standar];
                }
            }
        }

        $qc_data = [];
        if ($with_data && $kd_produk && $kd_mesin) {
            $qc_data = $this->db->get_where('prod_qc', [
                'prod_id' => $kd_produk,
                'kd_ms' => $kd_mesin,
            ])->result_array();
        }

        echo json_encode(render_qc_grid([1, 2, 3], $json, $qc_data, [
            'accordion' => true,
            'accordion_id' => 'qcAccordion',
            'accordion_default_open' => 0,
            'accordion_flush' => true,
            'accordion_auto_collapse_except_opened' => true,
        ]));
    }


    public function save()
    {
        $post_data = $this->input->post();

        // --- Validasi dasar ---
        if (empty($post_data['prod_id']) || empty($post_data['kd_ms'])) {
            $this->session->set_flashdata('error', 'Kode Produk dan Mesin wajib diisi.');
            redirect('prod_qc/create');
            return;
        }

        // --- Parse data hasil post ---
        $data = parse_qc_post_data($post_data);

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Tidak ada data QC yang valid untuk disimpan.');
            redirect('prod_qc/create');
            return;
        }

        // --- Mulai transaksi ---
        $this->db->trans_begin();

        try {
            // (Opsional) hapus data QC lama berdasarkan kombinasi produk + mesin + tanggal
            $this->db->where('prod_id', $post_data['prod_id']);
            $this->db->where('kd_ms', $post_data['kd_ms']);
            $this->db->where('tanggal', isset($post_data['tanggal']) ? $post_data['tanggal'] : date('Y-m-d'));
            $this->db->delete('prod_qc');

            // Insert batch data baru
            $this->db->insert_batch('prod_qc', $data);

            // Commit / rollback sesuai status
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Gagal menyimpan data QC.');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'Data QC berhasil disimpan.');
            }
        } catch (Throwable $e) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // --- Redirect ke halaman view ---
        redirect('prod_qc/view/' . $post_data['prod_id']);
    }

    public function details($id)
    {
        $arrUri = $this->uri->segment_array();
        $data['row'] = $this->model->get_data(['prod_id' => $arrUri[3], 'kd_ms' => $arrUri[4], 'tanggal' => $arrUri[5]]);
        //var_dump($data['row']);
        return $this->render('prod_qc/view', $data);
    }
}

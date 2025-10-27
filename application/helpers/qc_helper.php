<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * ==========================================================
 * SHIFT DAN INPUT QC HELPER
 * ==========================================================
 */

if (! function_exists('get_shift_hours')) {
    /**
     * Mengembalikan daftar jam kerja per shift (per jam)
     */
    function get_shift_hours($shift)
    {
        $hours = [];

        switch ($shift) {
            case 1:
                $start = strtotime('08:00');
                $end   = strtotime('16:00');
                break;
            case 2:
                $start = strtotime('16:00');
                $end   = strtotime('23:59');
                break;
            default:
                $start = strtotime('00:00');
                $end   = strtotime('08:00');
                break;
        }

        while ($start < $end) {
            $jam_mulai   = date('H:i', $start);
            $jam_selesai = date('H:i', strtotime('+1 hour', $start));
            $hours[] = [
                'jam_mulai'   => $jam_mulai,
                'jam_selesai' => $jam_selesai
            ];
            $start = strtotime('+1 hour', $start);
        }

        return $hours;
    }
}


if (! function_exists('guess_input_type')) {
    /**
     * Menebak jenis input berdasarkan teks standar
     */
    function guess_input_type($standar)
    {
        $text = trim(strtolower($standar ?? ''));

        if ($text === '') {
            return 'text';
        }

        if (preg_match('/app|rap|halus|lurus/', $text)) {
            return 'checkbox';
        }

        if (preg_match('/mm|g|pcs|±|ml/', $text)) {
            return 'text';
        }

        return 'checkbox';
    }
}


if (! function_exists('render_qc_grid')) {
    /**
     * Render grid QC berdasarkan shift
     */
    function render_qc_grid($shift, $defects, $data_db = [], $options = [])
    {
        $shifts         = is_array($shift) ? $shift : [$shift];
        $readonly       = $options['readonly'] ?? false;
        $input_class    = $options['input_class'] ?? 'form-control form-control-sm text-center';
        $use_accordion  = $options['accordion'] ?? false;
        $accordion_id   = $options['accordion_id'] ?? 'qcAccordion';
        $default_open   = $options['accordion_default_open'] ?? 0;
        $flush          = $options['accordion_flush'] ?? true;
        $auto_collapse  = $options['accordion_auto_collapse_except_opened'] ?? true;
        $actions        = $options['actions'] ?? [];

        // 🔹 Jika mode Accordion
        if ($use_accordion) {
            $items = [];
            foreach ($shifts as $index => $s) {
                $items[] = [
                    'title'      => 'SHIFT ' . $s,
                    'icon'       => 'bi bi-clock-history',
                    'content'    => build_qc_table($s, $defects, $data_db, $readonly, $input_class),
                    'body_class' => 'p-2',
                    'actions'    => $actions[$s] ?? []
                ];
            }

            $html = generate_accordion($items, $accordion_id, $flush, $default_open);

            // Auto collapse JS
            if ($auto_collapse) {
                $html .= '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    const acc = document.getElementById("' . $accordion_id . '");
                    if (!acc) return;
                    acc.querySelectorAll(".accordion-button").forEach(btn => {
                        btn.addEventListener("click", () => {
                            acc.querySelectorAll(".accordion-collapse").forEach(col => {
                                if (!btn.dataset.bsTarget.includes(col.id)) {
                                    const ins = bootstrap.Collapse.getInstance(col);
                                    if (ins) ins.hide();
                                }
                            });
                        });
                    });
                });
                </script>';
            }

            return $html;
        }

        // 🔸 Mode Default (gabungan semua shift)
        $hours_all = [];
        foreach ($shifts as $s) {
            foreach (get_shift_hours($s) as $h) {
                $key = $s . '-' . $h['jam_mulai'];
                $hours_all[$key] = ['shift' => $s, 'jam_mulai' => $h['jam_mulai']];
            }
        }
        ksort($hours_all);

        $html = '<table class="table table-bordered table-sm text-center align-middle">';
        $html .= '<thead><tr><th rowspan="2">TYPE OF DEFECT</th><th rowspan="2">STANDARD</th>';

        foreach ($shifts as $s) {
            $html .= '<th colspan="' . count(get_shift_hours($s)) . '">SHIFT ' . $s . '</th>';
        }

        $html .= '</tr><tr>';
        foreach ($hours_all as $h) {
            $html .= '<th>' . $h['jam_mulai'] . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        foreach ($defects as $d) {
            $kode   = $d['kode'];
            $nama   = $d['nama'];
            $standar = $d['standar'] ?? '';
            $input_type = $d['input_type'] ?? guess_input_type($standar);
            $default_val = $d['default'] ?? '';

            $html .= '<tr>';
            $html .= '<td class="text-start">' . htmlspecialchars($nama) . '</td>';
            $html .= '<td>' . htmlspecialchars($standar) . '</td>';

            foreach ($hours_all as $h) {
                $s = $h['shift'];
                $jam = $h['jam_mulai'];
                $name = 'result[' . $s . '][' . $kode . '][' . $jam . ']';
                $value = $data_db[$s][$kode][$jam] ?? $default_val;
                $ro = $readonly ? 'readonly disabled' : '';

                if ($input_type === 'checkbox') {
                    $checked = ($value == 1 || $value === true || $value === 'on') ? 'checked' : '';
                    $html .= '<td><input type="checkbox" name="' . $name . '" value="1" ' . $checked . ' ' . $ro . '></td>';
                } else {
                    $html .= '<td><input type="text" name="' . $name . '" value="' . htmlspecialchars($value) . '" class="' . $input_class . '" ' . $ro . '></td>';
                }
            }

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }
}


if (! function_exists('build_qc_table')) {
    /**
     * Bangun tabel QC untuk 1 shift (digunakan oleh render_qc_grid)
     */
    function build_qc_table($shift_no, $defects, $data_db, $readonly, $input_class)
    {
        $hours = get_shift_hours($shift_no);
        $html  = '<table class="table table-bordered table-sm text-center align-middle mb-0">';
        $html .= '<thead><tr>';
        $html .= '<th rowspan="2">TYPE OF DEFECT</th>';
        $html .= '<th rowspan="2">STANDARD</th>';
        $html .= '<th colspan="' . count($hours) . '">SHIFT ' . $shift_no . '</th>';
        $html .= '</tr><tr>';

        foreach ($hours as $h) {
            $html .= '<th>' . $h['jam_mulai'] . '</th>';
        }

        $html .= '</tr></thead><tbody>';

        foreach ($defects as $d) {
            $kode   = $d['kode'];
            $nama   = $d['nama'];
            $standar = $d['standar'] ?? '';
            $input_type = $d['input_type'] ?? guess_input_type($standar);
            $default_val = $d['default'] ?? '';

            $html .= '<tr>';
            $html .= '<td class="text-start">' . htmlspecialchars($nama) . '</td>';
            $html .= '<td>' . htmlspecialchars($standar) . '</td>';

            foreach ($hours as $h) {
                $jam = $h['jam_mulai'];
                $name = 'result[' . $shift_no . '][' . $kode . '][' . $jam . ']';
                $value = $data_db[$shift_no][$kode][$jam] ?? $default_val;
                $ro = $readonly ? 'readonly disabled' : '';

                if ($input_type === 'checkbox') {
                    $checked = ($value == 1 || $value === true || $value === 'on') ? 'checked' : '';
                    $html .= '<td><input type="checkbox" name="' . $name . '" value="1" ' . $checked . ' ' . $ro . '></td>';
                } else {
                    $html .= '<td><input type="text" name="' . $name . '" value="' . htmlspecialchars($value) . '" class="' . $input_class . '" ' . $ro . '></td>';
                }
            }

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        return $html;
    }
}

if (!function_exists('parse_qc_post_data')) {
    /**
     * Mengubah $_POST['result'] menjadi format siap insert_batch
     *
     * @param array $post Data POST dari form QC
     * @return array Data siap insert_batch ke tabel qc_result
     */
    function parse_qc_post_data($post)
    {
        $results = [];

        // Validasi dasar
        if (!is_array($post) || !isset($post['result']) || !is_array($post['result'])) {
            return $results;
        }

        // Ambil field utama dari POST
        $prod_id = isset($post['prod_id']) ? trim($post['prod_id']) : null;
        $kd_ms   = isset($post['kd_ms']) ? trim($post['kd_ms']) : null;
        $tanggal = isset($post['tanggal']) ? trim($post['tanggal']) : date('Y-m-d');

        foreach ($post['result'] as $shift => $defect_data) {
            if (!is_array($defect_data)) continue;

            foreach ($defect_data as $kode_defect => $jam_data) {
                if (!is_array($jam_data)) continue;

                foreach ($jam_data as $jam => $value) {
                    $val = ($value === 'on' || $value === 1) ? 1 : trim((string)$value);

                    $results[] = [
                        'prod_id' => $prod_id,
                        'kd_ms'   => $kd_ms,
                        'tanggal' => $tanggal,
                        'shift'   => (int)$shift,
                        'kd_qc'   => $kode_defect,
                        'kd_jenis_qc' => 0,
                        'jam'     => $jam,
                        'nilai'   => $val,
                    ];
                }
            }
        }

        return $results;
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Helper untuk membuat tabel bootstrap otomatis
 * 
 * Contoh:
 * echo build_table([
 *   'headers' => ['ID', 'Nama', 'Email'],
 *   'rows'    => $users,
 *   'actions' => [
 *       'view'   => 'users/view',
 *       'edit'   => 'users/edit',
 *       'delete' => 'users/delete',
 *   ]
 * ]);
 */
if (!function_exists('build_table')) {
    function build_table($params = [])
    {
        $headers = $params['headers'] ?? [];
        $rows    = $params['rows'] ?? [];
        $actions = $params['actions'] ?? [];

        $CI = &get_instance();

        $html  = '<div class="table-responsive mb-2"><table class="table border table-hover mb-0">';
        $html .= '<thead class="fw-semibold text-nowrap"><tr class="align-middle">';

        // headers
        $html .= '<th class="bg-body-secondary text-center">#</th>';
        foreach ($headers as $h) {
            $html .= '<th class="bg-body-secondary">' . htmlspecialchars($h) . '</th>';
        }
        if (!empty($actions)) {
            $html .= '<th class="bg-body-secondary text-center">Aksi</th>';
        }
        $html .= '</tr></thead><tbody>';

        // isi data
        if (!empty($rows)) {
            $counter = 1;
            foreach ($rows as $r) {
                $html .= '<tr class="text-center">';
                $html .= '<td>' . htmlspecialchars($counter) . '</td>';
                foreach ($headers as $h) {
                    $field = strtolower($h);
                    $value = isset($r->$field) ? $r->$field : '';
                    $html .= '<td>' . htmlspecialchars($value) . '</td>';
                }

                // kolom aksi
                if (!empty($actions)) {
                    $html .= '<td>';
                    if (isset($actions['view'])) {
                        $html .= '<a href="' . site_url($actions['view'] . '/' . $r->id) . '" class="btn btn-sm btn-info" data-coreui-toggle="tooltip" data-coreui-placement="top" title="View Data Ini"><i class="icon cil-browser"></i> View</a> ';
                    }
                    if (isset($actions['edit'])) {
                        $html .= '<a href="' . site_url($actions['edit'] . '/' . $r->id) . '" class="btn btn-sm btn-warning" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Edit Data Ini"><i class="icon cil-pencil"></i> Edit</a> ';
                    }
                    if (isset($actions['delete'])) {
                        $html .= '<a href="' . site_url($actions['delete'] . '/' . $r->id) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Data Ini"><i class="icon cil-trash"></i> Delete</a>';
                    }
                    $html .= '</td>';
                }
                $html .= '</tr>';
                $counter++;
            }
        } else {
            $colspan = count($headers) + (!empty($actions) ? 1 : 0);
            $html .= '<tr><td colspan="' . $colspan . '" class="text-center">Tidak ada data</td></tr>';
        }

        $html .= '</tbody></table></div>';

        return $html;
    }
}

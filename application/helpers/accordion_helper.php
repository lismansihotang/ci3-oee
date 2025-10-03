<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==========================================================
 * 3. ACCORDION VIEW HELPER
 * (Dengan dukungan body_class dan button di title)
 * ==========================================================
 * 
 * 'actions' => [
    [
        'label' => '<i class="cil-pencil"></i>', // Ikon
        'url'   => 'production/edit_shift/' . $shift_id, 
        'class' => 'btn btn-sm btn-info',
        'data'  => ['bs-toggle' => 'tooltip', 'title' => 'Edit Data Shift'] // Tooltip
    ],
    [
        'label' => '<i class="cil-print"></i>', // Ikon
        'url'   => 'production/print_shift/' . $shift_id,
        'class' => 'btn btn-sm btn-warning',
        'data'  => ['bs-toggle' => 'tooltip', 'title' => 'Cetak Laporan']
    ]
]

 * 'actions' => [
    [
        'type' => 'dropdown',
        'icon' => '<i class="cil-list-numbered"></i>', // Ganti ikon dropdown
        'class' => 'btn btn-sm btn-outline-dark', // Kelas untuk tombol utama dropdown
        'items' => [
            [
                'label' => 'Edit Detail',
                'url'   => 'production/edit_detail/' . $shift_id,
                'icon'  => 'cil-pencil'
            ],
            [
                'label' => 'Cetak Laporan',
                'url'   => 'production/print_shift/' . $shift_id,
                'icon'  => 'cil-print'
            ],
            [
                'label' => 'Hapus Semua',
                'url'   => 'production/delete_shift/' . $shift_id,
                'icon'  => 'cil-trash',
                'class' => 'text-danger'
            ],
        ]
    ]
]
 */

if (!function_exists('generate_accordion')) {

    function generate_accordion(array $items, string $id, bool $flush = FALSE, int $default_open = -1)
    {
        if (empty($items)) {
            return '';
        }

        $accordion_class = 'accordion' . ($flush ? ' accordion-flush' : '');
        $html = '<div class="' . $accordion_class . '" id="' . html_escape($id) . '">';

        foreach ($items as $index => $item) {
            $is_open = ($index === $default_open);
            $collapse_class = 'accordion-collapse collapse' . ($is_open ? ' show' : '');
            $expanded_attr = $is_open ? 'true' : 'false';
            $button_class = 'accordion-button' . ($is_open ? '' : ' collapsed');

            $heading_id = $id . '-heading-' . ($index + 1);
            $collapse_id = $id . '-collapse-' . ($index + 1);

            // Menangani Ikon
            $icon_html = '';
            if (isset($item['icon']) && !empty($item['icon'])) {
                $icon_html = '<i class="' . htmlspecialchars($item['icon']) . ' me-2"></i>';
            }

            // --- Menangani Aksi/Button di Title ---
            $actions_html = '';
            $actions_data = $item['actions'] ?? [];

            if (!empty($actions_data)) {

                // Cek jika aksi berupa dropdown (Opsi 3)
                if (count($actions_data) === 1 && isset($actions_data[0]['type']) && $actions_data[0]['type'] === 'dropdown') {
                    $actions_html = render_accordion_dropdown_actions($id, $index, $actions_data[0]);
                } else {
                    // Render Tombol Aksi biasa (Opsi 1 & 2)
                    $is_first = true;
                    foreach ($actions_data as $action) {
                        $action_url   = $action['url'] ?? '#';
                        $action_label = $action['label'] ?? 'Action';
                        $action_class = $action['class'] ?? 'btn btn-sm btn-outline-secondary';

                        $margin_class = $is_first ? '' : 'ms-2'; // ms-2 hanya untuk tombol kedua dan seterusnya
                        $is_first = false;

                        // Menambahkan data attributes (untuk Tooltip)
                        $data_attr_html = '';
                        if (isset($action['data']) && is_array($action['data'])) {
                            foreach ($action['data'] as $data_key => $data_val) {
                                $data_attr_html .= ' data-' . html_escape($data_key) . '="' . html_escape($data_val) . '"';
                            }
                        }

                        // Label tidak di-escape karena mungkin berisi tag <i>
                        $actions_html .= '<a href="' . html_escape(base_url($action_url)) . '" class="' . html_escape($action_class) . ' ' . $margin_class . '"' . $data_attr_html . '>';
                        $actions_html .= $action_label;
                        $actions_html .= '</a>';
                    }
                }
            }

            // Tambahkan class d-flex untuk mengatur tata letak
            $header_class = 'accordion-header d-flex justify-content-between align-items-center';

            // --- Item Accordion ---
            $html .= '<div class="accordion-item">';

            // --- Header/Button ---
            $html .= '<h2 class="' . $header_class . '" id="' . $heading_id . '">';

            // Tombol Collapse (flex-grow-1 agar menempati sisa ruang)
            $html .= '<button class="flex-grow-1 ' . $button_class . '" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapse_id . '" aria-expanded="' . $expanded_attr . '" aria-controls="' . $collapse_id . '">';
            $html .= $icon_html . htmlspecialchars($item['title']);
            $html .= '</button>';

            // Kontainer untuk Aksi (PENTING: HILANGKAN py-2)
            if (!empty($actions_html)) {
                $html .= '<div class="me-2 align-self-center py-1">';
                $html .= $actions_html;
                $html .= '</div>';
            }

            $html .= '</h2>';

            // --- Body Content ---
            $body_class = $item['body_class'] ?? '';

            $html .= '<div id="' . $collapse_id . '" class="' . $collapse_class . '" aria-labelledby="' . $heading_id . '" data-bs-parent="#' . $id . '">';
            $html .= '<div class="accordion-body ' . html_escape($body_class) . '">';
            $html .= $item['content'];
            $html .= '</div></div></div>';
        }

        $html .= '</div>';
        return $html;
    }
}

// Tambahkan sub-helper untuk rendering dropdown
if (!function_exists('render_accordion_dropdown_actions')) {
    function render_accordion_dropdown_actions($id, $index, $col)
    {
        $items  = $col['items'] ?? [];
        $menuId = $id . 'DropdownMenu' . $index;
        $icon   = $col['icon'] ?? '<i class="cil-options"></i>'; // Default ikon kebab 3 titik
        $class  = $col['class'] ?? 'btn btn-sm btn-outline-secondary';

        $html  = '<div class="dropdown">';
        // Tombol Dropdown
        $html .= '<button class="' . html_escape($class) . ' dropdown-toggle" type="button" id="' . $menuId . '" data-bs-toggle="dropdown" aria-expanded="false">';
        $html .= $icon;
        $html .= '</button>';

        // Menu Dropdown
        $html .= '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="' . $menuId . '">'; // dropdown-menu-end agar muncul di kanan

        foreach ($items as $item) {
            $url   = $item['url'] ?? '#';
            $label = $item['label'] ?? 'Action';
            $item_icon = $item['icon'] ?? '';
            $class = $item['class'] ?? '';

            $icon_html = !empty($item_icon) ? '<i class="' . html_escape($item_icon) . ' me-2"></i>' : '';

            $html .= '<li><a class="dropdown-item ' . html_escape($class) . '" href="' . html_escape(base_url($url)) . '">' . $icon_html . html_escape($label) . '</a></li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}

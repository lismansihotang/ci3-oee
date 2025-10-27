<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ==========================================================
 * ACCORDION VIEW HELPER (Bootstrap 5)
 * - Support body_class, icon, action button & dropdown action
 * - Clean & reusable for CI3
 * ========================================================== */

if (!function_exists('generate_accordion')) {
    /**
     * Generate Bootstrap 5 Accordion
     *
     * @param array $items - Setiap item berisi:
     *   [
     *      'title' => 'Judul',
     *      'icon' => 'cil-calendar',
     *      'content' => '<table>...</table>',
     *      'body_class' => 'p-3',
     *      'actions' => [...] // optional
     *   ]
     * @param string $id - ID unik accordion
     * @param bool $flush - true: border hilang antar item
     * @param int $default_open - index item yang terbuka pertama (0-based)
     * @return string
     */
    function generate_accordion(array $items, string $id, bool $flush = false, int $default_open = -1)
    {
        if (empty($items)) {
            return '';
        }

        $accordion_class = 'accordion' . ($flush ? ' accordion-flush' : '');
        $html = '<div class="' . $accordion_class . '" id="' . html_escape($id) . '">';

        foreach ($items as $index => $item) {
            $heading_id  = $id . '-heading-' . $index;
            $collapse_id = $id . '-collapse-' . $index;

            $is_open = ($index === $default_open);
            $show_class = $is_open ? ' show' : '';
            $collapsed_class = $is_open ? '' : ' collapsed';

            $title  = htmlspecialchars($item['title'] ?? 'Accordion Item ' . ($index + 1));
            $icon   = isset($item['icon']) && $item['icon'] !== ''
                ? '<i class="' . html_escape($item['icon']) . ' me-2"></i>'
                : '';
            $body_class = $item['body_class'] ?? '';
            $content = $item['content'] ?? '';

            // --- Render actions (buttons or dropdown) ---
            $actions_html = '';
            $actions = $item['actions'] ?? [];
            if (!empty($actions)) {
                if (count($actions) === 1 && isset($actions[0]['type']) && $actions[0]['type'] === 'dropdown') {
                    $actions_html = render_accordion_dropdown_actions($id, $index, $actions[0]);
                } else {
                    $is_first = true;
                    foreach ($actions as $action) {
                        $url   = base_url($action['url'] ?? '#');
                        $label = $action['label'] ?? 'Action';
                        $class = $action['class'] ?? 'btn btn-sm btn-outline-secondary';
                        $margin = $is_first ? '' : ' ms-2';
                        $is_first = false;

                        $data_attrs = '';
                        if (isset($action['data']) && is_array($action['data'])) {
                            foreach ($action['data'] as $key => $val) {
                                $data_attrs .= ' data-' . html_escape($key) . '="' . html_escape($val) . '"';
                            }
                        }

                        $actions_html .= '<a href="' . html_escape($url) . '" class="' . html_escape($class . $margin) . '"' . $data_attrs . '>';
                        $actions_html .= $label;
                        $actions_html .= '</a>';
                    }
                }
            }

            // --- Render accordion item ---
            $html .= '<div class="accordion-item">';
            $html .= '  <h2 class="accordion-header d-flex justify-content-between align-items-center" id="' . $heading_id . '">';
            $html .= '    <button class="accordion-button flex-grow-1' . $collapsed_class . '" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapse_id . '" aria-expanded="' . ($is_open ? 'true' : 'false') . '" aria-controls="' . $collapse_id . '">';
            $html .=          $icon . $title;
            $html .= '    </button>';
            if ($actions_html !== '') {
                $html .= '    <div class="me-2 align-self-center py-1">' . $actions_html . '</div>';
            }
            $html .= '  </h2>';

            $html .= '  <div id="' . $collapse_id . '" class="accordion-collapse collapse' . $show_class . '" aria-labelledby="' . $heading_id . '" data-bs-parent="#' . html_escape($id) . '">';
            $html .= '      <div class="accordion-body ' . html_escape($body_class) . '">' . $content . '</div>';
            $html .= '  </div>';
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }
}

/**
 * Render dropdown button + menu untuk accordion actions
 */
if (!function_exists('render_accordion_dropdown_actions')) {
    function render_accordion_dropdown_actions($id, $index, $col)
    {
        $items  = $col['items'] ?? [];
        $menu_id = $id . '-dropdown-' . $index;
        $icon   = $col['icon'] ?? '<i class="cil-options"></i>';
        $class  = $col['class'] ?? 'btn btn-sm btn-outline-secondary';

        $html  = '<div class="dropdown">';
        $html .= '  <button class="' . html_escape($class) . ' dropdown-toggle" type="button" id="' . $menu_id . '" data-bs-toggle="dropdown" aria-expanded="false">';
        $html .=        $icon;
        $html .= '  </button>';
        $html .= '  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="' . $menu_id . '">';
        foreach ($items as $item) {
            $url   = base_url($item['url'] ?? '#');
            $label = $item['label'] ?? 'Action';
            $icon_html = !empty($item['icon']) ? '<i class="' . html_escape($item['icon']) . ' me-2"></i>' : '';
            $class = $item['class'] ?? '';
            $html .= '<li><a class="dropdown-item ' . html_escape($class) . '" href="' . html_escape($url) . '">' . $icon_html . html_escape($label) . '</a></li>';
        }
        $html .= '  </ul>';
        $html .= '</div>';

        return $html;
    }
}

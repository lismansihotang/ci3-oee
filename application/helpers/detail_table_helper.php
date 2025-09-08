<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('generate_table_view')) {
    /**
     * Generates a dynamic HTML table from an array of objects with custom formatting, alignment, and links.
     *
     * @param   array   $data           An array of objects.
     * @param   array   $headers_map    An associative array where keys are header titles
     * and values are object property names. Can also be a nested array to define format, alignment, and link.
     * Example:
     * [
     * 'Product Name' => ['property' => 'nm_product', 'type' => 'link', 'url' => 'products/detail/', 'link_property' => 'id']
     * ]
     * @param   array   $attributes     An associative array of HTML attributes for the table tag.
     * @return  string
     */
    function generate_table_view($data, $headers_map, $attributes = array())
    {
        if (empty($data) || ! is_array($data) || empty($headers_map)) {
            return '<p>No data to display.</p>';
        }

        // Generate table attributes
        $attr_string = '';
        foreach ($attributes as $key => $val) {
            $attr_string .= ' ' . html_escape($key) . '="' . html_escape($val) . '"';
        }

        $table = '<table' . $attr_string . '>';

        // Generate table header
        $table .= '<thead><tr>';
        foreach ($headers_map as $header_title => $property_data) {
            $th_align = is_array($property_data) && isset($property_data['align']) ? $property_data['align'] : 'left';
            $table .= '<th style="text-align:' . html_escape($th_align) . ';">' . html_escape($header_title) . '</th>';
        }
        $table .= '</tr></thead>';

        // Generate table body (rows)
        $table .= '<tbody>';
        foreach ($data as $row_object) {
            $table .= '<tr>';
            foreach ($headers_map as $header_title => $property_data) {
                // Determine property name, type, format, and alignment
                $property_name = is_array($property_data) ? $property_data['property'] : $property_data;
                $type = is_array($property_data) && isset($property_data['type']) ? $property_data['type'] : null;
                $format = is_array($property_data) && isset($property_data['format']) ? $property_data['format'] : null;
                $params = is_array($property_data) && isset($property_data['params']) ? $property_data['params'] : null;
                $td_align = is_array($property_data) && isset($property_data['align']) ? $property_data['align'] : 'left';

                // Safely get the value
                $cell_value = isset($row_object->$property_name) ? $row_object->$property_name : '';

                $content_html = '';

                // Apply formatting or create link
                if ($type === 'link') {
                    // Use a different property for the link value if specified, otherwise use the same property
                    $link_property_name = isset($property_data['link_property']) ? $property_data['link_property'] : $property_name;
                    $link_value = isset($row_object->$link_property_name) ? $row_object->$link_property_name : '';

                    $link_url = base_url() . $property_data['url'] . $link_value;
                    $link_text = isset($property_data['link_text']) ? $property_data['link_text'] : $cell_value;
                    $content_html = '<a href="' . html_escape($link_url) . '" class="link-info link-underline link-underline-opacity-0 link-underline-opacity-100-hover">' . html_escape($link_text) . '</a>';
                } else {
                    switch ($format) {
                        case 'currency':
                            $formatted_value = 'Rp ' . number_format($cell_value, 2, ',', '.');
                            break;
                        case 'date':
                            if (!empty($cell_value) && (new DateTime($cell_value)) !== false) {
                                $formatted_value = date($params ?: 'Y-m-d', strtotime($cell_value));
                            } else {
                                $formatted_value = $cell_value;
                            }
                            break;
                        default:
                            $formatted_value = $cell_value;
                            break;
                    }
                    $content_html = html_escape($formatted_value);
                }

                $table .= '<td style="text-align:' . html_escape($td_align) . ';">' . $content_html . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';

        $table .= '</table>';

        return $table;
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('table_form_detail_generic')) {
    /**
     * Helper to create a generic detail form table.
     *
     * @param string $table_id ID for the table element.
     * @param array $headers Array of column header labels.
     * @param array $columns Array of column/field names.
     * @param array $details Array of existing detail data (from the database).
     * @param array $column_types Associative array to define input types (e.g., ['qty' => 'number']).
     * @param array $select_options Associative array for dropdown options (e.g., ['kd_product' => [...]]).
     * @param array $column_attributes Associative array for additional attributes (e.g., ['qty' => ['class' => 'qty-input']]).
     * @param array $fetch_urls Associative array for data fetch URLs (e.g., ['kd_product' => '...']).
     * @return string The HTML code for the table.
     */
    function table_form_detail_generic($table_id, $headers, $columns, $details = [], $column_types = [], $select_options = [], $column_attributes = [], $fetch_urls = [])
    {
        $ci = &get_instance();
        $output = '';

        $fetch_urls_json = htmlspecialchars(json_encode($fetch_urls), ENT_QUOTES, 'UTF-8');

        $output .= '<div class="table-responsive">';
        $output .= '<table class="table table-bordered" id="' . html_escape($table_id) . '" data-fetch-urls="' . $fetch_urls_json . '">';
        $output .= '<thead>';
        $output .= '<tr>';

        // Loop over the provided headers
        foreach ($headers as $header) {
            $output .= '<th>' . html_escape($header) . '</th>';
        }

        // Add an extra header for the action button if there isn't one already
        $output .= '<th class="align-middle text-center"><button type="button" class="btn btn-success btn-sm add-row-btn" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Tambah Baris"><i class="icon cil-plus"></i></button></th>';
        $output .= '</tr>';
        $output .= '</thead>';
        $output .= '<tbody>';

        if (!empty($details)) {
            foreach ($details as $detail_row) {
                $output .= render_detail_row_generic($detail_row, $columns, $column_types, $select_options, $column_attributes);
            }
        } else {
            $output .= render_detail_row_generic([], $columns, $column_types, $select_options, $column_attributes);
        }

        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '</div>';

        return $output;
    }
}

if (!function_exists('render_detail_row_generic')) {
    /**
     * Helper to create a detail form table row.
     *
     * @param object|array $row_data Data for a single row from the database.
     * @param array $columns Names of the columns/fields.
     * @param array $column_types Input types for each column.
     * @param array $select_options Options for select fields.
     * @param array $column_attributes Additional attributes for input fields.
     * @return string The HTML code for the table row.
     */
    function render_detail_row_generic($row_data, $columns, $column_types, $select_options, $column_attributes)
    {
        $output = '<tr>';

        // Loop through all defined columns
        foreach ($columns as $column) {
            // Get the input type for the current column
            $input_type = isset($column_types[$column]) ? $column_types[$column] : 'text';

            // If the type is 'hidden', render the hidden input without a <td>
            if ($input_type === 'hidden') {
                $field_name = html_escape($column) . '[]';
                $value = isset($row_data->$column) ? $row_data->$column : '';
                $extra_attrs = isset($column_attributes[$column]) ? $column_attributes[$column] : [];
                $attributes_string = '';
                foreach ($extra_attrs as $key => $val) {
                    $attributes_string .= html_escape($key) . '="' . html_escape($val) . '" ';
                }
                $output .= '<input type="hidden" name="' . $field_name . '" value="' . html_escape($value) . '" ' . $attributes_string . '/>';
                continue; // Skip the <td> for hidden fields
            }

            // For all other types, render a <td> with the appropriate input
            $output .= '<td>';
            $field_name = html_escape($column) . '[]';

            $extra_attrs = isset($column_attributes[$column]) ? $column_attributes[$column] : [];
            $input_class = 'form-control ' . ($extra_attrs['class'] ?? '');

            // Check if the field is a select (dropdown)
            if (isset($select_options[$column])) {
                $selected_value = isset($row_data->$column) ? $row_data->$column : '';
                $output .= form_dropdown([
                    'name' => $field_name,
                    'class' => 'form-select ' . ($extra_attrs['class'] ?? ''),
                ], $select_options[$column], $selected_value);
            } else {
                $value = isset($row_data->$column) ? $row_data->$column : '';

                if ($input_type === 'date') {
                    $input_class .= ' flatpickr-input';
                }

                $output .= form_input([
                    'name' => $field_name,
                    'type' => $input_type,
                    'value' => html_escape($value),
                    'class' => $input_class,
                ]);
            }
            $output .= '</td>';
        }

        $output .= '<td class="align-middle text-center"><button type="button" class="btn btn-danger btn-sm remove-row-btn" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Hapus Baris"><i class="icon cil-minus"></i></button></td>';
        $output .= '</tr>';

        return $output;
    }
}

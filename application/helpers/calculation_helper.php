<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('calculate_total')) {
    /**
     * Calculates the total sum of a specified field from an array of objects.
     *
     * @param array $data The array of objects.
     * @param string $field_name The name of the field to be summed.
     * @return float The total sum of the field. Returns 0.00 if the data is empty or invalid.
     */
    function calculate_total($data, $field_name)
    {
        if (empty($data) || !is_array($data)) {
            return 0.00;
        }

        $total = 0.00;
        foreach ($data as $item) {
            if (is_object($item) && isset($item->$field_name)) {
                $total += (float)$item->$field_name;
            }
        }

        return $total;
    }
}

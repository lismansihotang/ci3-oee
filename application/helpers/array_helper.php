<?php

if (!function_exists('array_column_object')) {
    /**
     * Ambil nilai dari field tertentu pada array of object
     *
     * @param array $array   Array of stdClass object
     * @param string $column Nama field/kolom yang mau diambil
     * @param string|null $index_field Kolom yang dijadikan key (opsional)
     * @return array
     */
    function array_column_object(array $array, $column, $index_field = null)
    {
        $result = [];
        foreach ($array as $row) {
            if (!is_object($row)) {
                continue;
            }
            if ($index_field !== null && isset($row->{$index_field})) {
                $result[$row->{$index_field}] = $row->{$column} ?? null;
            } else {
                $result[] = $row->{$column} ?? null;
            }
        }
        return $result;
    }
}

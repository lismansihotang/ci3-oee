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

/**
 * Replace value pada satu atau beberapa field dalam data array.
 *
 * Fitur:
 * - Bisa untuk key tertentu ($val diisi) atau semua key ($val = null).
 * - Bisa single replace: field, oldValue → newValue.
 * - Bisa multiple replace: $replacements = [
 *       "field1" => [old1 => new1, old2 => new2],
 *       "field2" => [oldA => newA]
 *   ]
 * - Bisa filter by kd_reject (opsional).
 * - Data tidak diubah langsung, melainkan return array baru.
 *
 * @param array       $data         Data array (tidak by reference)
 * @param string|null $val          Key utama (contoh: "08:00"). Jika null → semua key
 * @param string|null $field        Field target (jika single replace)
 * @param mixed|null  $oldValue     Nilai lama (jika single replace)
 * @param mixed|null  $newValue     Nilai baru (jika single replace)
 * @param array|null  $replacements Multiple replace (format: [field => [old => new]])
 * @param string|null $kd_reject    Jika diisi, hanya ganti yang match kd_reject
 *
 * @return array Data array baru hasil replace
 */
if (!function_exists('replace_field')) {
    function replace_field(
        array $data,
        ?string $val,
        ?string $field = null,
        $oldValue = null,
        $newValue = null,
        array $replacements = null,
        string $kd_reject = null
    ): array {
        $targets = $val === null ? array_keys($data) : [$val];

        foreach ($targets as $key) {
            if (!isset($data[$key])) continue;

            foreach ($data[$key] as &$row) {
                // Filter by kd_reject (jika diset)
                if ($kd_reject !== null && (!isset($row['kd_reject']) || $row['kd_reject'] !== $kd_reject)) {
                    continue;
                }

                // Mode multiple replace
                if ($replacements !== null) {
                    foreach ($replacements as $f => $map) {
                        if (isset($row[$f]) && array_key_exists($row[$f], $map)) {
                            $row[$f] = $map[$row[$f]];
                        }
                    }
                }
                // Mode single replace
                elseif ($field !== null && $oldValue !== null && isset($row[$field]) && $row[$field] === $oldValue) {
                    $row[$field] = $newValue;
                }
            }
            unset($row);
        }

        return $data;
    }
}

if (!function_exists('group_array')) {
    /**
     * Mengelompokkan array/object berdasarkan key yang diberikan, dengan opsi filter.
     * * @param array $data Array data yang akan dikelompokkan (array of objects/arrays).
     * @param string $group_key Key yang digunakan untuk mengelompokkan (misal: 'shift').
     * @param string|null $filter_value Nilai spesifik untuk filter (misal: '1'), NULL untuk semua.
     * @return array|null Array hasil pengelompokan, atau NULL jika filter_value diisi tapi tidak ada data yang cocok.
     */
    function group_array(array $data, string $group_key, $filter_value = null)
    {
        $grouped_data = [];

        foreach ($data as $item) {
            // Konversi item (object atau array) menjadi array untuk akses key yang universal
            if (is_object($item)) {
                $item_array = (array) $item;
            } elseif (is_array($item)) {
                $item_array = $item;
            } else {
                continue;
            }

            // Cek apakah key pengelompokan ada di item
            if (!isset($item_array[$group_key])) {
                continue;
            }

            $key = $item_array[$group_key];

            // 1. Logika Filter: Jika filter_value diatur dan nilai item tidak cocok, lewati
            if ($filter_value !== null && $key != $filter_value) {
                continue;
            }

            // 2. Logika Pengelompokan: Item dimasukkan ke dalam hasil
            $grouped_data[$key][] = $item; // Pertahankan item asli
        }

        // --- Perubahan Kunci di sini ---
        // Jika filter_value diisi (bukan NULL) TAPI hasil pengelompokan kosong, kembalikan NULL.
        // Jika filter_value NULL, kita kembalikan array kosong jika data kosong.
        if ($filter_value !== null && empty($grouped_data)) {
            return NULL;
        }

        return $grouped_data;
    }
}

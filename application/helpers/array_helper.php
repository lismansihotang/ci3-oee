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

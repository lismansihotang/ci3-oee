<?php

if (!function_exists('mapRejects')) {
    /**
     * Map array rejects dari POST agar siap untuk batch insert.
     *
     * Struktur input:
     *   $rejects = [
     *     rowId => [
     *       [ 'jenis_reject' => '4', 'qty_reject' => '100' ],
     *       [ 'jenis_reject' => '5', 'qty_reject' => '200' ],
     *     ],
     *     ...
     *   ];
     *
     *   $detail_ids = [
     *     rowId => prod_detail_id,
     *     ...
     *   ];
     *
     * Output:
     *   [
     *     [ 'prod_detail_id' => 101, 'jenis_reject' => 4, 'qty_reject' => 100 ],
     *     [ 'prod_detail_id' => 101, 'jenis_reject' => 5, 'qty_reject' => 200 ],
     *     [ 'prod_detail_id' => 102, 'jenis_reject' => 3, 'qty_reject' => 50  ],
     *   ]
     *
     * @param array $rejects    Reject data dari POST
     * @param array $detail_ids Mapping rowId => prod_detail_id
     * @return array            Array siap insert_batch ke prod_reject
     */
    function mapRejects(array $rejects, array $detail_ids): array
    {
        $result = [];

        foreach ($rejects as $rowId => $rejectList) {
            // cek apakah rowId punya mapping ke prod_detail_id
            if (!isset($detail_ids[$rowId])) {
                continue; // skip kalau rowId tidak valid
            }

            $prod_detail_id = $detail_ids[$rowId];

            foreach ($rejectList as $reject) {
                // pastikan ada data lengkap
                if (empty($reject['jenis_reject']) || empty($reject['qty_reject'])) {
                    continue; // skip kalau tidak lengkap
                }

                $result[] = [
                    'prod_detail_id' => $prod_detail_id,
                    'kd_reject'   => (int)$reject['jenis_reject'],
                    'qty'     => (int)$reject['qty_reject'],
                ];
            }
        }

        return $result;
    }
}

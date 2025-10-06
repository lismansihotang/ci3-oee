<?php
if (!function_exists('mapRejects')) {
    function mapRejects(array $rejects, array $detail_ids): array
    {
        $result = [];

        foreach ($rejects as $rowId => $rows) {
            // cek mapping ada atau tidak
            if (!array_key_exists($rowId, $detail_ids)) {
                continue;
            }

            $prod_detail_id = $detail_ids[$rowId];

            foreach ($rows as $r) {
                $jenis = $r['jenis_reject'] ?? null;
                $qty   = $r['qty_reject'] ?? null;

                if ($jenis && $qty && (int)$qty > 0) {
                    $result[] = [
                        'prod_detail_id' => $prod_detail_id,
                        'kd_reject'      => (int)$jenis,
                        'qty'            => (int)$qty,
                    ];
                }
            }
        }

        return $result;
    }
}

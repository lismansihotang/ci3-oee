<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('indo_date')) {
    /**
     * Mengubah format waktu menjadi tanggal Indonesia.
     *
     * @param string $datetime Waktu dalam format YYYY-MM-DD HH:MM:SS.
     * @return string Tanggal dalam format DD Bulan YYYY.
     */
    function indo_date($datetime)
    {
        if (empty($datetime)) {
            return '';
        }

        $nama_bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        // Pisahkan tanggal dari string datetime
        $date = substr($datetime, 0, 10);
        $tanggal = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 0, 4);

        return $tanggal . ' ' . $nama_bulan[$bulan] . ' ' . $tahun;
    }
}

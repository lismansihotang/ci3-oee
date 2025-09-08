<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('indo_date')) {
    /**
     * Mengubah format waktu menjadi tanggal Indonesia.
     *
     * @param string $datetime Waktu dalam format YYYY-MM-DD HH:MM:SS.
     * @param bool $show_time Menampilkan waktu jika true.
     * @return string Tanggal atau tanggal dan waktu dalam format Indonesia.
     */
    function indo_date($datetime, $show_time = false)
    {
        if (empty($datetime) || $datetime === '0000-00-00 00:00:00' || $datetime === '0000-00-00') {
            return '';
        }

        // Handle timestamps with microseconds by removing them
        $datetime_cleaned = explode('.', $datetime)[0];

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

        $timestamp = strtotime($datetime_cleaned);

        $tanggal = date('d', $timestamp);
        $bulan = date('m', $timestamp);
        $tahun = date('Y', $timestamp);

        $formatted_date = $tanggal . ' ' . $nama_bulan[$bulan] . ' ' . $tahun;

        if ($show_time) {
            $jam = date('H:i', $timestamp);
            return $formatted_date . ' - ' . $jam . ' WIB';
        }

        return $formatted_date;
    }
}

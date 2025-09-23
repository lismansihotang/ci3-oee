<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('get_shift_hours')) {

    function get_shift_hours($shift)
    {
        $hours = [];

        if ($shift == 1) {
            // Shift 1: 08:00 - 16:00
            $start = strtotime('08:00');
            $end   = strtotime('16:00');
        } elseif ($shift == 2) {
            // Shift 2: 16:00 - 00:00
            $start = strtotime('16:00');
            $end   = strtotime('23:59');
        } else {
            // Shift 3: 00:00 - 08:00
            $start = strtotime('00:00');
            $end   = strtotime('08:00');
        }

        $i = 0;
        while ($start < $end) {
            $jam_mulai   = date('H:i', $start);
            $jam_selesai = date('H:i', strtotime('+1 hour', $start));
            $hours[$i]['jam_mulai']   = $jam_mulai;
            $hours[$i]['jam_selesai'] = $jam_selesai;

            $start = strtotime('+1 hour', $start);
            $i++;
        }

        return $hours;
    }
}

if (! function_exists('get_shift_hours_rev')) {
    function get_shift_hours_rev($shift, $asObject = true)
    {
        $results = [];

        if ($shift == 1) {
            // Shift 1: 08:00 - 16:00
            $start = strtotime('08:00');
            $end   = strtotime('16:00');
        } elseif ($shift == 2) {
            // Shift 2: 16:00 - 00:00
            $start = strtotime('16:00');
            $end   = strtotime('23:59');
        } else {
            // Shift 3: 00:00 - 08:00
            $start = strtotime('00:00');
            $end   = strtotime('08:00');
        }

        while ($start < $end) {
            $hour = date('H:i', $start);
            $results[] = $asObject ? (object)['jam' => $hour] : $hour;
            $start = strtotime('+1 hour', $start);
        }

        return $results;
    }
}

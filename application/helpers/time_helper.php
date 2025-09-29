
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Hitung selisih antara 2 waktu (format HH:MM atau HH:MM:SS).
 * Jika $time2 lebih kecil dari $time1 → dianggap hari berikutnya.
 *
 * @param string $time1 Waktu awal
 * @param string $time2 Waktu akhir
 * @param string $mode 'short' atau 'long' (default: 'short')
 * @return array
 */
if (!function_exists('time_diff')) {
    function time_diff($time1, $time2, $mode = 'short')
    {
        $t1 = new DateTime($time1);
        $t2 = new DateTime($time2);

        if ($t2 < $t1) {
            $t2->modify('+1 day');
        }

        $diff = $t1->diff($t2);

        $hours   = (int) $diff->h + ($diff->days * 24);
        $minutes = (int) $diff->i;
        $seconds = (int) $diff->s;

        $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;
        $totalMinutes = floor($totalSeconds / 60);

        return [
            'hours'          => $hours,
            'minutes'        => $minutes,
            'seconds'        => $seconds,
            'formatted'      => sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds),
            'formatted_24h'  => seconds_to_hms($totalSeconds),
            'formatted_flex' => format_duration($totalSeconds, $mode),
            'total_minutes'  => $totalMinutes,
            'total_seconds'  => $totalSeconds
        ];
    }
}

/**
 * Konversi detik ke format HH:MM:SS (reset tiap 24 jam).
 *
 * @param int $seconds
 * @return string
 */
if (!function_exists('seconds_to_hms')) {
    function seconds_to_hms($seconds)
    {
        $seconds = $seconds % 86400;
        $hours   = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs    = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
    }
}

/**
 * Format durasi ke bentuk short ("2d 3h 20m 10s") atau long ("2 hari 3 jam 20 menit 10 detik").
 *
 * @param int $seconds Jumlah detik
 * @param string $mode 'short' atau 'long'
 * @return string
 */
if (!function_exists('format_duration')) {
    function format_duration($seconds, $mode = 'short')
    {
        $days    = floor($seconds / 86400);
        $hours   = floor(($seconds % 86400) / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs    = $seconds % 60;

        $parts = [];

        if ($mode === 'long') {
            if ($days > 0)    $parts[] = $days . ' hari';
            if ($hours > 0)   $parts[] = $hours . ' jam';
            if ($minutes > 0) $parts[] = $minutes . ' menit';
            if ($secs > 0)    $parts[] = $secs . ' detik';
            return $parts ? implode(' ', $parts) : '0 detik';
        } else { // short (default)
            if ($days > 0)    $parts[] = $days . 'd';
            if ($hours > 0)   $parts[] = $hours . 'h';
            if ($minutes > 0) $parts[] = $minutes . 'm';
            if ($secs > 0)    $parts[] = $secs . 's';
            return $parts ? implode(' ', $parts) : '0s';
        }
    }
}

/**
 * Konversi menit ke format short/long.
 *
 * @param int $minutes
 * @param string $mode 'short' atau 'long'
 * @return string
 */
if (!function_exists('minutes_to_duration')) {
    function minutes_to_duration($minutes, $mode = 'short')
    {
        $seconds = $minutes * 60;
        return format_duration($seconds, $mode);
    }
}

/**
 * Konversi jam ke format short/long.
 *
 * @param int $hours
 * @param string $mode 'short' atau 'long'
 * @return string
 */
if (!function_exists('hours_to_duration')) {
    function hours_to_duration($hours, $mode = 'short')
    {
        $seconds = $hours * 3600;
        return format_duration($seconds, $mode);
    }
}

/**
 * Konversi hari ke format short/long.
 *
 * @param int $days
 * @param string $mode 'short' atau 'long'
 * @return string
 */
if (!function_exists('days_to_duration')) {
    function days_to_duration($days, $mode = 'short')
    {
        $seconds = $days * 86400;
        return format_duration($seconds, $mode);
    }
}

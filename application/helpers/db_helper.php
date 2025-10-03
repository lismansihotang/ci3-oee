<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('db_string_agg')) {
    /**
     * Universal string aggregation (MySQL / PostgreSQL).
     */
    function db_string_agg($db, $field, $separator = ', ')
    {
        if ($db->dbdriver === 'postgre') {
            return "STRING_AGG(DISTINCT {$field}, '{$separator}')";
        }
        return "GROUP_CONCAT(DISTINCT {$field} SEPARATOR '{$separator}')";
    }
}

if (!function_exists('db_year_filter')) {
    /**
     * Universal YEAR filter (MySQL / PostgreSQL).
     */
    function db_year_filter($db, $field, $year)
    {
        if ($db->dbdriver === 'postgre') {
            return "EXTRACT(YEAR FROM {$field}) = {$year}";
        }
        return "YEAR({$field}) = {$year}";
    }
}

// Fungsi 1: Mengambil nilai tunggal (field)
if (!function_exists('get_single_value')) {
    /**
     * Mengambil satu nilai (field) dari satu baris data berdasarkan kriteria WHERE.
     * ... (DocBlock dan logika get_single_value yang sudah ada)
     */
    function get_single_value($model_name, $where, $field)
    {
        // Akses CodeIgniter Super Object
        $CI = &get_instance();

        // Pastikan model sudah di-load dan memiliki method get_data
        if (!isset($CI->$model_name) || !method_exists($CI->$model_name, 'get_data')) {
            log_message('error', "Model '{$model_name}' tidak ditemukan atau tidak memiliki method get_data.");
            return NULL;
        }

        // Akses instance model secara dinamis
        $model_instance = $CI->$model_name;

        // Panggil method get_data dari instance model
        $row = $model_instance->get_data($where, [], '', true);

        // Cek apakah baris data ditemukan dan apakah field tersebut ada
        if ($row && property_exists($row, $field)) {
            return $row->$field;
        }

        return NULL;
    }
}

// --------------------------------------------------------------------------

// Fungsi 2: Mengambil seluruh baris data tunggal (row/objek)
if (!function_exists('get_single_row')) {
    /**
     * Mengambil satu baris data tunggal (objek CI) berdasarkan kriteria WHERE.
     * Mengakses instance model melalui super object CI.
     * * @param string $model_name Nama model yang akan digunakan (misalnya 'Prod_utama_model').
     * @param array $where Array asosiatif untuk klausa WHERE (misalnya ['id' => 10]).
     * @return object|NULL Objek baris data atau NULL jika tidak ditemukan.
     */
    function get_single_row($model_name, $where)
    {
        // Akses CodeIgniter Super Object
        $CI = &get_instance();

        // Pastikan model sudah di-load dan memiliki method get_data
        if (!isset($CI->$model_name) || !method_exists($CI->$model_name, 'get_data')) {
            log_message('error', "Model '{$model_name}' tidak ditemukan atau tidak memiliki method get_data.");
            return NULL;
        }

        // Akses instance model secara dinamis
        $model_instance = $CI->$model_name;

        // Panggil method get_data dari instance model
        // Parameter: $where, $where_in=[], $field_where_in='', $single=true
        $row = $model_instance->get_data($where, [], '', true);

        // Mengembalikan objek baris data (atau NULL jika tidak ditemukan)
        return $row;
    }
}

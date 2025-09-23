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

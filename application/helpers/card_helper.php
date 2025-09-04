<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('card_open')) {
    /**
     * Open card
     */
    function card_open($title = '', $options = [])
    {
        $extraClass = isset($options['class']) ? $options['class'] : '';
        return "
        <div class=\"card mb-3 $extraClass\">
            <div class=\"card-header d-flex justify-content-between align-items-center\">
                <h5 class=\"mb-0\">$title</h5>
                " . (isset($options['actions']) ? $options['actions'] : '') . "
            </div>
            <div class=\"card-body\">
        ";
    }
}

if (!function_exists('card_close')) {
    /**
     * Close card
     */
    function card_close()
    {
        return "
            </div>
        </div>";
    }
}

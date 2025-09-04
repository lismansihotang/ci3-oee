<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Migrate controller for running database migrations
 *
 * @property CI_Migration $migration
 */
class Migrate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load migration library
        $this->load->library('migration');
    }

    /**
     * Run latest migration
     * Usage:
     *   php index.php migrate
     */
    public function index()
    {
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrated to latest version.\n";
        }
    }

    /**
     * Run to specific version
     * Usage:
     *   php index.php migrate version 20250828143000
     */
    public function version($version)
    {
        if ($this->migration->version($version) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrated to version: {$version}\n";
        }
    }

    /**
     * Rollback to 0 (drop everything defined in down())
     * Usage:
     *   php index.php migrate reset
     */
    public function reset()
    {
        if ($this->migration->version(0) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "All migrations rolled back (version 0).\n";
        }
    }
}

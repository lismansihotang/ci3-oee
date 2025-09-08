<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seeder_tools extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pastikan controller hanya bisa diakses dari CLI
        if (!$this->input->is_cli_request()) {
            show_404();
        }

        $this->load->helper('seeder');
    }

    public function index()
    {
        $this->_show_usage();
    }

    /**
     * Membuat file seeder dari data tabel.
     * Usage: php index.php seeder_tools create <nama_tabel> <sort_field> <sort_order>
     */
    public function create()
    {
        $table_name = $this->uri->segment(3);
        $sort_field = $this->uri->segment(4);
        $sort_order = $this->uri->segment(5);

        if (!$table_name) {
            echo "Nama tabel seeder harus diberikan.\n";
            $this->_show_usage();
            return;
        }

        // Panggil helper untuk men-generate file seeder
        $message = generate_seeder_migration($table_name, null, ['id'], $sort_field, $sort_order);

        echo $message . "\n";
    }

    /**
     * Menampilkan panduan penggunaan CLI.
     */
    private function _show_usage()
    {
        echo "Usage: php index.php seeder_tools create <seeder_name> [sort_field] [sort_order]\n";
        echo "  <seeder_name>   Nama tabel database yang akan dibuat seeder.\n";
        echo "  [sort_field]    (Opsional) Field untuk mengurutkan data (default: tidak diurutkan).\n";
        echo "  [sort_order]    (Opsional) Urutan sort (asc atau desc).\n";
        echo "\n";
        echo "Contoh:\n";
        echo "  php index.php seeder_tools create users\n";
        echo "  php index.php seeder_tools create products created_at desc\n";
        echo "\n";
    }
}

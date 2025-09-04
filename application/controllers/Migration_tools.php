<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_tools extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Allow only CLI access
        if (!is_cli()) {
            show_error('This command can only be run from the command line.');
        }

        // Load helper for file writing
        $this->load->helper('file');
    }

    /**
     * Generate a new migration file with timestamp prefix
     * Usage:
     *   php index.php migration_tools create create_users_table (generate by cli)
     *   create your own migration
     *   php index.php migrate (run by cli)
     */
    public function create($name = '')
    {
        if (empty($name)) {
            echo "Usage: php index.php migration_tools create <migration_name>\n";
            exit;
        }

        // Generate timestamp
        $timestamp = date('YmdHis');
        $filename  = $timestamp . '_' . strtolower($name) . '.php';
        $filepath  = APPPATH . 'migrations/' . $filename;

        // Convert name into proper class name (Migration_Create_users_table)
        $className = 'Migration_' . ucfirst($this->_camelize($name));

        // Migration template
        $template = "<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class {$className} extends CI_Migration {

    public function up()
    {
        // TODO: define schema changes here
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}
";

        // Ensure migrations folder exists
        if (!is_dir(APPPATH . 'migrations')) {
            mkdir(APPPATH . 'migrations', 0755, TRUE);
        }

        // Write file
        if (write_file($filepath, $template)) {
            echo "Migration file created: {$filename}\n";
        } else {
            echo "Failed to create migration file. Check permissions.\n";
        }
    }

    /**
     * Convert snake_case or dashed-name into CamelCase with underscores
     * Example: create_users_table -> Create_users_table
     */
    private function _camelize($input)
    {
        $input = str_replace(['-', '_'], ' ', strtolower($input));
        $input = ucwords($input);
        return str_replace(' ', '_', $input);
    }
}

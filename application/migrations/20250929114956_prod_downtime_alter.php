<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Downtime_Alter extends CI_Migration
{

    public function up()
    {
        // TODO: define schema changes here
        $fieldDetails = [
            'prod_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'kd_ms' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'action' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'shift' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ];

        $this->dbforge->add_column('prod_downtime', $fieldDetails);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

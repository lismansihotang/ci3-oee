<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Qc_Alter extends CI_Migration
{

    public function up()
    {
        // TODO: define schema changes here
        $fieldDetails = [
            'kd_ms' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'kd_qc' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'shift' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ];

        $this->dbforge->add_column('prod_qc', $fieldDetails);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

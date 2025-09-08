<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_2_Products_Table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'qc_tinggidalam' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ];

        $this->dbforge->modify_column('products', $fields);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

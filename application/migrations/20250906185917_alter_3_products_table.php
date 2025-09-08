<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_3_Products_Table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'ct_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ct_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
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

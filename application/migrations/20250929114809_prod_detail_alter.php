<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Detail_Alter extends CI_Migration
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
        ];

        $this->dbforge->add_column('prod_detail', $fieldDetails);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

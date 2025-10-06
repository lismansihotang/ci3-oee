<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Utama_Phase_Alter extends CI_Migration
{

    public function up()
    {
        // TODO: define schema changes here
        $fieldDetails = [
            'phase' => [
                'type' => 'INT',
                'default' => 0,
                'null' => true,
            ],
        ];

        $this->dbforge->add_column('prod_utama', $fieldDetails);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

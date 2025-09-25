<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Alter_Tables extends CI_Migration
{

    public function up()
    {
        // Drop any fields
        //$this->dbforge->drop_column('prod_detail', 'jam_mulai');
        //$this->dbforge->drop_column('prod_detail', 'jam_selesai');
        //$this->dbforge->drop_column('prod_detail', 'finish_qty');

        // added new fields
        $fieldDetails = [
            'jam' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'hold_qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
        ];
        $this->dbforge->add_column('prod_detail', $fieldDetails);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

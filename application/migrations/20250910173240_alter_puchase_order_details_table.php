<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_Puchase_Order_Details_Table extends CI_Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 1,
                'null' => true,
            ],
        ];

        $this->dbforge->modify_column('purchase_order_details', $fields);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

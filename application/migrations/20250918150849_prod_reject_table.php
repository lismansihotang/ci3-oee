<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Reject_Table extends CI_Migration
{

    public function up()
    {
        /**
         * Table: prod_reject
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => FALSE,
            ],
            'prod_detail_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'kd_reject' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            // default field
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('prod_reject');
    }

    public function down()
    {
        $this->dbforge->drop_table('prod_reject');
    }
}

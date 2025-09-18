<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Downtime_Table extends CI_Migration
{

    public function up()
    {
        /**
         * Table: prod_downtime
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => FALSE,
            ],
            'shift_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'downtime_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => FALSE,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => FALSE,
            ],
            'duration_min' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'notes' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
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
        $this->dbforge->create_table('prod_downtime');
    }

    public function down()
    {
        $this->dbforge->drop_table('prod_downtime');
    }
}

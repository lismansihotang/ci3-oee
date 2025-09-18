<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Shift_Log_Table extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => FALSE,
            ],
            'kd_ms' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => FALSE,
            ],
            'shift_no' => [
                'type' => 'TINYINT',
                'constraint' => 3,
                'null' => FALSE,
            ],
            'leader_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'default' => 'OPEN',
                'null' => TRUE,
            ],
            'total_pass' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => TRUE,
            ],
            'total_reject' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => TRUE,
            ],
            'total_hold' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => TRUE,
            ],
            'finish_qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->dbforge->create_table('prod_shift_log');
    }

    public function down()
    {
        $this->dbforge->drop_table('prod_shift_log');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Jenis_Reject_Table extends CI_Migration
{

    public function up()
    {
        /**
         * Table: jenis_reject
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'unsigned' => FALSE,
            ],
            'jenis_machines' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => FALSE,
            ],
            'kd_reject' => [
                'type' => 'VARCHAR',
                'constraint' => 6,
                'null' => FALSE,
            ],
            'nama_reject' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
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
        $this->dbforge->create_table('jenis_reject');
    }

    public function down()
    {
        $this->dbforge->drop_table('jenis_reject');
    }
}

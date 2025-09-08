<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Jenis_Downtimes_Tables extends CI_Migration
{

    public function up()
    {
        // Create table 'jenis_downtimes'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => '35',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('jenis_downtimes');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('jenis_downtimes');
    }
}

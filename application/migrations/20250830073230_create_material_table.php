<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_Material_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'materials'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'lokasi_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan' => [
                'type' => 'text',
            ],
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('materials');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('materials');
    }
}

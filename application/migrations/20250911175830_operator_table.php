<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Operator_Table extends CI_Migration
{
    public function up()
    {
        // Create table 'operators'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 16,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 35,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'no_induk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'divisi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'akses' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'grup' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'urutan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tgl_keluar' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'alasan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'alamat_asal' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'alamat_sekarang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'alumnus' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tgl_masuk' => [
                'type' => 'DATE',
                'null' => true,
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
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('operators');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('operators');
    }
}

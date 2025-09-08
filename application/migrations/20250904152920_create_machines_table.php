<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_Machines_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'machines'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'kode_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'urutan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'manufacturer' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'kapasitas_kontainer' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'screw_speed' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'hp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'max_mold' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'min_mold' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'max_diameter_single_head' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'tinggi_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'lebar_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'panjang_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'berat_mesin' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'rate' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'operator' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'listrik' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'depresiasi' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'foh_lain' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'indirect_labour' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'direct_labour' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'general_adm' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'marketing' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
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
        $this->dbforge->create_table('machines');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('machines');
    }
}

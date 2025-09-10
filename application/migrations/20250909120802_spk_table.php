<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Spk_Table extends CI_Migration
{
    public function up()
    {
        // Create table 'spk'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'no_spk' => [
                'type' => 'VARCHAR',
                'constraint' => '35',
            ],
            'kd_machine' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'kd_product' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'cavity' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'ct' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'tgl_mulai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_selesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'no_mould' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'no_po' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'jml_ord' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'tjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'tshift' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'tday' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'ct_print' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ct_stamp' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'print_jam' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'print_shift' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'print_day' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'stamp_jam' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'stamp_shift' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'stamp_day' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'sub' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'no' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'jumlah_jam' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'tgl_mulai2' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_selesai2' => [
                'type' => 'DATE',
                'null' => true,
            ],
            // default
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'deleted_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('spk');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('spk');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Utama_Table extends CI_Migration
{

    public function up()
    {
        /**
         * Table: prod_utama
         */
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ],
            'operator_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'jml_pass' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'jml_hold' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'persen' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'kd_prod' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'kd_ms' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'no_spk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'per_r' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'rework' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'sh' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => TRUE,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => TRUE,
            ],
            'per_rb' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'per_bw' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'per_rs' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'per_rc' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'per_ra' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => TRUE,
            ],
            'per_rl' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->dbforge->create_table('prod_utama', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('prod_utama', TRUE);
    }
}

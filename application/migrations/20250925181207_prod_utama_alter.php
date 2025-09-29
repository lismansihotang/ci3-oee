<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Prod_Utama_Alter extends CI_Migration
{

    public function up()
    {
        $this->dbforge->drop_table('prod_utama', TRUE);

        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => FALSE,
            ],
            'kd_prod' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'kd_ms' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE,
            ],
            'no_spk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'jml_pass' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => TRUE,
            ],
            'jml_hold' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'operators_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'persen_pass' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => '0.00',
                'null' => TRUE,
            ],
            'persen_reject' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => '0.00',
                'null' => true,
            ],
            'persen_down' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => '0.00',
                'null' => true,
            ],
            'sh' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => TRUE,
            ],
            'jam' => [
                'type' => 'TIME',
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
        $this->dbforge->create_table('prod_utama');
    }

    public function down()
    {
        $this->dbforge->drop_table('prod_utama', TRUE);
    }
}

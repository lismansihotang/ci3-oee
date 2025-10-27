<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Qc_Tables extends CI_Migration
{

    public function up()
    {

        // ===============================
        // Table: jenis_qc
        // ===============================
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ],
            'kd_qc' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'kd_ms' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE,
            ],
            'nama_qc' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'standar' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
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
        $this->dbforge->create_table('jenis_qc', TRUE);

        // ===============================
        // Table: prod_qc
        // ===============================
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ],
            'prod_id' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'kd_jenis_qc' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => FALSE,
            ],
            'nilai' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->dbforge->create_table('prod_qc', TRUE);

        // ===============================
        // Table: inspector_qc
        // ===============================
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
            'machines_id' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'shift' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'phase' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'problem' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'problem_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'report_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'handle_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'operator_id' => [
                'type' => 'INT',
                'null' => FALSE,
            ],
            'solution_descrtiption' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_problem' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'status_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
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
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('inspector_qc', TRUE);
    }

    public function down()
    {
        // TODO: rollback changes here
        $this->dbforge->drop_table('jenis_qc', TRUE);
        $this->dbforge->drop_table('prod_qc', TRUE);
        $this->dbforge->drop_table('inspector_qc', TRUE);
    }
}

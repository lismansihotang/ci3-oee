<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Customers_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'customers'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'kd_cust' => [
                'type' => 'VARCHAR',
                'constraint' => '35',
            ],
            'nm_cust' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alamat2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kota' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'telepon' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
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
        $this->dbforge->create_table('customers');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('customers');
    }
}

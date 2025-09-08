<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Purchase_Orders_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'purchase_orders'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'no_po' => [
                'type' => 'VARCHAR',
                'constraint' => '35',
            ],
            'tgl_po' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_kirim' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'kd_cust' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nm_cust' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ket' => [
                'type' => 'TEXT',
                'null' => true,
            ],
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
        $this->dbforge->create_table('purchase_orders');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('purchase_orders');
    }
}

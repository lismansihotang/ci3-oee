<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Purchase_Order_Details_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'purchase_order_details'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_po' => [
                'type' => 'INT',
                'constraint' => '35',
                'null' => true
            ],
            'no' => [
                'type' => 'INT',
                'constraint' => '35',
                'default' => 0,
                'null' => true
            ],
            'kd_product' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nm_product' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'kiriman_akhir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'qty_kirim' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'sisa_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0,
                'null' => true,
            ],
            'jml_kirim' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'jml_retur' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->dbforge->create_table('purchase_order_details');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('purchase_order_details');
    }
}

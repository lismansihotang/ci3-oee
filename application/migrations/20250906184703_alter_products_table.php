<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_Products_Table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'qc_ct' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_std_brt' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_in' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_out' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_ulir' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_tebal' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_neckhigh' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_tinggicelah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_tinggiproduk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_lebarluar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_volume' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_lbpin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_pin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_locking' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_lbbawah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_lbtengah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_lebarprod' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_neckweigh' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_botweigh' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_walltick' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ];

        $this->dbforge->modify_column('products', $fields);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

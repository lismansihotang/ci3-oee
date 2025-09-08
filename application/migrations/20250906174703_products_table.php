<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Products_Table extends CI_Migration
{

    public function up()
    {
        // Create table 'products'
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'kd_produk' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'kd_cust' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'berat_std' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'jml_per_box' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'cavity' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'brt_run' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'ct' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'material' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'no_mould' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'qc_ct' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_std_brt' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_in' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_out' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_ulir' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_tebal' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_neckhigh' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_tinggicelah' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_tinggiproduk' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_lebarluar' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_volume' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_ket' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'ct_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'ct_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'brt_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'brt_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'in_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'in_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'out_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'out_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'ulir_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'ulir_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tebal_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tebal_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'neck_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'neck_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggicelah_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggicelah_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggiprod_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggiprod_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lebarluar_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lebarluar_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'volume_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'volume_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_lbpin' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_pin' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_locking' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_tinggidalam' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbpin_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbpin_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'pin_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'pin_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'locking_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'locking_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggidalam_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'tinggidalam_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_lbbawah' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_lbtengah' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbbwh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbbwh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbtgh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbtgh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_lebarprod' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lebarprod_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lebarprod_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'p_lbr_atas' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'p_lbr_bwh' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'p_lbr_stamp' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbratas_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbratas_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbrbwh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbrbwh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbrstamp_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'lbrstamp_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'fin_assembling' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'secondpros' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'jenis_produksi' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'qc_neckweigh' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'qc_botweigh' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'neckw_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'neckw_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'botw_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'botw_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'material2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'addictive' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'polybag' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'nama_box' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'nama_poly' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'komposisi_murni' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'komposisi_pigmen' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'komposisi_aditif' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qc_walltick' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'walltick_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'walltick_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'cost' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
            ],
            'ct_print' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'ct_stamp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            // Default Field
            'is_deleted' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->dbforge->create_table('products');
    }

    public function down()
    {
        // Drop table
        $this->dbforge->drop_table('products');
    }
}

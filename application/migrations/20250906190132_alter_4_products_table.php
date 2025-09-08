<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_4_Products_Table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'berat_std' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'jml_per_box' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'cavity' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => true,
            ],
            'brt_run' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ct' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ct_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ct_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'brt_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'brt_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'in_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'in_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'out_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'out_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ulir_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'ulir_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tebal_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tebal_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'neck_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'neck_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggicelah_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggicelah_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggiprod_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggiprod_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lebarluar_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lebarluar_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'volume_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'volume_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbpin_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbpin_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'pin_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'pin_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'locking_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'locking_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggidalam_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'tinggidalam_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbbwh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbbwh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbtgh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbtgh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lebarprod_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lebarprod_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'p_lbr_atas' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'p_lbr_bwh' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'p_lbr_stamp' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbratas_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbratas_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbrbwh_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbrbwh_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbrstamp_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'lbrstamp_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'neckw_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'neckw_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'botw_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'botw_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'walltick_down' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'walltick_up' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
                'null' => true,
            ],
            'cost' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0,
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

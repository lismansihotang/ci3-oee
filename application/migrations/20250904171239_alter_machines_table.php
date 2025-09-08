<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_Machines_Table extends CI_Migration
{

    public function up()
    {
        $fields = [
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'operator' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'listrik' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'depresiasi' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'foh_lain' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'indirect_labour' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'direct_labour' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'general_adm' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
            'marketing' => [
                'type' => 'DECIMAL',
                'constraint' => '16,2',
                'default' => 0
            ],
        ];

        $this->dbforge->modify_column('machines', $fields);
    }

    public function down()
    {
        // TODO: rollback changes here
    }
}

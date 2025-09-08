<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Seed_Jenis_downtimes_table extends CI_Migration
{
    public function up()
    {
        $data = [
	
  0 => 
  array (
    'kode' => 'JDT-001',
    'nama' => 'SET-UP',
    'is_deleted' => '0',
    'created_by' => '0',
    'updated_by' => '0',
    'deleted_by' => '0',
    'created_at' => '2025-09-06 17:07:15.784657',
    'updated_at' => '2025-09-06 17:07:15.784657',
    'deleted_at' => '2025-09-06 17:07:15.784657',
  ),
  1 => 
  array (
    'kode' => 'JDT-002',
    'nama' => 'Mesin',
    'is_deleted' => '0',
    'created_by' => '0',
    'updated_by' => '0',
    'deleted_by' => '0',
    'created_at' => '2025-09-06 17:07:29.739743',
    'updated_at' => '2025-09-06 17:07:29.739743',
    'deleted_at' => '2025-09-06 17:07:29.739743',
  ),
  2 => 
  array (
    'kode' => 'JDT-003',
    'nama' => 'No Order',
    'is_deleted' => '0',
    'created_by' => '0',
    'updated_by' => '0',
    'deleted_by' => '0',
    'created_at' => '2025-09-06 17:07:47.843741',
    'updated_at' => '2025-09-06 17:07:47.843741',
    'deleted_at' => '2025-09-06 17:07:47.843741',
  ),
  3 => 
  array (
    'kode' => 'kode x(edit)',
    'nama' => 'nama x(edit)',
    'is_deleted' => '1',
    'created_by' => '1',
    'updated_by' => '1',
    'deleted_by' => '1',
    'created_at' => '2025-09-06 22:01:49.302025',
    'updated_at' => '2025-09-07 12:02:06',
    'deleted_at' => '2025-09-07 12:02:09',
  ),
  4 => 
  array (
    'kode' => 'xZ',
    'nama' => 'xZ',
    'is_deleted' => '1',
    'created_by' => '1',
    'updated_by' => '1',
    'deleted_by' => '1',
    'created_at' => '2025-09-07 00:55:16.425103',
    'updated_at' => '2025-09-07 14:55:23',
    'deleted_at' => '2025-09-07 14:55:27',
  ),
];

        $this->db->insert_batch('jenis_downtimes', $data);
    }

    public function down()
    {
        // Hapus semua data yang dimasukkan di atas
        $this->db->truncate('jenis_downtimes');
    }
}
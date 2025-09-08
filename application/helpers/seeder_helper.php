<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_seeder_migration')) {
    /**
     * Mengambil data dari tabel dan membuat file migration seeder.
     *
     * @param string $table_name Nama tabel yang akan di-seed.
     * @param string $file_name Nama file migration (opsional).
     * @param array $exclude_fields Daftar field yang akan dikecualikan (opsional).
     * @param string|null $sort_field Field yang akan digunakan untuk sort.
     * @param string $sort_order Urutan sort (asc atau desc).
     * @return string Pesan hasil proses.
     */
    function generate_seeder_migration($table_name, $file_name = null, $exclude_fields = ['id'], $sort_field = null, $sort_order = 'asc')
    {
        // Pastikan nama tabel diberikan
        if (empty($table_name)) {
            return "Nama tabel tidak boleh kosong.";
        }

        // Ambil instance CodeIgniter
        $CI = &get_instance();
        $CI->load->database();

        // Terapkan sort jika field sort tidak kosong
        if ($sort_field !== null) {
            $CI->db->order_by($sort_field, $sort_order);
        }

        // Ambil semua data dari tabel
        $query = $CI->db->get($table_name);

        // Jika tidak ada data, batalkan proses
        if ($query->num_rows() === 0) {
            return "Tidak ada data di tabel '{$table_name}'. Proses seeder dibatalkan.";
        }

        $data_array = $query->result_array();

        // Hapus field yang dikecualikan dari setiap baris data
        if (!empty($exclude_fields)) {
            $filtered_data_array = [];
            foreach ($data_array as $row) {
                foreach ($exclude_fields as $field) {
                    unset($row[$field]);
                }
                $filtered_data_array[] = $row;
            }
            $data_array = $filtered_data_array;
        }

        // Format data menjadi string PHP array
        $data_string = var_export($data_array, true);
        $data_string = preg_replace("/^array\s*\((.*)\)$/s", "[\n\t$1]", $data_string);

        // Buat nama file jika tidak diberikan
        if ($file_name === null) {
            $file_name = 'Seed_' . ucfirst($table_name) . '_table';
        }
        $filename = date('YmdHis') . '_' . strtolower($file_name)  . '.php';

        // Tentukan path lengkap untuk file
        $migration_path = APPPATH . 'migrations/' . $filename;

        // Buat template kode migration
        $migration_template = <<<EOT
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_{$file_name} extends CI_Migration
{
    public function up()
    {
        \$data = $data_string;

        \$this->db->insert_batch('{$table_name}', \$data);
    }

    public function down()
    {
        // Hapus semua data yang dimasukkan di atas
        \$this->db->truncate('{$table_name}');
    }
}
EOT;

        // Tulis konten ke dalam file
        if (file_put_contents($migration_path, $migration_template) === false) {
            return "Gagal membuat file seeder di: {$migration_path}";
        }

        return "Berhasil membuat file seeder di: {$migration_path}";
    }
}

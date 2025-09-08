\_ide_helper
untuk CodeIgniter 3 supaya Intelephense (atau PhpStorm) tidak menimbulkan error property

tools/\_ide_helper_models.php
Cara pakai
Simpan file generate_ide_helper_models.php di folder tools (atau di root).
Jalankan via CLI:
php tools/generate_ide_helper_models.php
File \_ide_helper.php akan otomatis di-update dengan semua model yang ada di application/models.

Create migration
php index.php migration_tools create <migration_name>

Created Seeder
php index.php seeder_tools create <seeder_name> [sort_field] [sort_order]

Running Migration
php index.php migrate

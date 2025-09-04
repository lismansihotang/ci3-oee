<?php
$modelsPath = __DIR__ . '/application/models';
$ideHelperPath = __DIR__ . '_ide_helper.php';

$files = glob($modelsPath . '/*.php');
$models = [];

foreach ($files as $file) {
    $className = pathinfo($file, PATHINFO_FILENAME);
    $models[] = $className;
}

$header = <<<PHP
<?php
// _ide_helper.php
// Only for IDEs (VSCode / PhpStorm / Intelephense), not for runtime.

/**
 * @property CI_DB_query_builder|CI_DB_driver \$db
 * @property CI_Loader \$load
 * @property CI_Input \$input
 * @property CI_Output \$output
 * @property CI_Session \$session
 * @property CI_Pagination \$pagination
 * @property CI_Form_validation \$form_validation
 * @property CI_Email \$email
 * @property CI_Upload \$upload
 * @property CI_Security \$security
 * @property CI_Config \$config
 * @property CI_URI \$uri
 * @property CI_Router \$router
 * @property CI_Benchmark \$benchmark
 * @property CI_Calendar \$calendar
 * @property CI_Cart \$cart
 * @property CI_Encryption \$encryption
 * @property CI_Table \$table
 * @property CI_Parser \$parser
 * @property CI_Profiler \$profiler
 * @property CI_FTP \$ftp
 * @property CI_Image_lib \$image_lib
 * @property CI_Zip \$zip
PHP;

// tambahkan semua model otomatis
foreach ($models as $m) {
    $header .= "\n * @property {$m} \${$m}";
}

$footer = <<<PHP

 *
 * Class CI_Controller
 */
class CI_Controller {}

/**
 * @property CI_DB_forge \$dbforge
 * @property CI_DB_utility \$dbutil
 * @property CI_DB_query_builder|CI_DB_driver \$db
 *
 * Class CI_Model
 */
class CI_Model {}
PHP;

file_put_contents($ideHelperPath, $header . $footer);

echo "Done! _ide_helper.php updated with " . count($models) . " models.\n";

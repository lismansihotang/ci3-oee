<?php
// _ide_helper.php
// Only for IDEs (VSCode / PhpStorm / Intelephense), not for runtime.

use CI_DB_query_builder;
use CI_DB_result;
use CI_DB_driver;

/**
 * @property CI_DB_query_builder|CI_DB_driver $db
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Output $output
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property CI_Form_validation $form_validation
 * @property CI_Email $email
 * @property CI_Upload $upload
 * @property CI_Security $security
 * @property CI_Config $config
 * @property CI_URI $uri
 * @property CI_Router $router
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Encryption $encryption
 * @property CI_Table $table
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_FTP $ftp
 * @property CI_Image_lib $image_lib
 * @property CI_Zip $zip
 *
 * Add your models here as well so IDE detects them:
 * @property User_model $user_model
 * @property Post_model $post_model
 * @property Product_model $product_model
 *
 * Class CI_Controller
 */
class CI_Controller {}

/**
 * @property CI_DB_forge $dbforge
 * @property CI_DB_utility $dbutil
 * @property CI_DB_query_builder|CI_DB_driver $db
 *
 * Class CI_Model
 */
class CI_Model {}

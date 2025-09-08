<?php
// File ini hanya untuk IDE, bukan untuk runtime.
// Tempatkan file ini di root proyek CodeIgniter Anda.

use CI_DB_query_builder;
use CI_DB_driver;
use CI_DB_result;
use CI_DB_forge;
use CI_DB_utility;
use CI_Loader;
use CI_Input;
use CI_Output;
use CI_Session;
use CI_Pagination;
use CI_Form_validation;
use CI_Email;
use CI_Upload;
use CI_Security;
use CI_Config;
use CI_URI;
use CI_Router;
use CI_Benchmark;
use CI_Calendar;
use CI_Cart;
use CI_Encryption;
use CI_Table;
use CI_Parser;
use CI_Profiler;
use CI_FTP;
use CI_Image_lib;
use CI_Zip;

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
 * Tambahkan model Anda di sini agar IDE dapat mendeteksinya.
 * @property Purchase_orders_model $purchase_orders_model
 * @property Products_model $products_model
 *
 * Class CI_Controller
 */
class CI_Controller {}

/**
 * @property CI_DB_query_builder|CI_DB_driver $db
 * @property CI_DB_forge $dbforge
 * @property CI_DB_utility $dbutil
 * @property CI_Session $session
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Output $output
 *
 * Class CI_Model
 */
class CI_Model {}

/**
 * Tambahkan MY_Controller dan MY_Model di sini untuk *chaining* yang lebih baik.
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
 * @property Purchase_orders_model $purchase_orders_model
 * @property Products_model $products_model
 * * Class MY_Controller
 */
class MY_Controller extends CI_Controller {}

/**
 * @property CI_DB_query_builder|CI_DB_driver $db
 * @property CI_DB_forge $dbforge
 * @property CI_DB_utility $dbutil
 * @property CI_Session $session
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Output $output
 * @property CI_Router $router
 * * Class MY_Model
 */
class MY_Model extends CI_Model {}

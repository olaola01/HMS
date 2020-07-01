<?php
/**
 * Created by PhpStorm.
 * tourproject
 * By: Olamiposi
 * 24/06/2020
 **/

use Src\databaseHelper\DatabaseObject;
use Src\databaseHelper\DatabaseUtils;
//use Src\Session\AdminSession;
use Src\Session\UserSession;


ob_start();
session_start();

define("SRC_PATH", dirname(__FILE__));
define("SHARED_PATH", SRC_PATH . '/shared');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/hospital') + 9;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);


$connection = DatabaseUtils::database_connection();
DatabaseObject::set_database($connection);
//StringUtils::set_database($connection);
$user_session = new UserSession();
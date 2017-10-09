<?php
session_start();
// session_regenerate_id(true); // regenerated the session, delete the old one.
ob_start();
define('StTime', microtime(true));

date_default_timezone_set('Asia/Bangkok');
error_reporting(E_ALL ^ E_NOTICE);

define("API_VERSION" 	,'1.0.1');
define("SOURCE_VERSION" ,'1.0.1');
define("API_NAME" 		,'Bhubejhr API');

include_once'config/config.php';
include_once'class/database/database.class.php';

$wpdb = new Database;
?>
<?php
session_start();
// session_regenerate_id(true); // regenerated the session, delete the old one.
ob_start();
define('StTime', microtime(true));

date_default_timezone_set('Asia/Bangkok');
error_reporting(E_ALL ^ E_NOTICE);

define("API_VERSION" 	,'1.0.2');
define("SOURCE_VERSION" ,'1.0.1');
define("API_SITE" 		,'Bhubejhr API');

include_once'config/config.php';
include_once'class/database/database.class.php';
include_once'class/app.class.php';
include_once'class/log.class.php';

include_once'class/diag/diag.class.php';
include_once'class/drug/drug.class.php';
include_once'class/finance/finance.class.php';
include_once'class/inventory/inventory.class.php';
include_once'class/labs/labs.class.php';
include_once'class/operation/operation.class.php';
include_once'class/patient/patient.class.php';
include_once'class/patient/preregister.class.php';
include_once'class/scheduling/appoint.class.php';
include_once'class/scheduling/user.class.php';
include_once'class/service/service.class.php';
include_once'class/user/user.class.php';

// DATABASE CONNECTION...
$wpdb 		= new Database(PDB_HOST,PDB_NAME,PDB_USER,PDB_PASS); // DATABASE SERVER
$localdb 	= new Database(DB_HOST,DB_NAME,DB_USER,DB_PASS); // DATABASE LOCAL

$app 		= new App;
$log 		= new Log;

$returnObject = array(
	"apiSite" 		=> API_SITE,
	"apiVersion"  	=> API_VERSION,
	"sourceVersion" => SOURCE_VERSION
);

if(!$wpdb->connection){
	$returnObject['db_connection'] = false;
	$returnObject['execute'] = floatval(round(microtime(true)-StTime,4));

	echo json_encode($returnObject);
	exit();
}
?>
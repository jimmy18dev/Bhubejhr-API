<?php
define('StTime', microtime(true));
date_default_timezone_set('Asia/Bangkok');
header("Content-type: text/json");

include_once'../config/config.php';
include_once'class/database.class.php';

$pdb = new Database(PDB_HOST,PDB_NAME,PDB_USER,PDB_PASS);

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"connection"    => $pdb->connection,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

echo json_encode($returnObject);
exit();
?>
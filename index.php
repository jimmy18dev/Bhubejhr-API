<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$headers = getallheaders();
$returnObject = array(
	"apiName" 		=> API_NAME,
	"apiVersion"  	=> API_VERSION,
	"sourceVersion" => SOURCE_VERSION,
	"executeTime"   => floatval(round(microtime(true)-StTime,4)),
);

echo json_encode($returnObject);
exit();
?>
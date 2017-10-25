<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$returnObject = array(
	"apiSite" 		=> API_SITE,
	"apiName" 		=> 'Welcome to '.API_SITE,
	"apiVersion"  	=> API_VERSION,
	"sourceVersion" => SOURCE_VERSION,
	"executeTime"   => floatval(round(microtime(true)-StTime,4)),
);

echo json_encode($returnObject);
exit();
?>
<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$returnObject['apiName'] = 'Welcome to '.API_SITE;
$executeTime = floatval(round(microtime(true)-StTime,4));
$returnObject['executeTime'] = $executeTime;

echo json_encode($returnObject);
exit();
?>
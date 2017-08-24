<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$api 		= new Api;
$app 		= new App;
$queries 	= new Queries;
$log 		= new Log;

$qid 		= $_GET['qid'];
$token 		= $_GET['token'];

if(!empty($token)){
	$app_id = $app->authentication($token);
	if(empty($app_id)){ $api->errorMessage('Invalid Token!'); exit(); }
}else{
	$api->errorMessage('Token not found!');
	exit();
}

$query = $queries->getQuery($qid);

if(empty($query)){ $api->errorMessage('Invalid QID!'); exit(); }

$dataset = $queries->process($query,$_GET);

$execute = $api->successMessage('Report API with QID '.$qid,$token,'',$dataset);

$log->save($app_id,$qid,$execute);
exit();
?>
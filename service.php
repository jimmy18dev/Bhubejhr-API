<?php
require_once 'autoload.php';
header("Content-type: text/json");

$api 		= new Api;
$app 		= new App;
$analytics 	= new Analytics;

$qid 		= $_GET['qid'];
$token 		= $_GET['token'];



if(!empty($token)){
	$app_id = $app->authentication($token);
	if(empty($app_id)){ $api->errorMessage('Invalid Token!'); exit(); }
}else{
	$api->errorMessage('Token not found!');
	exit();
}

if(!empty($_GET)){
	switch ($_GET['action']) {
		case 'list_patient':
			$dataset = $analytics->listPatient();
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'appoint':
			$dataset = $analytics->appoint();
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'clinic':
			$dataset = $analytics->clinic($_GET['clinic_id']);
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'delete':
			// $queries->deleteQuery($qid);
			// $api->successMessage('Query Deleted.','',floatval($qid),'');
			break;
		default:
			$api->errorMessage('API no action!');
			break;
	}
}else{
	$api->errorMessage('Invalid Signature or API not found!');
}

exit();
?>
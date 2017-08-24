<?php
require_once 'autoload.php';
header("Content-type: text/json");

$api 		= new Api;
$app 		= new App;

$qid 		= $_GET['qid'];
$token 		= $_GET['token'];
$analytics = new Analytics;

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
			// $qid = $queries->createQuery($user_id,$name,$description,$query,$url_example,$type);
			// $api->successMessage('New Query Created.','',floatval($qid),'');
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
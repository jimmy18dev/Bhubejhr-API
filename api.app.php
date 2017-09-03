<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$app = new App;
$api = new Api;

$app_id 		= $_POST['app_id'];
$name 			= $_POST['name'];
$description 	= $_POST['description'];
$user_id 		= 1;
$type 			= 'normal';
$status 		= 'active';

// API Request $_POST
if(true){
	switch ($_POST['action']) {
		case 'submit':
			if(!empty($app_id)){
				$app->editApp($app_id,$user_id,$name,$description,$type,$status);
				$api->successMessage('App Edited.',$app_id,'');
			}else{
				$app_id = $app->createApp($user_id,$name,$description,$type);
				$api->successMessage('New App Created.','',floatval($app_id),'');
			}
			break;
		case 'delete':
			$app->deleteApp($app_id,$user_id);
			$api->successMessage('App Deleted.','',floatval($app_id),'');
			break;
		case 'toggle_status':
			$app->toggleStatus($app_id);
			$api->successMessage('App status changed.','',floatval($app_id),'');
			break;
		case 'request_counter':
			$dataset = $app->requestCounter($app_id);
			// $api->successMessage('Query status changed.',floatval($qid),$dataset);

			$data = array(
				"apiVersion" => "1.0",
				"data" => array(
					"update" => time(),
					"execute" => round(microtime(true)-StTime,4)."s",
					"totalFeeds" => floatval($total),
					"items" => $dataset,
				),
			);

			echo json_encode($data);
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
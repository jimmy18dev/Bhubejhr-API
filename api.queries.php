<?php
require_once 'autoload.php';
header("Content-type: text/json");

$api 			= new Api;
$queries 		= new Queries;

$qid 			= $_POST['qid'];
$name 			= $_POST['name'];
$description 	= $_POST['description'];
$query 			= $_POST['query'];
$url_example 	= $_POST['example'];
$user_id 		= 1;
$type 			= $_POST['type'];

// API Request $_POST
if(true){
	switch ($_POST['action']) {
		case 'submit':
			if(!empty($qid)){
				$queries->editQuery($qid,$name,$description,$query,$url_example);
				$api->successMessage('Query Edited.','',$qid,'');
			}else{
				$qid = $queries->createQuery($user_id,$name,$description,$query,$url_example,$type);
				$api->successMessage('New Query Created.','',floatval($qid),'');
			}
			break;
		case 'delete':
			$queries->deleteQuery($qid);
			$api->successMessage('Query Deleted.','',floatval($qid),'');
			break;
		case 'toggle_status':
			$queries->toggleStatus($qid);
			$api->successMessage('Query status changed.','',floatval($qid),'');
			break;

		// GET DATA
		case 'request_counter':
			$dataset = $queries->requestCounter($qid);
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
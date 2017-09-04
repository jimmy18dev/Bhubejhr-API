<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$api 		= new Api;
$app 		= new App;
$analytics 	= new Analytics;
$patient 	= new Patient;
$visit 		= new Visit;

$qid 		= $_GET['qid'];
$token 		= $_GET['token'];
$cid 		= $_GET['cid'];



if(!empty($token)){
	$app_id = $app->authentication($token);
	if(empty($app_id)){ $api->errorMessage('Invalid Token!'); exit(); }
}else{
	$api->errorMessage('Token not found!');
	exit();
}

if(!empty($_GET)){
	switch ($_GET['action']) {
		case 'patient':
			$patient_data = $patient->get($cid);
			$hn = $patient_data['hn'];

			$visits = $visit->listVisit($hn);

			$execute = floatval(round(microtime(true)-StTime,4));

			$data = array(
				"apiVersion" => 1.0,
				"message" 	=> $message,
				"token" 	=> $token,
				"execute" 	=> $execute,
				"data" 		=> array(
					'patient' 		=> $patient_data,
					'visit' 		=> array(
						'visit_count' 	=> floatval(count($visits)),
						'items' 		=> $visits,
					),
				),
			);
			// JSON Encode and Echo.
			echo json_encode($data);
			break;
		case 'list_patient':
			$dataset = $analytics->listPatient();
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'appoint':
			$dataset = $analytics->appoint();
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'patient_ipd':
			$dataset = $analytics->patient_ipd();
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'clinic':
			$dataset = $analytics->clinic($_GET['clinic_id']);
			$api->exportJson('ทดสอบ',$dataset);
			break;
		case 'count_admit':
			$dataset = $analytics->count_admit();
			$api->exportJson('admit เดือน',$dataset);
			break;
		case 'count_dsc':
			$dataset = $analytics->count_dsc();
			$api->exportJson('จำหน่าย เดือน',$dataset);
			break;
		case 'count_refer_out':
			$dataset = $analytics->count_refer_out();
			$api->exportJson('Refer out เดือน',$dataset);
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
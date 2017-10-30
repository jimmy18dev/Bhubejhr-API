<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$patient = new Patient;
$appoint = new Appoint;

$returnObject['apiName'] = 'Patients Service';

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		$app_id = $app->authentication($_GET['token']);

		if(empty($app_id)){
			http_response_code(500);
			$returnObject['error'] = 'Authentication failure (Token not found!)';
			break;
		}

		switch ($_GET['request']){
			case 'get':
				$returnObject['request'] = $_GET['request'];
				$dataset = $patient->get($_GET['cid']);
				$returnObject['dataset'] = $dataset;
				break;
			case 'getappoint':
				$returnObject['request'] = $_GET['request'];
				$dataset = $appoint->get($_GET['hn']);
				$returnObject['dataset'] = $dataset;
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	$app_id = $app->authentication($_POST['token']);

    	if(empty($app_id)){
			http_response_code(500);
			$returnObject['error'] = 'Authentication failure (Token not found!)';
			break;
		}
		
    	switch ($_POST['request']){
			case 'example':
				$returnObject['message'] = 'Example API';
				break;
			default:
				$returnObject['message'] = 'POST API Not found!';
			break;
		}
    	break;
    default:
    	$returnObject['message'] = 'METHOD API Not found!';
    	break;
}

$executeTime = floatval(round(microtime(true)-StTime,4));
$returnObject['executeTime'] = $executeTime;

if(!empty($app_id) && !empty($request_id)){
	$lod_id = $log->save($app_id,$request_id,$executeTime);
	$returnObject['log_id'] = floatval($lod_id);
}

echo json_encode($returnObject);
exit();
?>
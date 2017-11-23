<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$patient 	= new Patient;
$preregister = new Preregister;
$appoint 	= new Appoint;
$drug 		= new Drug;
$lab 		= new Labs;

$returnObject['apiName'] = 'Patients Service';

$preregister->create('1102700125506','Mr.','Puwadon','Sricharoen','Thai','1991-09-18','Thai','religion','address','0801051930','บัตรทอง','พ่อแม่','วันชัย','เทพศรี','037294017','http://igensite.com/image.png','ปวดหัวตัวร้อน');

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		$app_id = $app->authentication($_GET['token']);

		if(empty($app_id)){
			http_response_code(401);
			$returnObject['error'] = 'Authentication failure (Token not found!)';
			break;
		}

		switch ($_GET['request']){
			case 'get':
				$request_id = 100;
				$returnObject['request'] = $_GET['request'];
				$dataset = $patient->get($_GET['cid']);
				$returnObject['dataset'] = $dataset;
				break;
			case 'getappoint':
				$request_id = 2;
				$returnObject['request'] = $_GET['request'];
				$dataset = $appoint->get($_GET['hn']);
				$returnObject['dataset'] = $dataset;
				break;
			case 'drug_opd':
				$request_id = 3;
				$returnObject['request'] = $_GET['request'];
				$dataset = $drug->drug_opd($_GET['hn']);
				$returnObject['dataset'] = $dataset;
				break;
			case 'lab_opd':
				$request_id = 4;
				$returnObject['request'] = $_GET['request'];
				$dataset = $lab->lab_opd($_GET['hn']);
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
	$lod_id = $log->save($app_id,$request_id,$_SERVER['REQUEST_URI'],$executeTime);
	$log->updateAccessTime($app_id);
	$returnObject['log_id'] = floatval($lod_id);
}

echo json_encode($returnObject);
exit();
?>
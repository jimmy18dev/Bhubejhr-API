<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json");

$patient 	= new Patient;
$preregister = new Preregister;
$appoint 	= new Appoint;
$drug 		= new Drug;
$lab 		= new Labs;

$returnObject['apiName'] = 'Patients Service';

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

				$person_id = $_GET['cid'];

				if(empty($person_id))
					$person_id = $_GET['hn'];

				$dataset = $patient->get($person_id);
				$returnObject['dataset'] = $dataset;
				break;

			case 'listVitalSign':
				$request_id = 100;
				$returnObject['request'] = $_GET['request'];

				$person_id = $_GET['cid'];

				if(empty($person_id))
					$person_id = $_GET['hn'];

				$dataset = $patient->get($person_id);
				$returnObject['patient'] = $dataset;

				if(!empty($dataset['hn'])){
					$vsdata = $patient->listVitalSign($dataset['hn']);
					$returnObject['patient']['vital_sign'] = $vsdata;
				}
				break;

			case 'listLab':
				$request_id = 100;
				$returnObject['request'] = $_GET['request'];

				$person_id = $_GET['cid'];

				if(empty($person_id))
					$person_id = $_GET['hn'];

				$dataset = $patient->get($person_id);
				$returnObject['patient'] = $dataset;

				if(!empty($dataset['hn'])){
					$labdata = $patient->listLab($dataset['hn']);
					$returnObject['patient']['lab_result'] = $labdata;
				}
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
			case 'get_preregister':
				$request_id 	= 102;
				$cid 			= $_GET['cid'];
				$returnObject['request'] = $_GET['request'];

				if(!empty($cid)){
					$dataset = $preregister->get($cid);
					$returnObject['dataset'] = $dataset;
				}else{
					$returnObject['message'] = 'Data invalid!';
				}
				break;
			case 'visitlist':
				$cid 			= $_GET['cid'];

				// if(strlen($cid) != 13) { $returnObject['message'] = 'CID Invalid!'; break; }
				if(empty($cid)) { $returnObject['message'] = 'CID Empty!'; break; }

				$patient_data 	= $patient->get($cid);
				$hn 			= $patient_data['hn'];

				if(empty($hn)) { $returnObject['message'] = 'HN Empty!'; break; }
				
				$visits 		= $patient->listVisit($hn);
				$execute 		= floatval(round(microtime(true)-StTime,4));

				$returnObject['data'] = array(
					'patient' => $patient_data,
					'visit' => array(
						'visit_count' 	=> floatval(count($visits)),
						'items' 		=> $visits
					)
				); $patient_data;
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	$json 	= file_get_contents('php://input');
    	$array 	= json_decode($json);
    	$app_id = $app->authentication($array->token);

    	if(empty($app_id)){
			http_response_code(500);
			$returnObject['error'] = 'Authentication failure (Token not found!)';
			break;
		}

    	switch ($array->request){
			case 'preregister':
				$request_id = 101;
				$returnObject['message'] = 'Pre Register API';

				$cid 			= $array->cid;
				$prename 		= $array->prename;
				$fname 			= $array->fname;
				$lname 			= $array->lname;
				$gender 		= $array->gender;
				$birthday 		= $array->birthday;
				$nation 		= $array->nation;
				$religion 		= $array->religion;
				$address 		= $array->address;
				$phone 			= $array->phone;
				$rightname 		= $array->rightname;
				$parent_type 	= $array->parent_type;
				$parent_fname 	= $array->parent_fname;
				$parent_lname 	= $array->parent_lname;
				$parent_phone 	= $array->parent_phone;
				$avatar 		= $array->avatar;
				$symptom 		= $array->symptom;

				if(empty($cid) || empty($fname) || empty($lname)){
					$returnObject['message'] = 'Data invalid!';
					break;
				}else{
					$preregister_id = $preregister->create($cid,$prename,$fname,$lname,$gender,$birthday,$nation,$religion,$address,$phone,$rightname,$parent_type,$parent_fname,$parent_lname,$parent_phone,$avatar,$symptom);
					$returnObject['preregister_id'] = $preregister_id;
				}

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
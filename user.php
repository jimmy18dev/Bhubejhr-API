<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$user = new User;

$returnObject = array(
	"apiSite" 		=> API_SITE,
	"apiName" 		=> 'User api service',
	"apiVersion"  	=> API_VERSION,
	"sourceVersion" => SOURCE_VERSION,
);

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		$app_id = $app->authentication($_GET['token']);

		if(empty($app_id)){
			http_response_code(401);
			$returnObject['error'] = 'Authentication failure (Token not found!)';
			break;
		}

		switch ($_GET['request']){
			case 'first_opd_card':
				$returnObject['request'] = $_GET['request'];
				$dataset = $user->firstOPDCard($_GET['date']);
				$returnObject['dataset'] = $dataset;
				break;
			case 'Diag_user':
				$returnObject['request'] = $_GET['request'];
				$dataset = $user->listDiag_user();
				$returnObject['dataset'] = $dataset;
				break;
			case 'Diag_desc':
				$returnObject['request'] = $_GET['request'];
				$dataset = $user->listDiag_desc($_GET['uid']);
				$returnObject['dataset'] = $dataset;
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	$app_id = $app->authentication($_POST['token']);
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
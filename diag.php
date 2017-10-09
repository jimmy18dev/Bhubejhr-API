<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

$headers = getallheaders();
$returnObject = array(
	"apiSite" 		=> API_SITE,
	"apiName" 		=> 'Diag api service',
	"apiVersion"  	=> API_VERSION,
	"sourceVersion" => SOURCE_VERSION,
	"executeTime"   => floatval(round(microtime(true)-StTime,4)),
);

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'example':
				$returnObject['message'] = 'Example API';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
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

echo json_encode($returnObject);
exit();
?>
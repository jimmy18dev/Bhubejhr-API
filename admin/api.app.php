<?php
require_once 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

// $apiArgArray = explode('/', substr(@$_SERVER['PATH_INFO'], 1));
// $headers = getallheaders();
// $token = $headers['Token'] or ['AuthKey'];
// $returnObject = (object) array();
$returnObject = array(
	"apiVersion"  	=> 1.0,
	"method" 		=> $_SERVER['REQUEST_METHOD'],
	// "header"      => $headers,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$app = new App;
$log = new Log;

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'list':
				$dataset = $app->listAll();

				$returnObject['items'] = $dataset;
				$returnObject['message'] = 'list all apps';
				break;
			case 'last7day':
				$dataset = $log->last7day($_GET['app_id']);
				$returnObject['items'] = $dataset;
				$returnObject['message'] = 'last 7 day';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	switch ($_POST['request']){
			case 'submit':
				$app_id 		= $_POST['app_id'];
				$name 			= $_POST['app_name'];
				$description 	= $_POST['app_description'];

				if(!empty($app_id) && isset($app_id)){
					$app->editApp($app_id,$name,$description);
					$returnObject['message'] 	= 'app edited.';
				}else{
					$app_id = $app->createApp($user->id,$name,$description);
					$returnObject['message'] 	= 'create new app success.';
					$returnObject['app_id'] 	= $app_id;
				}
				break;
			case 'update':
				$app_id 		= $_POST['app_id'];
				$name 			= $_POST['app_name'];
				$description 	= $_POST['app_desc'];

				if(!empty($app_id) && isset($app_id)){
					$app->editApp($app_id,$name,$description);
					$returnObject['message'] 	= 'app edited.';
				}else{
					$returnObject['message'] 	= 'app edit fail!.';
				}
				break;
			case 'delete':
				$app_id 		= $_POST['app_id'];
				$app->deleteApp($app_id,$user->id);

				$returnObject['message'] 	= 'app edited.';
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
?>
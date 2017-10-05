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

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'list':
				$dataset = $app->listAll();

				$returnObject['items'] = $dataset;
				$returnObject['message'] = 'list all apps';
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
				$user_id 		= 1;
				$name 			= $_POST['app_name'];
				$description 	= $_POST['app_description'];

				if(!empty($app_id) && isset($app_id)){
					$app->editApp($app_id,$name,$description);
					$returnObject['message'] 	= 'app edited.';
				}else{
					$app_id = $app->createApp($user_id,$name,$description);
					$returnObject['message'] 	= 'create new app success.';
					$returnObject['app_id'] 	= $app_id;
				}
				break;
			case 'delete':
				$app_id 		= $_POST['app_id'];
				$user_id 		= 1;

				$app->deleteApp($app_id,$user_id);

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
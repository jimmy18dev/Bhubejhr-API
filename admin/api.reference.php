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

$reference = new Reference;

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'list':
				$dataset = $reference->listAll();

				$returnObject['items'] = $dataset;
				$returnObject['message'] = 'list all References';
				break;
			case 'get':
				$reference_id = $_GET['reference_id'];
				$dataset = $reference->get($reference_id);

				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'get References info';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	switch ($_POST['request']){
			case 'submit':
				$reference_id 	= $_POST['reference_id'];
				$name 			= $_POST['reference_name'];
				$description 	= $_POST['reference_description'];
				$method 		= $_POST['reference_method'];
				$type 			= $_POST['reference_type'];
				$category_id 	= $_POST['reference_category'];

				if(!empty($reference_id) && isset($reference_id)){
					$reference->edit($reference_id,$method,$category_id,$name,$description,$type);
					$returnObject['message'] 	= 'Reference edited.';
				}else{
					$reference_id = $reference->create($method,$user->id,$category_id,$name,$description,$type);
					$returnObject['message'] 	= 'create new Reference success.';
					$returnObject['reference_id'] = $reference_id;
				}
				break;
			case 'delete':
				$reference_id 	= $_POST['reference_id'];
				$reference->delete($reference_id);

				$returnObject['message'] 	= 'Reference deleted!';
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
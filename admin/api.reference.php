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
			case 'allday_usage':
				$ref_id = $_GET['ref_id'];
				$dataset = $reference->alldayUsage($ref_id);
				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'get References all day usage';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	switch ($_POST['request']){
			case 'create':
				$name 			= $_POST['name'];
				$description 	= $_POST['desc'];
				$example 		= $_POST['example'];
				$category 		= $_POST['category'];
				$method 		= $_POST['method'];
				$type 			= $_POST['type'];

				$reference_id = $reference->create($user->id,$name,$description,$example,$category,$method,$type);
				$returnObject['message'] 	= 'create new Reference success.';
				$returnObject['reference_id'] = $reference_id;
				break;
			case 'edit':
				$ref_id 		= $_POST['ref_id'];
				$name 			= $_POST['name'];
				$description 	= $_POST['desc'];
				$example 		= $_POST['example'];

				$reference->edit($ref_id,$name,$description,$example);
				$returnObject['message'] 	= 'Reference edited';
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
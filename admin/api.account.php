<?php
require_once 'autoload.php';
// header('Access-Control-Allow-Origin: *');
header("Content-type: text/json");

// $apiArgArray = explode('/', substr(@$_SERVER['PATH_INFO'], 1));
// $headers = getallheaders();
// $token = $headers['Token'] or ['AuthKey'];
// $returnObject = (object) array();
$returnObject = array(
	"apiVersion"  	=> 1.0,
	"method" 		=> $_SERVER['REQUEST_METHOD'],
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

if($user->permission != 'admin' || $user->status != 'active'){
	$returnObject['message'] = 'user permission error!';
	echo json_encode($returnObject);
	exit();
}

$signature 	= new Signature;
$account = new Account;

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		// switch ($_GET['request']){
		// 	case 'list':
		// 		$dataset = $app->listAll();

		// 		$returnObject['items'] = $dataset;
		// 		$returnObject['message'] = 'list all apps';
		// 		break;
		// 	default:
		// 		$returnObject['message'] = 'GET API Not found!';
		// 	break;
		// }
    	break;
    case 'POST':
    	switch ($_POST['request']){
			// case 'create_account':
			// 	$displayname = $_POST['displayname'];
			// 	$username 	= $_POST['username'];
			// 	$password 	= $_POST['password'];
			// 	$permission = $_POST['account_permission'];
			// 	$owner_id 	= $user->id;

			// 	$account_id = $account->create($displayname,$username,$password,$permission,$owner_id);

			// 	$returnObject['message'] 	= 'New Account Created!';
			// 	$returnObject['account_id'] = $account_id;

			// 	break;
			case 'setAdmin':
				$account_id = $_POST['account_id'];
				$account->setToAdmin($user->id,$account_id);
				$returnObject['message'] 	= 'Success!';
				$returnObject['account_id'] = $account_id;
				break;
			case 'approve':
				$account_id = $_POST['account_id'];
				$account->approve($user->id,$account_id);
				$returnObject['message'] 	= 'Account Approved!';
				$returnObject['account_id'] = $account_id;
				break;
			case 'disable':
				$account_id = $_POST['account_id'];
				$account->disable($user->id,$account_id);
				$returnObject['message'] 	= 'Account Disable!';
				$returnObject['account_id'] = $account_id;
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
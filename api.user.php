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
	// "header"      => $headers,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;

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
			case 'login':
				$username = $_POST['username'];
				$password = $_POST['password'];

				$state = $user->login($_POST['username'],$_POST['password']);

				if($state == 1) $message = 'login success';
				else if($state == 1) $message = 'Login fail';
				else if($state == -1) $message = 'Account Locked';
				else $message = 'n/a';

				$returnObject['message'] 	= $message;
				$returnObject['state'] 		= $state;
				
				break;
			case 'edit_profile':
				$username 		= $_POST['username'];
				$displayname 	= $_POST['displayname'];

				$user->editProfile($user->id,$username,$displayname);

				$returnObject['message'] 	= 'Profile saved.';
				break;
			case 'change_password':
				$oldpassword = $_POST['oldpassword'];
				$newpassword = $_POST['newpassword'];

				$user->changePassword($user->id,$oldpassword,$newpassword);

				$returnObject['message'] 	= 'Password changed.';
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
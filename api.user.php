<?php
require_once 'autoload.php';
header("Content-type: text/json");

$signature 	= new Signature;
$api 		= new Api;

// API Request $_POST
if($_POST['calling'] != '' && $signature->verifySign($_POST['sign'])){
	switch ($_POST['calling']){
		case 'user':
			switch ($_POST['action']) {
				case 'register':
					$state = $user->register($_POST['username'],$_POST['name'],$_POST['password']);

					if($state != 0){
						$user->login($_POST['username'],$_POST['password']);
						$message = 'Register success';
					}else $message = 'n/a';

					$api->successMessage($message,$signature,$state,'');
					break;
				case 'login':
					$state = $user->login($_POST['username'],$_POST['password']);

					if($state == 1) $message = 'login success';
					else if($state == 1) $message = 'Login fail';
					else if($state == -1) $message = 'Account Locked';
					else $message = 'n/a';

					$api->successMessage($message,$signature,$state,'');
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('USER POST API ERROR!');
			break;
	}
}
// API Request is Fail or Null calling
else{
	$api->errorMessage('Invalid Signature or API not found!');
}

exit();
?>
<?php
require_once 'autoload.php';
header("Content-type: text/json");

$api 		= new Api;
$queries 	= new Queries;
$qid 		= $_GET['qid'];

$query 		= $queries->getQuery($qid);
$dataset 	= $queries->process($query,$_GET);
$api->successMessage('CALLING API SERVICE '.$query,'',$dataset);

// API Request $_POST
// switch ($_GET['calling']) {
// 	case 'get':
		
// 		break;
// 	default:
// 		$api->errorMessage('COMMENT POST API ERROR!');
// 		break;
// }

exit();
?>
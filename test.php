<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<meta charset="utf-8">
</head>
<body>

<?php
$cid 		= '1102700125506';
$token 		= 'e961ce53991d6a45ceb36177ba56a434f';
$action 	= 'patient';
$request 	= 'http://172.16.14.5/api/service.php?token='.$token.'&action='.$action.'&cid='.$cid;

$json 		= file_get_contents($request);
$obj 		= json_decode($json);

echo'<pre>';
print_r($obj);
echo'</pre>';
?>
</body>
</html>
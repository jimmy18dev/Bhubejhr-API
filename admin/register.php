<?php
include_once 'autoload.php';
if($user_online){
	header('Location: index.php');
	die();
}
$signature 	= new Signature;
$currentPage = 'register';
?>
<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php include'favicon.php';?>
<title>Register | <?php echo SITENAME;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body class="login-bg">
<div class="progressbar" id="progressbar"></div>
<form class="login" action="javascript:register();">
	<h1>Bhubejhr API</h1>
	<p>Get the full details of all the nodes, edges, and fields</p>
	<label for="fullname">Fullname</label>
	<input class="inputtext" type="text" id="fullname" autofocus>
	<label for="email">Email</label>
	<input class="inputtext" type="text" id="email">
	<label for="password">Password</label>
	<input class="inputtext" type="password" id="password">
	
	<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('register',SECRET_KEY);?>">

	<a href="login.php">Login wiht Email</a>
	<button id="btn-submit" class="btn-submit register">Register<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
</form>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>
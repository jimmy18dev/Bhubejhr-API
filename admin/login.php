<?php
include_once 'autoload.php';
if($user_online){
	header('Location: '.DOMAIN.'/index.php');
	die();
}
$signature 	= new Signature;
$currentPage = 'login';
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
<title>Login | <?php echo SITENAME;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body class="login-bg">
<div class="progressbar" id="progressbar"></div>
<form class="login" action="javascript:login();">
	<h1>Bhubejhr API</h1>
	<p>Get the full details of all the nodes, edges, and fields</p>
	<label for="username">Email or Username</label>
	<input class="inputtext" type="text" id="username" autofocus>
	<label for="password">Password</label>
	<input class="inputtext" type="password" id="password">
	<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('login',SECRET_KEY);?>">
	<a href="register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Create New Account</a>
	<button id="btn-submit" class="btn-submit">Login<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
</form>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>
<?php
include_once 'autoload.php';
if($user_online){
	header('Location: '.DOMAIN.'/index.php');
	die();
}
$signature 	= new Signature;
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
<body>
<div class="progressbar" id="progressbar"></div>
<form class="login" action="javascript:login();">
	<h1><?php echo SITENAME;?></h1>
	<p>Version <?php echo VERSION;?></p>
	<input class="inputtext" type="text" id="username" placeholder="Username" autofocus>
	<input class="inputtext" type="password" id="password" placeholder="Password">
	<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('login',SECRET_KEY);?>">
	<button id="btn-submit" class="btn-submit">Login</button>
	<a class="btn-link" href="register.php">Register New Account</a>
</form>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>
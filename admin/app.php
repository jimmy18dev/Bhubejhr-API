<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}
$app_id = $_GET['id'];
$app 		= new app;
$app->get($app_id);
$applogs = $app->log($app_id);
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
<title>Apps | <?php echo SITENAME;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<a href="profile.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
</header>

<div class="container">
	<div class="log">
		<?php foreach ($applogs as $var) { ?>
		<div class="log-items <?php echo ($var['log_executed']>1?'-alert':'');?>">
			<div class="method"><?php echo strtoupper($var['ref_method']);?></div>
			<div class="time" title="log id <?php echo $var['log_id'];?>"><?php echo $var['log_time'];?></div>
			<div class="ref"><?php echo $var['ref_name']?></div>
			<div class="execute"><?php echo $var['log_executed'];?> s.</div>
		</div>
		<?php }?>
	</div>
</div>

<div class="navigation">
	<div class="group profile">
		<div class="name"><?php echo $app->name;?></div>
		<div class="desc"><?php echo $app->description;?></div>
		<div class="info-items">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<div class="detail"><strong>Token</strong> <?php echo $app->token;?></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/app.graph.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
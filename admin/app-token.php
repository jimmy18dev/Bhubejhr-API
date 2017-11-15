<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}
$app_id = $_GET['id'];
$app 		= new app;
$log = new Log;
$app->get($app_id);
$log_today = $log->today($app_id);
$log_allday = $log->allday($app_id);
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
<?php include'header.php';?>
<div class="progressbar" id="progressbar"></div>
<div class="pagehead">
	<div class="head">
		<h1><?php echo $app->name;?></h1>

		<?php if(!empty($app->description)){?>
		<p><?php echo $app->description;?></p>
		<?php }?>
	</div>

	<div class="tab">
		<a href="app.php?id=<?php echo $app->id;?>" class="tab-items"><i class="fa fa-bolt" aria-hidden="true"></i>Activity</a>
		<a href="app-token.php?id=<?php echo $app->id;?>" class="tab-items -active"><i class="fa fa-key" aria-hidden="true"></i>Token</a>
		<a href="app-setting.php?id=<?php echo $app->id;?>" class="tab-items"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
	</div>
</div>
<div class="container">
	<h2>Token Key</h2>
	<div class="form">
		<div class="form-items">
			<input type="text" class="inputtext" value="<?php echo $app->token;?>">
		</div>
	</div>
</div>

<input type="hidden" id="app_id" value="<?php echo $app->id;?>">
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/app.setting.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
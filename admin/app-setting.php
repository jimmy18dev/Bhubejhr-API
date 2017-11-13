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
<div class="navigation">
	<div class="group">
		<h4><i class="fa fa-key" aria-hidden="true"></i>App Token</h4>
		<input type="text" class="inputtext" value="<?php echo $app->token;?>">
	</div>
	<div class="group">
		<h4><i class="fa fa-bar-chart" aria-hidden="true"></i>Analytcis</h4>
		<div class="stat">
			<div class="v"><?php echo $log->todayRequest($app->id);?></div>
			<div class="c">Today Request</div>
		</div>
		<div class="stat">
			<div class="v"><?php echo $log->totalRequest($app->id);?></div>
			<div class="c">Total Request</div>
		</div>
		<div class="stat">
			<div class="v"><?php echo number_format($log->AvgExecuteTime($app->id),2);?> s.</div>
			<div class="c">Avg execute time</div>
		</div>
	</div>
	<div class="group">
		<h4><i class="fa fa-shield" aria-hidden="true"></i>Permission</h4>
		<?php if($app->permission_get){?><span class="box get">GET</span><?php }?>
		<?php if($app->permission_post){?><span class="box post">POST</span><?php }?>
		<?php if($app->permission_put){?><span class="box put">PUT</span><?php }?>
		<?php if($app->permission_delete){?><span class="box delete">DELETE</span><?php }?>
	</div>
	<div class="group delete">
		<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Delete this app</h4>
		<p>Once you delete a app, there is no going back. Please be certain.</p>

		<button class="btn-delete" id="btnDeleteApp">Delete this App</button>
	</div>
</div>

<div class="container">
	<div class="head">
		<h1><?php echo $app->name;?></h1>
	</div>
	<h2>App Setting</h2>
	<div class="form">
		<div class="form-items">
			<label for="app_name">App name</label>
			<input type="text" class="inputtext" id="app_name" value="<?php echo $app->name;?>">
		</div>
		<div class="form-items">
			<label for="app_desc">Description</label>
			<textarea class="inputtextarea" id="app_desc"><?php echo $app->description;?></textarea>
		</div>

		<input type="hidden" id="app_id" value="<?php echo $app->id;?>">

		<div class="form-control">
			<button class="btn-submit" id="btnUpdate">Update App</button>
		</div>
	</div>
</div>

<input type="hidden" id="app_id" value="<?php echo $app->id;?>">
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/app.setting.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
</body>
</html>
<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: login.php');
	die();
}

$app = new app;
$reference = new Reference;
$signature 	= new Signature;
$currentPage = 'profile';

$apps = $app->listAll($user->id);

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
<title>Profile | Bhubejhr API</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>
<div class="list">
	<?php if($user->status == 'active'){?>
	<h1>You have <?php echo $user->total_app;?> Apps And Read More <a href="reference.php">API References<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></h1>
	<div class="apps-list" id="apps">
		<?php foreach ($apps as $var) {?>
		<a href="app.php?id=<?php echo $var['app_id'];?>" class="app-items" id="app<?php echo $var['app_id'];?>" data-id="<?php echo $var['app_id'];?>">
			<div class="detail">
				<h2><?php echo $var['app_name'];?></h2>
				<p><?php echo (!empty($var['app_description'])?$var['app_description']:'Description');?></p>
			</div>
			<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $var['app_create_time'];?></div>
			<div class="stat" title="<?php echo number_format($var['request_count']);?> Requests on this day."><?php echo number_format($var['request_count']);?></div>
		</a>
		<?php }?>

		<?php if($user->total_app < $user->app_limit && $user->status == 'active'){?>
		<div class="app-items btn-new-app" id="btnCreateApp"><i class="fa fa-plus-circle" aria-hidden="true"></i>Create a <strong>new App</strong></div>
		<?php }?>
	</div>
	<?php }else{?>
	<div class="approve-waiting">
		<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
		<p>Your access to the <?php echo SITENAME;?> is waiting for Administrator approval!</p>
	</div>
	<?php }?>
</div>

<div class="dialog" id="createAppDialog">
	<div class="input">
		<label for="app_name">App Name</label>
		<input type="text" id="app_name" class="inputtext" placeholder="The name of your App ID">
	</div>
	<div class="control">
		<div class="btn btn-submit" id="btnSubmitCreateApp">Create App</div>
		<div class="btn btn-close" id="btnCloseCreateApp">Close</div>
	</div>
</div>
<div class="filter" id="createDialogFilter"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
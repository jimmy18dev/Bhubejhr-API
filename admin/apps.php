<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app 		= new app;
$reference 	= new Reference;
$signature 	= new Signature;

$apps = $app->listAll($user->id);
$currentPage = 'apps';
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

<div class="container">
	<div class="sorting">
		<div class="limit"><?php echo $user->total_app;?>/<?php echo $user->app_limit;?></div>
	</div>
	<div class="apps-list" id="apps">
		<?php foreach ($apps as $var) {?>
		<div class="app-items" id="app<?php echo $var['app_id'];?>" data-id="<?php echo $var['app_id'];?>">
			<div class="icon"><a href="app.php?id=<?php echo $var['app_id'];?>" class="name"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></a></div>
			<div class="btn-edit-app"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
			<div class="detail">
				<a href="app.php?id=<?php echo $var['app_id'];?>" class="name"><?php echo $var['app_name'];?></a>
				<div class="info"><?php echo (!empty($var['app_description'])?$var['app_description']:'...');?></div>

				<span class="lable">Token:</span>
				<input type="text" class="token" value="<?php echo $var['app_key'];?>">
			</div>
		</div>
		<?php }?>
	</div>
</div>

<div class="dialog" id="createAppDialog">
	<div class="head">
		<div class="icon"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></div>
		<div class="text">Create a New App ID</div>
		<div class="btn" id="btnCloseCreateApp"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<label for="app_name">App Name</label>
		<input type="text" id="app_name" class="inputtext" placeholder="The name of your App ID">
		<label for="app_description">App Description</label>
		<textarea class="textarea" id="app_description"></textarea>
		<input type="hidden" id="app_id">
	</div>
	<div class="control">
		<div class="btn btn-delete" id="btnDeleteApp">Delete</div>
		<div class="btn btn-submit" id="btnSubmitCreateApp">Create App ID</div>
	</div>
</div>
<div class="filter" id="createDialogFilter"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
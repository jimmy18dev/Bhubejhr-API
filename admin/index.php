<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app 		= new app;
$reference 	= new Reference;
$signature 	= new Signature;

$apps = $app->listAll();

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
<title>Apps | Bhubejhr API</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>

<div class="container">
	<div class="list" id="apps">
		<div class="app-items btn-new-app" id="btnCreateApp">
			<i class="fa fa-plus-circle" aria-hidden="true"></i>Create New App
		</div>
		<?php foreach ($apps as $var) {?>
		<div class="app-items" id="app<?php echo $var['app_id'];?>" data-id="<?php echo $var['app_id'];?>">
			<div class="detail">
				<a href="app-detail.php?id=<?php echo $var['app_id'];?>" class="name"><?php echo $var['app_name'];?></a>
				<input type="text" class="token" value="<?php echo $var['app_key'];?>">
				<div class="info"><?php echo $var['app_description'];?></div>
				
			</div>
			<div class="btn-edit-app"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
		</div>
		<?php }?>
	</div>
</div>

<div class="dialog" id="createAppDialog">
	<div class="head">
		<div class="text">Create new App</div>
		<div class="btn" id="btnCloseCreateApp"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<input type="text" id="app_name" class="inputtext" placeholder="App name...">
		<textarea class="textarea" id="app_description" placeholder="Description..."></textarea>
		<input type="hidden" id="app_id">
	</div>
	<div class="control">
		<div class="btn btn-delete" id="btnDeleteApp">Delete</div>
		<div class="btn btn-submit" id="btnSubmitCreateApp">Save</div>
	</div>
</div>
<div class="filter" id="createDialogFilter"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
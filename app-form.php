<?php
include_once 'autoload.php';

$app_id = $_GET['app_id'];

$app = new App;
$app->get($app_id);
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
<title>TOKEN FORM</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<?php if(!empty($app->id)){?>
	<a href="app-detail.php?id=<?php echo $app->id;?>" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
	<?php }else{?>
	<a href="index.php" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
	<?php }?>

	<div class="title">NEW APP</div>
</header>
<div class="container">
	<div class="form">
		<?php if(!empty($app->update_time)){?>
		<div class="info">Last updated <?php echo $app->update_time;?></div>
		<?php }?>

		<?php if(!empty($app->id)){?>
		<div class="form-items">
			<div class="label">Status:</div>
			<div class="input">
				<span id="btn-toggle-status"><?php echo ($app->status=='active'?'<i class="fa fa-toggle-on" aria-hidden="true"></i>':'<i class="fa fa-toggle-off" aria-hidden="true"></i>');?></span>
			</div>
		</div>
		<?php }?>

		<div class="form-items">
			<div class="label">App Name:</div>
			<div class="input">
				<input type="text" id="name" class="input-text" value="<?php echo $app->name;?>" autofocus>
			</div>
		</div>
		<div class="form-items">
			<div class="label">Description:</div>
			<div class="input">
				<textarea class="input-textarea" id="description"><?php echo $app->description;?></textarea>
			</div>
		</div>

		<div class="form-items">
			<div class="label"></div>
			<div class="input">
			<?php if(!empty($app->id)){?>
			<div class="btn btn-delete" id="btn-delete">DELETE APP</div>
			<?php }?>
			
			<button class="btn" id="btn-submit"><?php echo (!empty($app->id)?'SAVE':'CREATE');?></button>
			</div>
		</div>

		<input type="hidden" id="app_id" value="<?php echo $app->id;?>">
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>
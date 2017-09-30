<?php
include_once 'autoload.php';
$app = new app();

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
<title>JHOS API</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>

<div class="container">
	<div class="list">
		<div class="head">
			<a href="app-form.php" class="btn">CREATE APP</a>
		</div>
		<?php foreach ($apps as $var) {?>
		<div class="list-items">
			<a href="app-detail.php?id=<?php echo $var['app_id'];?>" class="icon"><i class="fa fa-cube" aria-hidden="true"></i></a>
			<div class="detail">
				<a href="app-detail.php?id=<?php echo $var['app_id'];?>" class="v"><i class="fa fa-circle" aria-hidden="true"></i><?php echo $var['app_name'];?></a>
				<p><?php echo $var['app_key'];?></p>
			</div>
			<div class="stat"><?php echo number_format($var['request_count']);?></span>
			</div>
		</div>
		<?php }?>
	</div>
</div>

<div class="dialog">
	<div class="input">
		<input type="text" class="inputtext" placeholder="App name...">
		<textarea class="textarea" placeholder="Description..."></textarea>
	</div>
	<div class="control">
		<div class="btn btn-cancel">CREATE</div>
		<div class="btn btn-submit">EXIT</div>
	</div>
</div>
<div class="filter" id="dialog-filter"></div>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
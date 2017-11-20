<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app = new app;
$reference = new Reference;
$reference->get($_GET['id']);
$app->get($_GET['app']);
$apps = $app->listAll($user->id);
$currentPage = 'reference';
$tab = 'home';

$log_today = $reference->today($reference->id);
$log_allday = $reference->allday($reference->id);

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
<title>Reference | <?php echo SITENAME;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>
<?php include_once 'pagehead.reference.php';?>
<div class="container">

	<h2>API Example</h2>
	<div class="form">
		<div class="form-items">
			<label for="appExample">APP Exmaple</label>
			<div class="select">
				<select id="appExample">
					<option selected>Select your app</option>
					<?php foreach ($apps as $var) {?>
					<option value="<?php echo $var['app_id'];?>"><?php echo $var['app_name'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-items">
			<label for="app_name">API URL</label>
			<textarea class="inputtextarea" id="urlExample" disabled></textarea>
		</div>
	</div>

	<h2>Today</h2>
	<div class="log">
		<?php if(count($log_today)>0){?>
		<?php foreach ($log_today as $var) { ?>
		<div class="log-items <?php echo ($var['log_executed']>1?'-alert':'');?>">
			<div class="method"><?php echo (!empty($var['ref_method'])?strtoupper($var['ref_method']):'n/a');?></div>
			<div class="time" title="log id <?php echo $var['log_id'];?>"><?php echo $var['log_time'];?></div>
			<div class="ref"><a href="reference-page.php?id=<?php $var['ref_id'];?>"><?php echo (!empty($var['app_name'])?$var['app_name']:'n/a')?></a></div>
			<div class="execute"><?php echo $var['log_executed'];?> s.</div>
		</div>
		<?php }?>
		<?php }else{?>
		<div class="empty">Activity Not Found!</div>
		<?php }?>
	</div>
</div>

<input type="hidden" id="ref_id" value="<?php echo $reference->id;?>">
<input type="hidden" id="url_example" value="<?php echo DOMAIN;?>/<?php echo $reference->example?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
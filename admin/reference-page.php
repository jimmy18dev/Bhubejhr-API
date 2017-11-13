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
<?php include'header.php';?>

<div class="navigation">
	<div class="group">
		<h4>Analytics</h4>
		<div class="stat">
			<div class="v"><?php echo $reference->todayRequest($reference->id);?></div>
			<div class="c">Today Request</div>
		</div>
		<div class="stat">
			<div class="v"><?php echo $reference->totalRequest($reference->id);?></div>
			<div class="c">Total Request</div>
		</div>
		<div class="stat">
			<div class="v"><?php echo number_format($reference->AvgExecuteTime($reference->id),2);?> s.</div>
			<div class="c">Execute Time</div>
		</div>
		<!-- <div class="stat">
			<div class="v">34 Min</div>
			<div class="c">Last Access</div>
		</div> -->
	</div>

	<div class="group">
		<h4>Example</h4>
		<?php foreach ($apps as $var) {?>
		<a class="select-items" href="reference-page.php?id=<?php echo $reference->id;?>&app=<?php echo $var['app_id'];?>"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><?php echo $var['app_name'];?></a>
		<?php }?>
	</div>

	<?php if(!empty($app->id)){?>
	<p>Example: <a href="<?php echo DOMAIN;?>/<?php echo $reference->example?>&token=<?php echo $app->token;?>" target="_blank">OPEN API</a></p>
	<?php }?>
</div>

<div class="container">
	<div class="head">
		<h1><?php echo $reference->name;?></h1>
		<p><?php echo $reference->description;?> <a href="reference-setting.php?id=<?php echo $reference->id;?>">Edit Reference</a></p>
	</div>

	<div class="chart">
		<canvas id="chart"></canvas>
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

	<h2>All Day</h2>
	<div class="log">
		<?php if(count($log_allday)>0){?>
		<?php foreach ($log_allday as $var) { ?>
		<div class="log-items <?php echo ($var['log_executed']>1?'-alert':'');?>">
			<div class="method"><?php echo (!empty($var['ref_method'])?strtoupper($var['ref_method']):'n/a');?></div>
			<div class="time" title="log id <?php echo $var['log_id'];?>"><?php echo $var['log_time'];?></div>
			<div class="ref"><a href="reference-page.php?id=<?php $var['app_id'];?>"><?php echo (!empty($var['app_name'])?$var['app_name']:'n/a')?></a></div>
			<div class="execute"><?php echo $var['log_executed'];?> s.</div>
		</div>
		<?php }?>
		<?php }else{?>
		<div class="empty">Activity Not Found!</div>
		<?php }?>
	</div>
</div>

<input type="text" id="ref_id" value="<?php echo $reference->id;?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/reference.chart.js"></script>
<script type="text/javascript" src="js/layout.js"></script>
</body>
</html>
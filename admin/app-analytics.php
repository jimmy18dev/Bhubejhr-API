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
$currentPage = 'profile';
$tab = 'analytics';
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
<div class="progressbar" id="progressbar"></div>
<?php include_once'header.php';?>
<?php include_once'pagehead.app.php'; ?>
<div class="container">
	<h2>Analytcis</h2>
	<div class="stat">
		<div class="stat-items">
			<div class="v"><?php echo $log->todayRequest($app->id);?></div>
			<div class="c">Today Request</div>
		</div>
		<div class="stat-items">
			<div class="v"><?php echo $log->totalRequest($app->id);?></div>
			<div class="c">Total Request</div>
		</div>
		<div class="stat-items">
			<div class="v"><?php echo number_format($log->AvgExecuteTime($app->id),2);?> s.</div>
			<div class="c">Avg execute time</div>
		</div>
	</div>

	<h2>This Week</h2>
	<div class="chart">
		<canvas id="chart"></canvas>
	</div>
	
	<h2>Today</h2>
	<div class="log">
		<?php if(count($log_today)>0){?>
		<?php foreach ($log_today as $var) { ?>
		<div class="log-items <?php echo ($var['log_executed']>1?'-alert':'');?>">
			<div class="method"><?php echo (!empty($var['ref_method'])?strtoupper($var['ref_method']):'n/a');?></div>
			<div class="ref"><a href="reference-page.php?id=<?php echo $var['ref_id'];?>"><i class="fa fa-file-text" aria-hidden="true"></i><?php echo (!empty($var['ref_name'])?$var['ref_name'].' #'.$var['ref_id']:'n/a')?></a></div>
			<div class="time" title="log id <?php echo $var['log_id'];?>"><?php echo $var['log_time'];?></div>
			<div class="execute"><?php echo $var['log_executed'];?> s.</div>
		</div>
		<?php }?>
		<?php }else{?>
		<div class="empty">Activity Not Found!</div>
		<?php }?>
	</div>

	<h2>All Day</h2>
	<div class="log">
		<div class="log-items -topic">
			<div class="id">ID</div>
			<div class="ref">Reference</div>
			<div class="time">Time</div>
			<div class="execute">Execute</div>
		</div>
		<?php if(count($log_allday)>0){?>
		<div class="log-container">
			<?php foreach ($log_allday as $var) { ?>
			<div class="log-items <?php echo ($var['log_executed']>1?'-alert':'');?>">
				<div class="id">#<?php echo $var['log_id'];?></div>
				<div class="ref">
					<span class="method <?php echo $var['ref_method'];?>"><?php echo (!empty($var['ref_method'])?strtoupper($var['ref_method']):'n/a');?></span>
					<a href="reference-page.php?id=<?php echo $var['ref_id'];?>"><?php echo (!empty($var['ref_name'])?$var['ref_name'].' #'.$var['ref_id']:'n/a')?></a>
				</div>
				<div class="time" title="log id <?php echo $var['log_id'];?>"><?php echo $var['log_time'];?></div>
				<div class="execute"><?php echo $var['log_executed'];?> s.</div>
			</div>
			<?php }?>
		</div>
		<?php }else{?>
		<div class="empty">Activity Not Found!</div>
		<?php }?>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/app.chart.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
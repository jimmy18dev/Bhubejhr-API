<?php
include_once 'autoload.php';

$qid = $_GET['qid'];

$queries = new Queries;
$log = new Log;

$queries->get($qid);
$logs = $log->listByQID($qid);

$currentPage = 'queries';
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

<header class="header">
    <a href="queries.php" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
    <a href="queries-form.php?qid=<?php echo $queries->id;?>" class="btn btn-edit">Edit Query</a>
</header>

<div class="container">
	<div class="page">
		<h2>App</h2>
		<div class="info">
			<div class="info-items">
				<div class="c">App ID</div>
				<div class="v">#<?php echo $queries->id?></div>
			</div>
			<div class="info-items">
				<div class="c">Name</div>
				<div class="v"><?php echo $queries->name;?></div>
			</div>
			<div class="info-items">
				<div class="c">Description</div>
				<div class="v"><?php echo (!empty($queries->description)?$queries->description:'-');?></div>
			</div>
			<div class="info-items">
				<div class="c">Example (GET)</div>
				<div class="v"><a href="<?php echo DOMAIN.'/api'.($queries->type == 'report'?'/report.php':'/service.php');?>?qid=<?php echo $queries->id;?>&token=e961ce53991d6a45ceb36177ba56a434f<?php echo (!empty($queries->url_example)?$queries->url_example:'');?>"><?php echo DOMAIN.'/api'.($queries->type == 'report'?'/report.php':'/service.php');?>?qid=<?php echo $queries->id;?>&token=e961ce53991d6a45ceb36177ba56a434f<?php echo (!empty($queries->url_example)?$queries->url_example:'');?></a></div>
			</div>
		</div>
		<h2>Requests last 7 days</h2>
		<?php if(!empty($queries->description)){?>
		<p><?php echo $queries->description;?></p>
		<?php }?>

		<canvas class="chart" id="chart"></canvas>

		<h2>All activities by apps</h2>
		<div class="activity">
			<div class="activity-items -topic">
				<div class="id">#</div>
				<div class="info">App</div>
				<div class="time">Time</div>
				<div class="execution">Execution (s)</div>
			</div>
			<?php if(count($logs) > 0){?>
            <?php foreach ($logs as $var){ ?>
			<div class="activity-items">
				<div class="id"><?php echo $var['log_id'];?></div>
				<div class="info"><a href="app-detail.php?id=<?php echo $var['app_id'];?>"><i class="fa fa-cube" aria-hidden="true"></i><?php echo $var['app_name'];?></a></div>
				<div class="time"><?php echo $var['log_time'];?></div>
				<div class="execution"><?php echo $var['log_executed'];?></div>
			</div>
            <?php }?>
            <?php }else{?>
            <div class="empty">Empty log.</div>
            <?php }?>
		</div>
	</div>

	<input type="hidden" id="qid" value="<?php echo $queries->id;?>">
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/queries.graph.js"></script>
</body>
</html>
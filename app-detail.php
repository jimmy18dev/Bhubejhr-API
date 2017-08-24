<?php
include_once 'autoload.php';

$token_id = $_GET['id'];

$app = new App;
$app->get($token_id);

$log = new Log;
$logs = $log->listByAppID($app->id);
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
<title>APP : <?php echo $app->name;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
    <a href="index.php" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
    <div class="title"><strong>App ID : </strong><?php echo $app->id;?> | <?php echo $app->name;?></div>
    <a href="app-form.php?app_id=<?php echo $app->id;?>" class="btn btn-edit">Edit App</a>
</header>
<div class="container">
	<div class="page">
		<h2>Requests last 7 days</h2>
		<p>Token: <?php echo $app->key;?></p>
		<?php if(!empty($app->description)){?>
		<p><?php echo $app->description;?></p>
		<?php }?>
		
		<canvas class="chart" id="chart"></canvas>

		<h2>All activities by service / report</h2>
		<div class="activity">
			<div class="activity-items -topic">
				<div class="id">#</div>
				<div class="info">Service/Report</div>
				<div class="time">Time</div>
				<div class="execution">Execution (s)</div>
			</div>
			<?php if(count($logs) > 0){?>
            <?php foreach ($logs as $var) {?>
			<div class="activity-items">
				<div class="id"><?php echo $var['log_id'];?></div>
				<div class="info"><a href="queries-detail.php?qid=<?php echo $var['queries_id'];?>"><?php echo $var['queries_name'];?></a></div>
				<div class="time"><?php echo $var['log_time'];?></div>
				<div class="execution"><?php echo $var['log_executed'];?></div>
			</div>
            <?php }?>
            <?php }else{?>
            <div class="empty">Empty log.</div>
            <?php }?>
		</div>
	</div>

    <input type="hidden" id="app_id" value="<?php echo $app->id;?>">
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/app.graph.js"></script>
</body>
</html>
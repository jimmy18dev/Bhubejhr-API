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
	<div class="group">Get the full details of all the nodes, edges, and fields in the latest version of the Bhubejhr API.</div>
	<div class="group">
		<?php foreach ($apps as $var) {?>
		<a class="icon" href="reference-page.php?id=<?php echo $reference->id;?>&app=<?php echo $var['app_id'];?>"><?php echo $var['app_name'];?></a>
		<?php }?>
	</div>

	<?php if(!empty($app->id)){?>
	<p>Example: <a href="<?php echo DOMAIN;?>/<?php echo $reference->example?>&token=<?php echo $app->token;?>" target="_blank">OPEN API</a></p>
	<?php }?>

	<a href="reference-setting.php?id=<?php echo $reference->id;?>">Edit Reference</a>
</div>

<div class="container">
	<div class="reference">
		<h1>Name: <?php echo $reference->name;?></h1>
		<p>Desc: <?php echo $reference->description;?></p>

		<canvas id="chart"></canvas>
	</div>
</div>

<input type="text" id="ref_id" value="<?php echo $reference->id;?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/chart.min.js"></script>
<script type="text/javascript" src="js/reference.chart.js"></script>
</body>
</html>
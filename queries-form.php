<?php
include_once 'autoload.php';

$qid = $_GET['qid'];
$type = $_GET['type'];

$queries = new Queries;
$queries->get($qid);

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
<title>Queries Form</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<?php if(!empty($queries->id)){?>
	<a href="queries-detail.php?qid=<?php echo $queries->id;?>" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
	<?php }else{?>
	<a href="queries.php" class="logo"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</a>
	<?php }?>

	<div class="title">NEW QUERY</div>
</header>
<div class="container">
	<div class="form">
		<?php // $queries->createQuery(1,'Name','Description','Query','Example','Type'); ?>
		<?php if(!empty($queries->update_time)){?>
		<div class="info">Last updated <?php echo $queries->update_time;?></div>
		<?php }?>

		<?php $queries->toggleStatus($queries->id);?>

		<?php if(!empty($queries->id)){?>
		<div class="form-items">
			<div class="label">Status:</div>
			<div class="input">
				<span id="btn-toggle-status"><?php echo ($queries->status=='active'?'<i class="fa fa-toggle-on" aria-hidden="true"></i>':'<i class="fa fa-toggle-off" aria-hidden="true"></i>');?></span>
			</div>
		</div>
		<?php }?>

		<div class="form-items">
			<div class="label">App Name:</div>
			<div class="input">
				<input type="text" id="name" class="input-text" value="<?php echo $queries->name;?>">
			</div>
		</div>
		<div class="form-items <?php echo ($type == 'service'?'-hidden':'')?>">
			<div class="label">Query:</div>
			<div class="input">
				<textarea class="input-textarea" id="query"><?php echo $queries->query;?></textarea>
			</div>
		</div>
		<div class="form-items">
			<div class="label">Description:</div>
			<div class="input">
				<textarea class="input-textarea" id="description"><?php echo $queries->description;?></textarea>
			</div>
		</div>
		<div class="form-items">
			<div class="label">Example:</div>
			<div class="input">
				<input type="text" id="example" class="input-text" value="<?php echo $queries->url_example;?>">
			</div>
		</div>

		<div class="form-items">
			<div class="label"></div>
			<div class="input">
				<?php if(!empty($queries->id)){?>
				<div class="btn btn-delete" id="btn-delete">DELETE APP</div>
				<?php }?>
			
				<button class="btn" id="btn-submit"><?php echo (!empty($queries->id)?'SAVE':'CREATE');?></button>
			</div>
		</div>

		<input type="hidden" id="type" value="<?php echo $type;?>">
		<input type="hidden" id="qid" value="<?php echo $queries->id;?>">
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/queries.js"></script>
</body>
</html>
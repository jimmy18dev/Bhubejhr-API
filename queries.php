<?php
include_once 'autoload.php';
$queries = new Queries;
$allQueries = $queries->listAll();
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
<?php include'header.php';?>

<div class="container">
	<div class="list">

		<?php foreach ($allQueries as $var) {?>
		<a href="queries-detail.php?qid=<?php echo $var['queries_id'];?>" class="list-items">
			<div class="icon">
			<?php if($var['queries_type'] == 'report'){?>
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			<?php }else if($var['queries_type'] == 'service'){?>
			<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
			<?php }?>
			</div>
			<div class="detail">
				<div class="v"><?php echo $var['queries_name'];?><i class="fa fa-circle" aria-hidden="true"></i></div>
				<div class="c">
					<span>QID : <?php echo $var['queries_id'];?></span> · <span><?php echo $var['request_count'];?> Requests / day</span>
				</div>
			</div>		
		</a>
		<?php }?>
	</div>
</div>
</body>
</html>
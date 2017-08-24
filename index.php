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
		<?php foreach ($apps as $var) {?>
		<a href="app-detail.php?id=<?php echo $var['app_id'];?>" class="list-items">
			<div class="icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
			<div class="detail">
				<div class="v"><?php echo $var['app_name'];?><i class="fa fa-circle" aria-hidden="true"></i></div>
				<div class="c">
					<span>App ID : <?php echo $var['app_id'];?></span> · <span><?php echo $var['request_count'];?> Request/Day</span>
				</div>
			</div>		
		</a>
		<?php }?>
	</div>
</div>
<p>คำ
</p>
;asldfjsdfjk

</body>
</html>
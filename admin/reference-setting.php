<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}
$reference = new Reference;
$reference->get($_GET['id']);
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
<title>Apps | <?php echo SITENAME;?></title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>

<div class="progressbar" id="progressbar"></div>
<div class="navigation"></div>

<div class="container">
	<h2>Reference Setting</h2>
	<div class="setting">
		<div class="setting-items">
			<label for="name">Name</label>
			<input type="text" class="inputtext" id="name" value="<?php echo $reference->name;?>">
		</div>
		<div class="setting-items">
			<label for="desc">Description</label>
			<textarea class="inputtextarea" id="desc"><?php echo $reference->description;?></textarea>
		</div>
		<div class="setting-items">
			<label for="example">URL Example</label>
			<input type="text" class="inputtext" id="example" value="<?php echo $reference->example;?>">
		</div>

		<input type="text" id="ref_id" value="<?php echo $reference->id;?>">

		<div class="setting-control">
			<button class="btn-submit" id="btnUpdate">Update Reference</button>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.setting.js"></script>
</body>
</html>
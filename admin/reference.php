<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app = new app;
$reference = new Reference;

$category_id = $_GET['category'];

$references = $reference->listAll($category_id);
$category = $reference->listCategory();
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
<body class="white">
<?php include'header.php';?>

<div class="list">
	<div class="list-filter">
		<div class="group">
			<?php if($user->permission == 'admin'){?>
			<a href="reference.php?" class="link <?php echo (empty($category_id)?'-active':'');?>"></i>All</a>
			<?php }?>
			<?php foreach ($category as $var) {?>
			<a href="reference.php?category=<?php echo $var['id'];?>" class="link <?php echo ($category_id == $var['id']?'-active':'');?>"><?php echo $var['name'];?><?php echo ($var['total'] > 0?' ('.$var['total'].')':'');?></a>
			<?php }?>
		</div>
		<a href="reference-setting.php" class="btn btn-create"><i class="fa fa-plus-circle" aria-hidden="true"></i>Create Reference</a>
	</div>
	<?php if(count($references) > 0){?>
	<div class="reference" id="reference">
		<?php foreach ($references as $var) {?>
		<a href="reference-page.php?id=<?php echo $var['ref_id'];?>" class="ref-items">
			<span class="method <?php echo $var['ref_method'];?>"><?php echo strtoupper($var['ref_method']);?></span>
			<div class="detail">
				<h2><?php echo $var['ref_name'];?></h2>
				<p class="id">Ref: <?php echo $var['ref_id'];?></p>
				<?php if(!empty($var['ref_description'])){?>
				<p><?php echo $var['ref_description'];?></p>
				<?php }?>
			</div>			
		</a>
		<?php }?>
	</div>
	<?php }else{?>
	<div class="empty">Items not Found!</div>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
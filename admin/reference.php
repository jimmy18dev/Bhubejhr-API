<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app = new app;
$reference = new Reference;

$category_id 	= $_GET['category'];
$references 	= $reference->listAll($category_id);
$category 		= $reference->listCategory();
$currentPage 	= 'references';

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
<div class="container">
	<div class="list-filter">
		<?php if($user->permission == 'admin'){?>
		<a href="reference.php?" class="<?php echo (empty($category_id)?'-active':'');?>"></i><i class="fa fa-folder" aria-hidden="true"></i>All</a>
		<?php }?>
		<?php foreach ($category as $var) {?>
		<a href="reference.php?category=<?php echo $var['id'];?>" class="<?php echo ($category_id == $var['id']?'-active':'');?>"><i class="fa fa-folder" aria-hidden="true"></i><?php echo $var['name'];?><?php echo ($var['total'] > 0?' ('.$var['total'].')':'');?></a>
		<?php }?>
		<a href="reference-setting.php" class="btn-create"><i class="fa fa-plus-circle" aria-hidden="true"></i>Create Reference</a>
	</div>
	<?php if(count($references) > 0){?>
	<div class="reference" id="reference">
		<?php foreach ($references as $var) {?>
		<a href="reference-page.php?id=<?php echo $var['ref_id'];?>" class="ref-items">
			<h3><?php echo $var['ref_name'];?></h3>
			<p class="mini"><span>#<?php echo $var['ref_id'];?></span><span class="method <?php echo $var['ref_method'];?>"><?php echo strtoupper($var['ref_method']);?></span></p>

			<?php if(!empty($var['ref_description'])){?>
			<p><?php echo $var['ref_description'];?></p>
			<?php }?>	
		</a>
		<?php }?>
	</div>
	<?php }else{?>
	<div class="notfound">Items not Found!</div>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
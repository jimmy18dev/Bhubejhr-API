<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}
$reference = new Reference;
$category = $reference->listCategory();
$reference->get($_GET['id']);
$currentPage = 'reference';
$tab = 'setting';
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
<?php include_once 'header.php';?>
<?php include_once 'pagehead.reference.php';?>
<div class="container">
	<h2>Setting</h2>
	<div class="form">
		<div class="form-items">
			<label for="name">Name</label>
			<input type="text" class="inputtext" id="name" value="<?php echo $reference->name;?>">
		</div>
		<div class="form-items">
			<label for="desc">Description</label>
			<textarea class="inputtextarea" id="desc"><?php echo $reference->description;?></textarea>
		</div>
		<div class="form-items">
			<label for="example">URL Example</label>
			<input type="text" class="inputtext" id="example" value="<?php echo $reference->example;?>">
		</div>

		<div class="form-items" id="referenceMethod">
			<label>Method:</label>
			<div class="selection">
				<div class="items method-items" id="method-items-get" data-method="get">GET</div>
				<div class="items method-items" id="method-items-post" data-method="post">POST</div>
			</div>
		</div>
		<div class="form-items" id="referenceType">
			<label>API Type::</label>
			<div class="selection">
				<div class="items type-items" id="type-items-get" data-type="get">GET</div>
				<div class="items type-items" id="type-items-list" data-type="list">LIST</div>
				<div class="items type-items" id="type-items-edit" data-type="edit">EDIT</div>
				<div class="items type-items" id="type-items-create" data-type="create">CREATE</div>
				<div class="items type-items" id="type-items-delete" data-type="delete">DELETE</div>
			</div>
		</div>
		<div class="form-items" id="referenceCategory">
			<label>Category:</label>
			<div class="selection">
				<?php foreach ($category as $var) {?>
					<div class="items category-items" id="category-items-<?php echo $var['id'];?>" data-id="<?php echo $var['id'];?>"><?php echo $var['name'];?></div>
				<?php } ?>
			</div>
		</div>
		<input type="hidden" id="category" value="<?php echo $reference->category_id;?>">
		<input type="hidden" id="type" value="<?php echo $reference->type;?>">
		<input type="hidden" id="method" value="<?php echo $reference->method;?>">
		<input type="hidden" id="ref_id" value="<?php echo $reference->id;?>">

		<div class="form-control">
			<?php if(empty($reference->id)){?>
			<button class="btn btn-submit" id="btnCreate">New Reference</button>
			<?php }else{?>
			<button class="btn btn-submit" id="btnUpdate">Update Reference</button>
			<?php }?>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
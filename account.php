<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app = new app;
$reference = new Reference;
$references = $reference->listAll();
$category = $reference->listCategory();
$currentPage = 'account';

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
<title>Account | Bhubejhr API</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>

<div class="container">
	<div class="references" id="reference">
		<?php foreach ($references as $var) {?>
		<div class="ref-items" id="reference<?php echo $var['ref_id'];?>" data-id="<?php echo $var['ref_id'];?>">
			<div class="detail">
				<a href="app-detail.php?id=<?php echo $var['ref_id'];?>" class="name"><span class="method"><?php echo $var['ref_method'];?></span><span class="method"><?php echo $var['ref_category_name']?></span><?php echo $var['ref_name'];?> #<?php echo $var['ref_id'];?></a>
				<div class="desc"><?php echo $var['ref_description'];?>
					<span>Last updated <?php echo $var['ref_create_time'];?></span>
					<span>by <?php echo $var['ref_user_name'];?></span>
				</div>
			</div>

			<div class="btn-edit-reference"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
		</div>
		<?php }?>
	</div>
</div>

<div class="ref-navigation">
	<div class="group">
		<div id="btnCreateReference" class="btn">Create Account (1/10)</div>
	</div>
</div>

<div class="dialog" id="createReferenceDialog">
	<div class="head">
		<div class="text">Create new Reference</div>
		<div class="btn" id="btnCloseCreateReference"><i class="fa fa-close" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<input type="text" id="reference_name" class="inputtext" placeholder="Reference name...">
		<textarea class="textarea" id="reference_description" placeholder="Description..."></textarea>
		<div class="selection" id="referenceMethod">
			<div class="caption">Method:</div>
			<div class="items method-items" id="method-items-get" data-method="get">GET</div>
			<div class="items method-items" id="method-items-post" data-method="post">POST</div>
		</div>
		<div class="selection" id="referenceType">
			<div class="caption">API TYPE:</div>
			<div class="items type-items" id="type-items-get" data-type="get">GET</div>
			<div class="items type-items" id="type-items-list" data-type="list">LIST</div>
			<div class="items type-items" id="type-items-edit" data-type="edit">EDIT</div>
			<div class="items type-items" id="type-items-create" data-type="create">CREATE</div>
			<div class="items type-items" id="type-items-delete" data-type="delete">DELETE</div>
		</div>
		<div class="selection" id="referenceCategory">
			<div class="caption">Category:</div>
			<?php foreach ($category as $var) {?>
				<div class="items category-items" id="category-items-<?php echo $var['id'];?>" data-id="<?php echo $var['id'];?>"><?php echo $var['name'];?></div>
			<?php } ?>
		</div>
		<input type="hidden" id="reference_id">
		<input type="hidden" id="reference_category" value="3">
		<input type="hidden" id="reference_type">
		<input type="hidden" id="reference_method">
	</div>
	<div class="control">
		<div class="btn btn-delete" id="btnDeleteReference">DELETE</div>
		<div class="btn btn-submit" id="btnSubmitCreateReference">CREATE</div>
	</div>
</div>
<div class="filter" id="createDialogFilter"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/reference.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
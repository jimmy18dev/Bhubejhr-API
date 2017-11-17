<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location:login.php');
	die();
}

$signature 		= new Signature;
$accounts 		= $account->listAll($user->id);
$currentPage 	= 'account';

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
	<div class="references" id="account">
		<?php foreach ($accounts as $var) {?>
		<div class="account-items" data-account="<?php echo $var['id'];?>">
			<div class="icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
			<div class="detail">
				<a href="#" class="title"><?php echo $var['name'];?></a>
				<div class="desc"><?php echo $var['username'];?></div>
			</div>

			<?php if($var['status'] != 'active'){?>
			<div class="status btn-approve">Approve</div>
			<?php }else{?>
			<div class="status btn-disable">Active</div>
			<?php }?>

			<?php if($var['permission']!='admin'){?>
			<div class="status btn-setadmin">Set Admin</div>
			<?php }?>
		</div>
		<?php }?>
	</div>
</div>

<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('account',SECRET_KEY);?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/account.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>
<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$signature 	= new Signature;
$account = new Account;
$accounts = $account->listAll($user->id);
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
		<?php foreach ($accounts as $var) {?>
		<div class="account-items" id="account<?php echo $var['ref_id'];?>">
			<div class="icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
			<div class="detail">
				<a href="#" class="title"><?php echo $var['name'];?></a>
				<div class="desc"><?php echo $var['username'];?></div>
			</div>

			<div class="btn-edit"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
		</div>
		<?php }?>
	</div>
</div>

<div class="ref-navigation">
	<div class="group">
		<div id="btnCreateAccount" class="btn">Create Account</div>
	</div>
</div>

<div class="dialog" id="createAccountDialog">
	<div class="head">
		<div class="icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
		<div class="text">Create New Account</div>
		<div class="btn" id="btnCloseCreateAccount"><i class="fa fa-close" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<label for="displayname">Name display</label>
		<input type="text" id="displayname" class="inputtext" placeholder="Fullname">
		<label for="username">Username</label>
		<input type="text" id="username" class="inputtext" placeholder="Username">
		<label for="password">Password (Default)</label>
		<input type="text" id="password" class="inputtext" placeholder="Password" value="1234" disabled>

		<div class="selection" id="accountPermission">
			<div class="caption">User Permission:</div>
			<div class="items permission-items" id="permission-items-admin" data-permission="admin">Administrator</div>
			<div class="items permission-items -active" id="permission-items-guest" data-permission="guest">Guest</div>
		</div>

		<input type="hidden" id="account_permission" value="guest">
	</div>
	<div class="control">
		<div class="btn btn-submit" id="btnSubmitCreateAccount">CREATE</div>
	</div>
</div>
<div class="filter" id="createAccountFilter"></div>
<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('account',SECRET_KEY);?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/account.js"></script>
</body>
</html>
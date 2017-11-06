<?php
include_once 'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/login.php');
	die();
}

$app = new app;
$reference = new Reference;
$signature 	= new Signature;
$currentPage = 'profile';

$apps = $app->listAll($user->id);

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
<title>Profile | Bhubejhr API</title>

<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include'header.php';?>

<div class="container">
	<?php if($user->status == 'active'){?>
	<div class="apps-list" id="apps">
		<?php foreach ($apps as $var) {?>
		<div class="app-items" id="app<?php echo $var['app_id'];?>" data-id="<?php echo $var['app_id'];?>">
			<div class="btn-edit-app"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></div>
			<a class="icon" href="app.php?id=<?php echo $var['app_id'];?>"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></a>
			<div class="detail">
				<a href="app.php?id=<?php echo $var['app_id'];?>" class="name"><?php echo $var['app_name'];?></a>
				<div class="info"><?php echo (!empty($var['app_description'])?$var['app_description']:'Description');?></div>
			</div>
			<div class="stat" title="<?php echo number_format($var['request_count']);?> Requests on this day."><?php echo number_format($var['request_count']);?></div>
		</div>
		<?php }?>

		<?php if($user->total_app < $user->app_limit && $user->status == 'active'){?>
		<div class="app-items btn-new-app" id="btnCreateApp">Create a <strong>new App</strong></div>
		<?php }?>
	</div>
	<?php }else{?>
	<div class="approve-waiting">
		<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
		<p>Your access to the <?php echo SITENAME;?> is waiting for Administrator approval!</p>
	</div>
	<?php }?>
</div>

<div class="navigation">
	<div class="group profile">
		<div class="name"><?php echo $user->name;?></div>
		<div class="info-items">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<div class="detail"><strong>Email</strong> mrjimmy18@gmail.com</div>
		</div>
		<div class="info-items">
			<i class="fa fa-suitcase" aria-hidden="true"></i>
			<div class="detail"><strong>Company</strong> Chao Phya Abhaibhubejhr Hospital</div>
		</div>
		<div class="info-items">
			<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
			<div class="detail">You can have <strong><?php echo $user->total_app;?> of <?php echo $user->app_limit;?> apps.</strong></div>
		</div>
	</div>
	<div class="group">
		<div class="btn" id="btnChangePassword"><i class="fa fa-key" aria-hidden="true"></i>Change Password</div>
		<a href="logout.php" class="btn btn-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
	</div>
</div>

<div class="dialog" id="editProfileDialog">
	<div class="head">
		<div class="icon"><i class="fa fa-address-book" aria-hidden="true"></i></div>
		<div class="text">Edit Profile</div>
		<div class="btn" id="btnCloseEditProfile"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<label for="displayname">Name Display</label>
		<input type="text" id="displayname" class="inputtext" value="<?php echo $user->name;?>">
		<label for="username">Username</label>
		<input type="text" id="username" class="inputtext" value="<?php echo $user->username;?>">
	</div>
	<div class="control">
		<div class="btn btn-submit" id="btnSubmiteditProfile">Update Profile</div>
	</div>
</div>
<div class="filter" id="editProfileFilter"></div>

<div class="dialog" id="changePasswordDialog">
	<div class="head">
		<div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
		<div class="text">Change Password</div>
		<div class="btn" id="btnCloseChangePassword"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<label for="oldpassword">Current Password</label>
		<input type="password" id="oldpassword" class="inputtext">
		<label for="newpassword">New Password</label>
		<input type="password" id="newpassword" class="inputtext">
		<label for="renewpassword">New Password Again!</label>
		<input type="password" id="renewpassword" class="inputtext">
	</div>
	<div class="control">
		<div class="btn btn-submit" id="btnSubmitChangePassword">Change Password</div>
	</div>
</div>
<div class="filter" id="changePasswordFilter"></div>
<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('profile',SECRET_KEY);?>">

<div class="dialog" id="createAppDialog">
	<div class="head">
		<div class="text">Create a New App ID</div>
		<div class="btn" id="btnCloseCreateApp"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>
	<div class="input">
		<label for="app_name">App Name</label>
		<input type="text" id="app_name" class="inputtext" placeholder="The name of your App ID">
		<label for="app_description">App Description</label>
		<textarea class="textarea" id="app_description"></textarea>
		<input type="hidden" id="app_id">
	</div>
	<div class="control">
		<div class="btn btn-delete" id="btnDeleteApp">Delete</div>
		<div class="btn btn-submit" id="btnSubmitCreateApp">Create App ID</div>
	</div>
</div>
<div class="filter" id="createDialogFilter"></div>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
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
	<div class="content">
		<div class="profile-items">
			<div class="c">Display Name</div>
			<div class="v"><?php echo $user->name;?></div>
		</div>
		<div class="profile-items">
			<div class="c">Username</div>
			<div class="v"><?php echo $user->username;?></div>
		</div>
		<div class="profile-items">
			<div class="c">User ID</div>
			<div class="v"><?php echo $user->id;?></div>
		</div>
		<div class="profile-items">
			<div class="c">Registered</div>
			<div class="v"><?php echo $user->register_time;?></div>
			<div class="m"><?php echo $user->ip;?></div>
		</div>
		<div class="profile-items">
			<div class="c">Status</div>
			<div class="v"><?php echo $user->status;?></div>
		</div>
		<div class="profile-items">
			<div class="c">Verify by</div>
			<div class="v"><?php echo $user->owner_id;?></div>
		</div>
	</div>
</div>

<div class="navigation">
	<div class="group">
		<div class="btn" id="btnEditProfile">Edit Profile</div>
	</div>
	<div class="note">Last update <?php echo $user->edit_time;?> and You can manage profile infomation click <strong>Edit Profile</strong> button.</div>
	<div class="group">
		<div class="items" id="btnChangePassword">Change Password</div>
		<a href="logout.php" class="items btn-logout">Logout</a>
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

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>

<!-- Hi Jame Welcome to JobHot -->
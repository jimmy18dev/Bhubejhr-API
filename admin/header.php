<header class="header">
	<a href="index.php" class="logo-img"><img src="image/logo.png" alt="logo"></a>
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>"><?php echo SITENAME;?></a>

	<?php if($user_online){?>
	<div class="nav btn-profile" id="btnProfile">
		<?php echo $user->name;?><i class="fa fa-angle-down" aria-hidden="true"></i>

		<div class="more-menu" id="menuProfile">
			<div class="arrow-up"></div>
			<a href="profile-setting.php"><i class="fa fa-user" aria-hidden="true"></i>Profile Setting</a>
			<a href="profile-password.php"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a>
			<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
		</div>
	</div>

	<a href="reference.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">API References</a>
	<?php if($user->permission == 'admin'){?>
	<a href="accounts.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Members<?php echo ($account->newmember>0?' ('.$account->newmember.')':'');?></a>
	<?php }?>
	<?php }else{?>
	<a href="register.php" class="nav <?php echo ($currentPage == 'register'?'-active':'');?>">Register</a>
	<a href="login.php" class="nav <?php echo ($currentPage == 'login'?'-active':'');?>">Login</a>
	<?php }?>
</header>

<span class="bar-alert" id="db_status">ONLINE</span>	
<div class="filter" id="filterProfile"></div>
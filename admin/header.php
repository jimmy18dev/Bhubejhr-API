<header class="header">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>"><img src="image/logo.png" alt="logo"><span><?php echo SITENAME;?></span></a>

	<?php if($user_online){?>
	<div class="nav btn-profile" id="btnProfile">
		<?php echo $user->name;?><i class="fa fa-angle-down" aria-hidden="true"></i>

		<div class="more-menu" id="menuProfile">
			<div class="arrow-up"></div>
			<a href="profile-setting.php"><i class="fa fa-user" aria-hidden="true"></i>Profile Settings</a>
			<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
		</div>
	</div>

	<?php if($user->status == 'active'){?>
	<a href="reference.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">API References</a>
	<?php }?>
	
	<?php if($user->permission == 'admin' && false){?>
	<a href="accounts.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Members<?php echo ($account->newmember>0?' ('.$account->newmember.')':'');?></a>
	<?php }?>
	<?php }?>
</header>

<span class="bar-alert" id="db_status"></span>	
<div class="filter" id="filterProfile"></div>
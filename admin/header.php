<header class="header">
	<?php if($currentPage == 'index' || $currentPage == 'references'){?>
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>"><img src="image/logo.png" alt="logo"><span><?php echo SITENAME;?></span></a>
	<?php }else if($currentPage == 'reference'){?>
	<a href="reference.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
	<?php }else{?>
	<a href="index.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
	<?php }?>

	<?php if($user_online){?>
	<div class="nav btn-profile" id="btnProfile">
		<span class="name"><?php echo $user->name;?></span><i class="fa fa-angle-down" aria-hidden="true"></i>

		<div class="more-menu" id="menuProfile">
			<div class="arrow-up"></div>
			<a href="index.php"><i class="fa fa-id-badge" aria-hidden="true"></i>Your Apps</a>
			<a href="profile-setting.php"><i class="fa fa-user" aria-hidden="true"></i>Profile Settings</a>
			<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
		</div>
	</div>
	
	<?php if($user->permission == 'admin' && false){?>
	<a href="accounts.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Members<?php echo ($account->newmember>0?' ('.$account->newmember.')':'');?></a>
	<?php }?>
	<?php }?>
</header>

<div class="bar-alert" id="db_status"></div>	
<div class="filter" id="filterProfile"></div>
<div class="progressbar" id="progressbar"></div>
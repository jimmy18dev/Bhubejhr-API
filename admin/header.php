<header class="header">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>">
		<span><?php echo SITENAME;?></span>
		<span class="status" id="db_status">ONLINE</span>	
		</a>
	<a href="apps.php" class="nav <?php echo ($currentPage == 'apps'?'-active':'');?>">My Apps</a>
	<!-- <a href="references.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">References</a> -->

	<?php if($user->permission == 'admin'){?>
	<a href="accounts.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Accounts</a>
	<?php }?>

	<a href="profile.php" class="nav right <?php echo ($currentPage == 'profile'?'-active':'');?>"><?php echo $user->name;?></a>
</header>
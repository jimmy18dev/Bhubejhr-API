<header class="header">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>">
		<span><?php echo SITENAME;?></span>
		<span class="status" id="db_status">ONLINE</span>	
	</a>

	<a href="profile.php" class="nav <?php echo ($currentPage == 'profile'?'-active':'');?>"><?php echo $user->name;?></a>
	<a href="references.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">API References</a>
	<?php if($user->permission == 'admin'){?>
	<a href="accounts.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Members<?php echo ($account->newmember>0?' ('.$account->newmember.')':'');?></a>
	<?php }?>
</header>
<header class="header">
	<a href="index.php" class="logo" title="Version <?php echo VERSION;?>"><i class="fa fa-cube" aria-hidden="true"></i><?php echo SITENAME;?></a>
	<a href="references.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">References</a>

	<!-- <a href="http://jhos.api/service.php?token=e90dab3ba52d42dbd133c416c5293f0ad&action=list_patient&qid=1" class="nav btn-api" target="_blank">Open API<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> -->

	<a href="profile.php" class="nav right <?php echo ($currentPage == 'profile'?'-active':'');?>"><i class="fa fa-user" aria-hidden="true"></i><?php echo $user->name;?></a>
	<a href="apps.php" class="nav right <?php echo ($currentPage == 'apps'?'-active':'');?>">My Apps</a>
	<?php if($user->permission == 'admin'){?>
	<a href="accounts.php" class="nav right <?php echo ($currentPage == 'account'?'-active':'');?>">Accounts</a>
	<?php }?>
</header>
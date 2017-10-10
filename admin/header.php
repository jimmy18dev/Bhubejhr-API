<header class="header">
	<a href="index.php" class="logo"><i class="fa fa-cube" aria-hidden="true"></i>Bhubejhr API</a>
	
	<a href="index.php" class="nav <?php echo ($currentPage == 'apps'?'-active':'');?>">Apps</a>
	<a href="reference.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">References</a>

	<?php if($user->permission == 'admin'){?>
	<a href="account.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Account</a>
	<?php }?>

	<!-- <a href="http://jhos.api/service.php?token=e90dab3ba52d42dbd133c416c5293f0ad&action=list_patient&qid=1" class="nav btn-api" target="_blank">Open API<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> -->

	<a href="profile.php" class="nav btn-profile <?php echo ($currentPage == 'profile'?'-active':'');?>"><?php echo $user->name;?></a>
</header>
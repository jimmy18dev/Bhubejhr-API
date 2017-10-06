<header class="header">
	<a href="index.php" class="logo"><i class="fa fa-cube" aria-hidden="true"></i>Bhubejhr API</a>
	
	<a href="index.php" class="nav <?php echo ($currentPage == 'apps'?'-active':'');?>">Apps (<?php echo $app->count();?>)</a>
	<!-- <a href="activities.php" class="nav <?php echo ($currentPage == 'activities'?'-active':'');?>">Activities</a> -->
	<a href="reference.php" class="nav <?php echo ($currentPage == 'reference'?'-active':'');?>">API Reference (<?php echo $reference->count();?>)</a>
	<a href="account.php" class="nav <?php echo ($currentPage == 'account'?'-active':'');?>">Account</a>
	<!-- <a href="queries.php" class="nav <?php echo ($currentPage == 'queries'?'-active':'');?>">Queries</a> -->

	<a href="http://jhos.api/service.php?token=e90dab3ba52d42dbd133c416c5293f0ad&action=list_patient&qid=1" class="nav" target="_blank">Open API<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>

	<div class="profile"><?php echo $user->name;?><i class="fa fa-caret-down" aria-hidden="true"></i></div>

	<!-- <div class="btn" id="btnCreateApp"><i class="fa fa-plus-circle" aria-hidden="true"></i>New App</div> -->
</header>
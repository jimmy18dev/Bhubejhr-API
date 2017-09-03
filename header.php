<header class="header">
	<a href="index.php" class="logo">
		<img src="image/logo.png" alt="">
		<span class="c">JHOS API</span>
	</a>
	<a href="index.php" class="nav <?php echo ($currentPage == 'apps'?'-active':'');?>">Apps</a>
	<a href="queries.php" class="nav <?php echo ($currentPage == 'queries'?'-active':'');?>">Queries</a>

	<a href="http://jhos.api/service.php?token=e90dab3ba52d42dbd133c416c5293f0ad&action=list_patient&qid=1" class="btn" target="_blank">OPEN API TEST</a>

	<?php if($currentPage == 'apps'){?>
	<a href="app-form.php" class="btn">CREATE APP</a>
	<?php }else if($currentPage == 'queries'){?>
	<a href="queries-form.php?type=report" class="btn">NEW REPORT</a>
	<a href="queries-form.php?type=service" class="btn">NEW SERVICE</a>
	<?php }?>
</header>
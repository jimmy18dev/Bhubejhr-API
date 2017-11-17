<div class="pagehead">
	<div class="head">
		<h1><?php echo $app->name;?></h1>

		<?php if(!empty($app->description)){?>
		<p><?php echo $app->description;?></p>
		<?php }?>
	</div>

	<div class="tab">
		<a href="app.php?id=<?php echo $app->id;?>" class="tab-items <?php echo ($tab == 'home'?'-active':'');?>"><i class="fa fa-hdd-o" aria-hidden="true"></i>Today</a>
		<a href="app-analytics.php?id=<?php echo $app->id;?>" class="tab-items <?php echo ($tab == 'analytics'?'-active':'');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>Analytics</a>
		<a href="app-token.php?id=<?php echo $app->id;?>" class="tab-items <?php echo ($tab == 'token'?'-active':'');?>"><i class="fa fa-key" aria-hidden="true"></i>Token</a>
		<a href="app-setting.php?id=<?php echo $app->id;?>" class="tab-items -right <?php echo ($tab == 'setting'?'-active':'');?>"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a>
	</div>
</div>
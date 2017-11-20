<div class="pagehead">
	<a href="reference.php" class="btn-back"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a>
	<?php if(!empty($reference->id)){?>
	<div class="head">
		<h1><?php echo $reference->name;?></h1>
		<?php if(!empty($reference->description)){?>
		<p><?php echo $reference->description;?></p>
		<?php }?>
	</div>
	<div class="tab">
		<a href="reference-page.php?id=<?php echo $reference->id;?>" class="tab-items <?php echo ($tab == 'home'?'-active':'');?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Detail</span></a>
		<a href="reference-analytics.php?id=<?php echo $reference->id;?>" class="tab-items <?php echo ($tab == 'analytics'?'-active':'');?>"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Analytics</span></a>
		<a href="reference-setting.php?id=<?php echo $reference->id;?>" class="tab-items -right <?php echo ($tab == 'setting'?'-active':'');?>"><i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span></a>
	</div>
	<?php }else{?>
	<div class="head">
		<h1>Create New Reference</h1>
		<p>API reference with code examples</p>
	</div>
	<?php }?>
</div>
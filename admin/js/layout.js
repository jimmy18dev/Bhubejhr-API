$(document).ready(function(){
	$btnProfile 	= $('#btnProfile');
	$menuProfile 	= $('#menuProfile');
	$filterProfile 	= $('#filterProfile');

	$btnProfile.click(function(){
		$filterProfile.fadeIn(100);
		$menuProfile.fadeIn(300);

		$filterProfile.click(function(){
			$menuProfile.fadeOut(100);
			$filterProfile.fadeOut(300);
		});
	});
});
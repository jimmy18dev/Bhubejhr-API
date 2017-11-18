$(document).ready(function(){
	$btnProfile 	= $('#btnProfile');
	$menuProfile 	= $('#menuProfile');
	$filterProfile 	= $('#filterProfile');
	$progressbar 	= $('#progressbar');

	$btnProfile.click(function(){
		$filterProfile.fadeIn(100);
		$menuProfile.fadeIn(300);

		$filterProfile.click(function(){
			$menuProfile.fadeOut(100);
			$filterProfile.fadeOut(300);
		});
	});

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'100%'},500);
	$progressbar.fadeOut();
});

function databaseChecking(){
	$dbStatus.html('JHOS Connection Checking<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');

	$.ajax({
		url         :'database_checking.php',
		cache       :false,
	    dataType    :"json",
	    type        :"POST",
	    error: function (request, status, error) {
	    	console.log("Request Error",request.responseText);
	    }
	}).done(function(data){
	    console.log(data.connection);

	    if(data.connection){
	    	$dbStatus.removeClass('-active');
	    	$dbStatus.addClass('-hidden');
	    }else{
	    	$dbStatus.addClass('-active');
	    	$dbStatus.html('JHOS Database is Offline<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
	    	setTimeout(databaseChecking,60000);
	    }
	});
}
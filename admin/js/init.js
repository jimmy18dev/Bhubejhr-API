$(document).ready(function(){
	$btnProfile 	= $('#btnProfile');
	$menuProfile 	= $('#menuProfile');
	$filterProfile 	= $('#filterProfile');
	$progressbar 	= $('#progressbar');

	$(document).click(function(e) {
		var current_id = e.target.id;
		
		if(current_id == '' && e.target.offsetParent != null){
			current_id = e.target.offsetParent.id;
		}

		if(current_id != 'btnProfile'){
			$menuProfile.removeClass('open');
		}
	});

	$btnProfile.click(function(){
		$menuProfile.addClass('open');
	});

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'100%'},500);
	$progressbar.fadeOut();
});

function databaseChecking(){
	$dbStatus.html('API Connection Checking<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');

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
	    	$dbStatus.html('API Database lost connection<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
	    	setTimeout(databaseChecking,60000);
	    }
	});
}
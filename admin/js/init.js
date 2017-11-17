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

	$appExample = $('#appExample');

	$appExample.change(function(){
		var ref_id = $('#ref_id').val();
		var app_id = $(this).val();
		var url_example = $('#url_example').val();

		$.ajax({
	        url         :'api.app.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"GET",
	        data:{
	            request 	:'get',
	            app_id		:app_id,
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	            $progressbar.animate({width:'0%'},500);
	        }
	    }).done(function(data){
	    	var token = '&token='+data.items.app_token;
	    	$('#urlExample').val(url_example+token);
	    });

		// window.location = 'reference-page.php?id='+ref_id+'&app='+app_id;
	});
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
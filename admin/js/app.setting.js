var api_url = 'api.app.php';

$(document).ready(function(){
	$btnUpdate 		= $('#btnUpdate');
	$progressbar 	= $('#progressbar');

	$btnUpdate.click(function(){

		var app_id 		= $('#app_id').val();
		var app_name 	= $('#app_name').val();
		var app_desc 	= $('#app_desc').val();

		if(app_name == '') return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'update',
	            app_id		:app_id,
	            app_name	:app_name,
	            app_desc	:app_desc,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	            $progressbar.animate({width:'0%'},500);
	        }
	    }).done(function(data){
	    	console.log(data);
	    	$progressbar.animate({width:'100%'},500);

	    	setTimeout(function(){
	    		$progressbar.fadeOut();
	    	}, 1000);
	    });		
	});
});
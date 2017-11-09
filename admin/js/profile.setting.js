var api_url = 'api.user.php';

$(document).ready(function(){
	$btnUpdate 		= $('#btnUpdate');
	$progressbar 	= $('#progressbar');

	$btnUpdate.click(function(){

		var name 		= $('#name').val();
		var username 		= $('#username').val();
		var email		= $('#email').val();
		var position 		= $('#position').val();
		var company 		= $('#company').val();

		if(name == '') return false;

		$progressbar.fadeIn(300);
		$progressbar.width('0%');
		$progressbar.animate({width:'70%'},500);

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'edit_profile',
	            name:name,
	            username:username,
	            email:email,
	            company:company,
	            position:position
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
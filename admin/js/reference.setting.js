var api_url = 'api.reference.php';

$(document).ready(function(){
	$btnUpdate 		= $('#btnUpdate');
	$progressbar 	= $('#progressbar');

	$btnUpdate.click(function(){
		var ref_id 		= $('#ref_id').val();
		var name 		= $('#name').val();
		var desc 		= $('#desc').val();
		var example		= $('#example').val();

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
	            request 	:'edit',
	            name:name,
	            desc:desc,
	            example:example,
	            ref_id:ref_id
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
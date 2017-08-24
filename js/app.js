$(document).ready(function(){

	$('#btn-toggle-status').click(function(){
		var app_id 		= $('#app_id').val();

		$.ajax({
	        url         :'api.app.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'toggle_status',
	            app_id		:app_id,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error");
	        }
	    }).done(function(data){
	    	location.reload();
	    });
	});

	$('#btn-delete').click(function(){
		var app_id 		= $('#app_id').val();

		if(!confirm('Are you sure you want to delete this App?')){ return false; }

		$.ajax({
	        url         :'api.app.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'delete',
	            app_id		:app_id,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error");
	        }
	    }).done(function(data){

	        console.log(data);

	        setTimeout(function(){
	        	window.location = 'index.php#app_deleted';
	        },1000);
	    });
	});

	$('#btn-submit').click(function(){
		var app_id 		= $('#app_id').val();
		var name 		= $('#name').val();
		var description = $('#description').val();

		if(name == ''){
			alert('App name is empty!');
			return false;
		}

		$('#btn-submit').html('CREATING...');

		$.ajax({
	        url         :'api.app.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'submit',
	            name		:name,
	            description	:description,
	            app_id		:app_id,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error");
	        }
	    }).done(function(data){

	        console.log(data);

	        if(data.return != 0){
	        	setTimeout(function(){
	        		window.location = 'app-detail.php?id='+data.return;
	        	},1000);
	        }else{
	        	alert('App name is already!');
	        	$('#btn-submit').html('CREATE');
	        	$('#name').focus();
	        }

	    });
	});
});
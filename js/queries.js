$(document).ready(function(){
	
	$('#btn-toggle-status').click(function(){
		var qid 		= $('#qid').val();

		$.ajax({
	        url         :'api.queries.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'toggle_status',
	            qid		:qid,
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
		var qid 		= $('#qid').val();

		if(!confirm('Are you sure you want to delete this Queries?')){ return false; }

		$.ajax({
	        url         :'api.queries.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'delete',
	            qid		:qid,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error");
	        }
	    }).done(function(data){

	        console.log(data);

	        setTimeout(function(){
	        	window.location = 'queries.php#query_deleted';
	        },1000);
	    });
	});

	$('#btn-submit').click(function(){
		var qid 		= $('#qid').val();
		var name 		= $('#name').val();
		var description = $('#description').val();
		var query 		= $('#query').val();
		var example 	= $('#example').val();
		var type = $('#type').val();

		$.ajax({
	        url         :'api.queries.php',
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            action      :'submit',
	            name		:name,
	            description	:description,
	            qid			:qid,
	            query		:query,
	            example		:example,
	            type 		:type,
	            // sign 		:sign
	        },
	        error: function (request, status, error) {
	            console.log("Request Error");
	        }
	    }).done(function(data){

	        console.log(data);

	        if(data.return != 0){
	        	console.log('Device created!');
	        	setTimeout(function(){
	        		window.location = 'queries-detail.php?qid='+data.return;
	        	},1000);
	        }else{
	        	$('#btn-save').addClass('-completed');
	        	$('#btn-save').html('บันทึกแล้ว<i class="fa fa-check" aria-hidden="true"></i>');
	        	$('#btn-nav').addClass('-show');
	        }

	    });
	});
});
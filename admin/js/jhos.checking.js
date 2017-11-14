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
	    	$dbStatus.html('JHOS DATABASE STATUS OFFLINE!');
	    	setTimeout(databaseChecking,60000);
	    }
	});
}
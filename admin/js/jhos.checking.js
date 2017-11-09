function databaseChecking(){
	$dbStatus.html('CHECKING...');

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
	    	$dbStatus.addClass('-active');
	    	$dbStatus.html('ONLINE');
	    }else{
	    	$dbStatus.removeClass('-active');
	    	$dbStatus.html('OFFLINE');
	    	setTimeout(databaseChecking,60000);
	    }
	});
}
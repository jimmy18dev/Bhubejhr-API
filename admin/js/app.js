var api_url = 'api.app.php';

$(document).ready(function(){
	$btnCreateApp 		= $('#btnCreateApp');
	$createAppDialog 	= $('#createAppDialog');
	$createDialogFilter = $('#createDialogFilter');
	$btnCloseCreateApp 	= $('#btnCloseCreateApp');
	$btnSubmitCreateApp = $('#btnSubmitCreateApp');
	$btnDeleteApp 		= $('#btnDeleteApp');

	$dbStatus = $('#db_status');

	databaseChecking();

	$btnCreateApp.click(function(){
		$createAppDialog.fadeIn(100);
		$createDialogFilter.fadeIn(300);
		$('#app_name').focus();
	});

	$btnCloseCreateApp.click(function(){
		closeDialog();
	});

	function closeDialog(){
		$createAppDialog.fadeOut(300);
		$createDialogFilter.fadeOut(300);

		$('#app_id').val('');
		$('#app_name').val('');
	}

	// $('#apps').on('click','.btn-edit-app',function(e){
	// 	var app_id 			= $(this).parent().attr('data-id');
	// 	var app_name 		= $(this).parent().children('.detail').children('.name').html();
	// 	var app_description = $(this).parent().children('.detail').children('.desc').html();

	// 	$('#app_id').val(app_id);
	// 	$('#app_name').val(app_name);
	// 	$('#app_description').val(app_description);

	// 	$createAppDialog.fadeIn(100);
	// 	$btnDeleteApp.fadeIn(100);
	// 	$createDialogFilter.fadeIn(300);
	// });

	$btnSubmitCreateApp.click(function(){
		console.log('btnSubmitCreateApp');

		var app_id 		= $('#app_id').val();
		var name 		= $('#app_name').val();

		if(name == '') return false;

		$.ajax({
	        url         :api_url,
	        cache       :false,
	        dataType    :"json",
	        type        :"POST",
	        data:{
	            request 	:'submit',
	            app_id		:app_id,
	            app_name	:name
	        },
	        error: function (request, status, error) {
	            console.log("Request Error",request.responseText);
	        }
	    }).done(function(data){
	    	console.log(data);
	    	location.reload();
	    });		
	});
});
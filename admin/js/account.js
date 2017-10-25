var api_url = 'api.account.php';

$(document).ready(function(){
	var sign = $('#sign').val();

	$btnCreateAccount 			= $('#btnCreateAccount');
	$createAccountDialog 		= $('#createAccountDialog');
	$btnCloseCreateAccount 		= $('#btnCloseCreateAccount');
	$btnSubmitCreateAccount 	= $('#btnSubmitCreateAccount');
	$createAccountFilter 		= $('#createAccountFilter');

	$btnCreateAccount.click(function(){
		$createAccountDialog.fadeIn(300);
		$createAccountFilter.fadeIn(100);
		$('#displayname').focus();
	});

	$btnCloseCreateAccount.click(function(){
		closeAccountDialog();
	});

	function closeAccountDialog(){
		$createAccountDialog.fadeOut(300);
		$createAccountFilter.fadeOut(100);
	}

	// ACCOUNT VERIFY
	$('#account').on('click','.btn-approve',function(){
		var account_id = $(this).parent().attr('data-account');

		$.get({
			url         :api_url,
			timeout 	:10000, //10 second timeout
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'approve',
				account_id 	:account_id,
				sign 		:sign,
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);
			location.reload();
		}).fail(function() {
			alert('Fail!');
		});		
	});

	// ACCOUNT DISABLE
	$('#account').on('click','.btn-disable',function(){
		var account_id = $(this).parent().attr('data-account');

		$.get({
			url         :api_url,
			timeout 	:10000, //10 second timeout
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'disable',
				account_id 	:account_id,
				sign 		:sign,
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);
			location.reload();
		}).fail(function() {
			alert('Fail!');
		});		
	});

	$('#accountPermission').on('click','.permission-items',function(){
		var permission = $(this).attr('data-permission');
		$('.permission-items').removeClass('-active');
		$(this).addClass('-active');
		$('#account_permission').val(permission);
	});

	$btnSubmitCreateAccount.click(function(){
		var displayname 		= $('#displayname').val();
		var username 			= $('#username').val();
		var password 			= $('#password').val();
		var account_permission 	= $('#account_permission').val();

		console.log('password',password);

		$.get({
			url         :api_url,
			timeout 	:10000, //10 second timeout
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'create_account',
				displayname 	:displayname,
				username :username,
				password :password,
				account_permission :account_permission,
				sign 		:sign,
			},
			error: function (request, status, error) {
				console.log("Request Error",request.responseText);
			}
		}).done(function(data){
			console.log(data);
			location.reload();
		}).fail(function() {
			alert('Fail!');
		});
	});
});
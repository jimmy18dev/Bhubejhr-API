var api_url = 'api.user.php';

$(document).ready(function(){
	var sign = $('#sign').val();

	$btnEditProfile 			= $('#btnEditProfile');
	$editProfileFilter 			= $('#editProfileFilter');
	$btnSubmiteditProfile 		= $('#btnSubmiteditProfile');
	$btnCloseEditProfile 		= $('#btnCloseEditProfile');
	$editProfileDialog 			= $('#editProfileDialog');

	$btnEditProfile.click(function(){
		$editProfileDialog.fadeIn(300);
		$editProfileFilter.fadeIn(100);
		$('#oldpassword').focus();
	});

	$btnCloseEditProfile.click(function(){
		closeEditProfile();
	});

	$btnSubmiteditProfile.click(function(){
		var username 	= $('#username').val();
		var displayname = $('#displayname').val();

		if(username == '' || displayname == ''){
			return false;
		}

		$.get({
			url         :api_url,
			timeout 	:10000, //10 second timeout
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'edit_profile',
				username :username,
				displayname :displayname,
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

	function closeEditProfile(){
		$editProfileDialog.fadeOut(300);
		$editProfileFilter.fadeOut(100);
	}

	$btnChangePassword 			= $('#btnChangePassword');
	$changePasswordDialog 		= $('#changePasswordDialog');
	$changePasswordFilter 		= $('#changePasswordFilter');
	$btnCloseChangePassword 	= $('#btnCloseChangePassword');
	$btnSubmitChangePassword 	= $('#btnSubmitChangePassword');

	$btnChangePassword.click(function(){
		$changePasswordDialog.fadeIn(300);
		$changePasswordFilter.fadeIn(100);
		$('#oldpassword').focus();
	});

	$btnSubmitChangePassword.click(function(){
		var oldpassword 	= $('#oldpassword').val();
		var newpassword 	= $('#newpassword').val();
		var renewpassword 	= $('#renewpassword').val();

		if(oldpassword == '' || newpassword == '' || renewpassword == ''){
			return false;
		}else if(newpassword != renewpassword){
			return false;
		}

		$.get({
			url         :api_url,
			timeout 	:10000, //10 second timeout
			cache       :false,
			dataType    :"json",
			type        :"POST",
			data:{
				request     :'change_password',
				oldpassword :oldpassword,
				newpassword :newpassword,
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

	$btnCloseChangePassword.click(function(){
		closeChangePasswordDialog();
	});

	function closeChangePasswordDialog(){
		$changePasswordDialog.fadeOut(300);
		$changePasswordFilter.fadeOut(100);

		$('#oldpassword').val('');
		$('#newpassword').val('');
		$('#renewpassword').val('');
	}
});

function login(){
	var username 	= $('#username').val();
	var password 	= $('#password').val();
	var sign 		= $('#sign').val();

	console.log('login()',username,password,sign);

	if(username == ''){
		$('#username').focus();
		return false;
	}else if(password == ''){
		alert('คุณยังไม่ได้กรอกรหัสผ่าน!');
		$('#password').focus();
		return false;
	}

	$.get({
		url         :api_url,
		timeout 	:10000, //10 second timeout
		cache       :false,
		dataType    :"json",
		type        :"POST",
		data:{
			request     :'login',
			username 	:username,
			password 	:password,
			sign 		:sign,
		},
		error: function (request, status, error) {
			console.log("Request Error",request.responseText);
		}
	}).done(function(data){
		console.log(data);

		if(data.state == 1){
			$('#btn-submit').addClass('-loading');
			$('#btn-submit').html('กำลังเข้าระบบ...');
			// $progress.animate({width:'100%'},300);
			
			setTimeout(function(){
				window.location = 'index.php?login=success';
	        },1000);
		}else if(data.state == 0){
			// $progress.animate({width:'0%'},300);
			alert('เข้าระบบไม่สำเร็จ กรุณาตรวจสอบอีกครั้ง!');
		}else if(data.state == -1){
			// $progress.animate({width:'0%'},300);
			alert('คุณต้องรออีก 5 นาที เพื่อเข้าระบบใหม่!');
		}
	}).fail(function() {
		alert('ระบบทำงานผิดพลาด กรุณาลองใหม่อีกครั้ง!');
		// $progress.animate({width:'0%'},300);
		$('#password').focus();
		$('#password').val('');
	});
}
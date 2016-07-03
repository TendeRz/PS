function checkUsername(username, element){
	var spanUsername = $(element).next();
	if(username.length > 5){
		$(spanUsername).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
		$(spanUsername).addClass('glyphicon-ok-circle');

			if($('.myPwd').hasClass('glyphicon-ok-circle')){
				$('.signIn').removeAttr('disabled');
		}
	}else{
		$(spanUsername).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
		$(spanUsername).addClass('glyphicon-ban-circle');
		$('.signIn').attr('disabled', 'true');
	}
}

function validatePswd(paswd, element){
	var spanPwd = $(element).next();
	var regex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
	if(paswd.length > 0){

		if(regex.test(paswd)){
			$(spanPwd).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
			$(spanPwd).addClass('glyphicon-ok-circle');
			
			if($('.myUser').hasClass('glyphicon-ok-circle')){
				$('.signIn').removeAttr('disabled');
			}
		}
		else{
			$(spanPwd).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
			$(spanPwd).addClass('glyphicon-ban-circle');
			$('.signIn').attr('disabled', 'true');
		}
	}else{
		$(spanPwd).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
		$('.signIn').attr('disabled', 'true');
	}

	if(paswd == 'admin'){
		$('.signIn').removeAttr('disabled');
		}
}

function login(username, password, fullUrl){
	$.get( '/startSession', {username : username, password: password}, function(data) {
		if(data == "Success"){
			window.location.href = fullUrl;
			//window.location.href = "http://localhost:3000/";
		}else{
			location.reload();
		}
	})
}
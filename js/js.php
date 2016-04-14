<script src="/root/PS/js/jquery-2.2.0.js"></script>
<script src="/root/PS/js/jquery-1.12.0.min.js"> </script>
<script src="/root/PS/js/bootstrap.js"></script>

<script src="/root/PS/ckeditor/ckeditor.js"></script>



<script src="/root/PS/js/spoiler.js"></script>

<script>

	$(document).ready(function() {
		$('#newSystemModal, #newCountryModal, #newFuncAreaModal').on('hide.bs.modal', function(e) {
			$('#newSystemInput, #newCountryInput, #newFuncAreaInput').val('');
			$('.additionSpan').removeClass('glyphicon-ok-circle glyphicon-ban-circle');
			$('.newAddition').attr('disabled', 'true');
		});

	});


	function addNewAddition(system, element, addition){
		$('#registerSystem, #registerCountry, #registerFuncArea').attr('disabled', 'true');
		var spanAddition = $(element).next();
		$(spanAddition).removeClass('glyphicon-ok-circle glyphicon-ban-circle');
		if(system.length > 2){
			$.post('/root/PS/adds/queries.php', {newAdditionCheck:system, addition}, function(data){
				if(data=='ok'){
					$(spanAddition).addClass('glyphicon-ok-circle');
					$('#registerSystem, #registerCountry, #registerFuncArea').removeAttr('disabled');
				}else{
					$(spanAddition).addClass('glyphicon-ban-circle');
				}
			});
		}
	}


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

	function checkUpdateProfileForm(value, element){
		var divBox = $(element).parent().parent();
		
		if(value.length > 3){
			$(divBox).removeClass('has-error');
			$(divBox).addClass('has-success');

			if($('.profile-update').hasClass('has-error')){
				$('.profile-update-button').attr('disabled', 'true');
			}else{
				$('.profile-update-button').removeAttr('disabled');
			}
		}else{
			$(divBox).removeClass('has-success');
			$(divBox).addClass('has-error');
			$('.profile-update-button').attr('disabled', 'true');
		}
	}

	function checkUpdateProfileMail(value, element){
		var divBox = $(element).parent().parent();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if(value.length > 5){
			if(regex.test(value)){
				if(value != " "){
					$.post('./adds/queries.php', {checkUpdateMail:value}, function(answer){
						if(answer=='ok'){
							$(divBox).removeClass('has-error');
							$(divBox).addClass('has-success');

							if($('.profile-update').hasClass('has-error')){
								$('.profile-update-button').attr('disabled', 'true');
							}else{
								$('.profile-update-button').removeAttr('disabled');
							}
						}else{
							$(divBox).removeClass('has-success');
							$(divBox).addClass('has-error');
							$('.profile-update-button').attr('disabled', 'true');
							alert('Email already in use!');
						}
					});
				}else{
					$(divBox).removeClass('has-success');
					$(divBox).addClass('has-error');
					$('.profile-update-button').attr('disabled', 'true');
				}
			}else{
				$(divBox).removeClass('has-success');
				$(divBox).addClass('has-error');
				$('.profile-update-button').attr('disabled', 'true');
			}			
		}else{
			$(divBox).removeClass('has-success');
			$(divBox).addClass('has-error');
			$('.profile-update-button').attr('disabled', 'true');
		}
	}

	function checkUpdatePasswordCurrent(value, element){
		var divBox = $(element).parent().parent();
		var regex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
		if(value.length > 0 ){
			if(regex.test(value)){
				$.post('./adds/queries.php', {checkUpdatePassword:value}, function(answer){
					if(answer=='ok'){
						$(divBox).removeClass('has-error');
						$(divBox).addClass('has-success');

						if($('.password-update').hasClass('has-error')){
							$('.password-update-button').attr('disabled', 'true');
						}else{
							$('.password-update-button').removeAttr('disabled');
								}
					}else{
						$(divBox).removeClass('has-success');
						$(divBox).addClass('has-error');
						$('.password-update-button').attr('disabled', 'true');
					}
			});
			}else{
				$(divBox).removeClass('has-success');
				$(divBox).addClass('has-error');
				$('.password-update-button').attr('disabled', 'true');
			}
		}else{
			$(divBox).removeClass('has-success');
			$(divBox).removeClass('has-error');
		}
	}

	function checkUpdatePasswordNew(element){
		var paswd1 = document.getElementsByName('passwordUpdateNew')[0].value;
		var paswd2 = document.getElementsByName('passwordUpdateNewRepeat')[0].value;
		var regex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
				if(paswd1!='' && paswd2!=''){
					if(paswd1 == paswd2){
						if(regex.test(paswd1) && regex.test(paswd2)){
							$('.password-update-new').removeClass('has-error');
							$('.password-update-new').addClass('has-success');
							if($('.password-update-current').hasClass('has-success')){
								$('.password-update-button').removeAttr('disabled');
							}
						}else{
							console.log('Stronger Password Required!');
							$('.password-update-new').removeClass('has-success');
							$('.password-update-new').addClass('has-error');
							$('.password-update-button').attr('disabled', 'true');
						}
					}else{						
						$('.password-update-new').removeClass('has-success');
						$('.password-update-new').addClass('has-error');
						$('.password-update-button').attr('disabled', 'true');
					}
				}else{
					$('.password-update-new').removeClass('has-success');
					$('.password-update-new').removeClass('has-error');
					$('.password-update-button').attr('disabled', 'true');
				}

		


		//if($('.password-update-current').hasClass('has-success')){
		//	console.log('has success');
		//}else{
		//	console.log('has error or nothing');
		//}
		
	}

</script>
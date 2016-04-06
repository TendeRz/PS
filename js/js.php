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

</script>
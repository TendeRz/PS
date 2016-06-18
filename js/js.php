<script src="/root/PS/js/jquery-2.2.0.js"></script>
<script src="/root/PS/js/bootstrap.js"></script>

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

		if(value.length == 0){
			$(divBox).removeClass('has-success');
			$(divBox).removeClass('has-error');
		}
	}

	function checkUpdateProfileMail(value, element){
		var divBox = $(element).parent().parent();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var $val = value;
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
		if(value.length == 0){
			$(divBox).removeClass('has-success');
			$(divBox).removeClass('has-error');			
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
			$('.password-update-button').attr('disabled', 'true');
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
	}

	function checkAvatar(avatarID){
		$('.avatar-update-button').attr('disabled', 'true');
		$('.no-image, .wrong-image').addClass('display-none');
		$('.avatar-change').removeClass('display-none');
		var filename = document.getElementsByName('avatarUpdate')[0].value;
		if(filename !== ''){
			var ext = filename.split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
				$('.avatar-change').addClass('display-none');
				$('.wrong-image').removeClass('display-none');
			}else{
				putImage();
				$('.avatar-update-button').removeAttr('disabled');
			}
		}else{
			$('.avatar-change').addClass('display-none');
			$('.no-image').removeClass('display-none');
		}
	}

	function putImage() {
		var src = document.getElementById("changeAvatarID");
		var target = document.getElementById("selectedAvatar");
		showImage(src, target);
	}

	function showImage(src, target) {
		var fr = new FileReader();
		fr.onload = function(){
			target.src = fr.result;
		}
		fr.readAsDataURL(src.files[0]);
	}

	function checkTasks(){
		$('.taskrow').each(function(){
				var tasktime = $(this).children('.tasktime').text();
				var status = $(this).children('.status').text();
				var taskdate = $(this).children('.taskdate').text();
				var now = new Date(Date.now());
				var startdate = now.getFullYear() + "-" + taskdate.substr(0, 2) + "-" + taskdate.substr(3, 2);
				var curdate = now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
				var curtime = now.getHours() + ":" + now.getMinutes();
				var timedifference = ( new Date(startdate + " " + tasktime ) - new Date(curdate + " " + curtime) ) / 60000;				
				
				if ((status == 'Not possible now') || (status == 'Problem')){
				 	$(this).addClass('task-notpossible');
				} else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 0)) {
					$(this).addClass('task-missed');
				}else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 5)) {
					$(this).addClass('task-late');
				}else if (status == 'In progress'){
					$(this).addClass('task-inprogress');
				}
			})
	}

	function selectcountries() {
		
			var selected = $( "input:checked" ).map(function() {
				return this.value;
			}).get().join();

			if (selected) {
				$.post('./adds/ajax.php', {selected}, function(data){
			 		$("#tasklist").html(data);
			 		checkTasks();
			 	});
			} else {
				$('#noCountriesModal').modal('show');
			}
		
	};

	function checkallcountries(){			
		    $('input:checkbox').prop('checked', true);
	};

	function uncheckallcountries(){			
		    $('input:checkbox').prop('checked', false);
	};

	function quickprogresstaskstate(element){
		var status = $(element).parent().siblings('.status').text();
		var taskid = $(element).data('taskid');

		if ((status == 'To be done') || (status == 'Check result')){
			$.post('./adds/ajax.php', {quickprogresstaskstatez:taskid}, function(data){
				if(data=='done'){
					selectcountries();
					//console.log('It is done. It is over!')
				}else{
					alert(data);
				}
			})
		} else {
			$('#newstate').data('taskid', taskid);
			$('#newstatus').modal('show');
		}
	};

	function progresstaskstate(element){
		var newstatus = $(":selected").val();
		var taskid = $(element).data('taskid');
		
		$.post('./adds/ajax.php', {progresstatus:newstatus, progresstaskid:taskid}, function(data){
			if(data=='done'){
				selectcountries();
				//console.log('It is done. It is over!')
			}else{
				alert(data);
			}
		})
	}
</script>
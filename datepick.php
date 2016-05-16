<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Date Picker</title>


	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />


	<script src="/root/PS/js/jquery-2.2.0.js"> </script>
	<script src="/root/PS/js/moment-with-locales.js"></script>
	<script src="/root/PS/js/bootstrap.js"></script>
	<script src="/root/PS/js/bootstrap-datetimepicker.js"></script>
</head>
<body>



	<div class="container">
		<div class="addtime">
			<div class="row">
				<div class='col-sm-12 timeset'>
					
				</div>
			</div>
		</div>







		<div class="row">
			<button id="addTime" class="btn" style="margin: 20px 0 20px 20px">Add Time</button>
			<button onclick="testFunc()" id="postTime" class="btn" style="margin: 20px 0 20px 20px">Post</button>
		</div>
	</div>
	<script>
		$(function () {
			$('#addTime').on('click',function () {
				$('.col-sm-12').append('<input type="text" class="form-control addedTime" />');
				$('.timeset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "HH:mm",
						sideBySide: true
					});
				});
			})
		})

		function testFunc() {
			$(".timeset input[type=text]").each(function() {
				if(isNaN(this.value)) {
					console.log(this.value.substring(0,2) + ':' + this.value.substring(3,5));
				} else {
					console.log('empty value');
				}

			})
			
		}
	</script>

	<script type="text/javascript">
		
	</script>






</body>
</html>




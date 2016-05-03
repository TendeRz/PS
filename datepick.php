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


	</div>




	<div class="row">
		<button id="addTime" class="btn" style="margin: 20px 0 20px 20px">Select</button>
	</div>

	<script>
		$(function () {
			$('#addTime').on('click',function () {
				$('.col-sm-12').append('<input type="text" class="form-control" />');
				$('.timeset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "HH:mm",
						sideBySide: true
					});
				});
			})
		})
	</script>

	<script type="text/javascript">
		
	</script>






</body>
</html>




<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Date Picker</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />


	
</head>
<body>
	<div class="container">
		<?php 
		include_once('./js/js.php');
		include_once('./js/datepicker_js.php'); 
		?>


		<form action="./adds/queries.php" enctype='multipart/form-data' method="post" role="form" autocomplete="off" id="testform">
			<div class="col-sm-10">
				<div class="panel-body addTime">
					<div class="timeset">
						<input type='text' class="form-control" id='datetimepicker1' name="testtime"/>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker1').datetimepicker({
									locale: 'en',
									format: "HH:mm"
								});
							});
						</script>

						<input  class="btn btn-default" type="submit" form="testform" name="newtestform" value="Create" style="margin-top: 5px">
					</div>
				</div>
			</div>
		</form>

	</div>



	<script type="text/javascript">
		
	</script>





</body>
</html>




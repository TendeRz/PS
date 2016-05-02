<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Task Planner</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />

</head>
<body>
	<?php
		include_once('./adds/queries.php');
		include_once('./js/js.php');
		include_once('./js/datepicker_js.php');
	?>
	<div class="container">
		<?php 
			include_once('login_check.php');
			include_once('navigation.php');
		?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> Schedule </h3>
			</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Subject</label>
						<div class="col-sm-10">
							<input name="inputfield" class="form-control" placeholder="Task Name">
						</div>
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Initiate State</label>
						<div class="col-sm-10">                                                                       
							<select class="form-control" name="System">'
								<?php 
									$dropInitState = selectInitState();
									foreach ($dropInitState as $key => $dropInitStateItem) {
									echo '<option value='.$dropInitStateItem[0].'>'.$dropInitStateItem[1].'</option>';
									}
								?>
							</select>                                                                           
						</div>
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Start Date</label>
						<div class="col-sm-10">
							    
							<input type='text' class="form-control" id='datetimepicker4' />
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker4').datetimepicker({
										locale: 'en',
										format: "DD/MM/YYYY HH:mm",
										sideBySide: true
									});
								});
        					</script>
								
							    
						</div>

						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Select Schedule</label>
						<div  class="col-sm-10">
							<select class="form-control" name="Schedule">'
								<?php 
									$dropSchedule = selectAll('taskschedule', 1);
									foreach ($dropSchedule as $key => $dropScheduleItem) {
									echo '<option value='.$dropScheduleItem[0].'>'.$dropScheduleItem[1].'</option>';
									}
								?>
							</select>                                                                           
						</div>						
					</div>  
				</div>
		</div>
	</div>

    <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'en'
      });
    </script>
</body>
</html>
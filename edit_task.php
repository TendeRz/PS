
<?php
session_start();
?>

<html lang="en">
<head>
	<title>Task List</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />	
</head>
<body>
	<div class="container">
		<?php
		include_once('login_check.php');
		include_once('navigation.php');
		include_once('./adds/queries.php');
		include_once('./js/js.php');
		include_once('./js/datepicker_js.php');
		$selected = 0;
		$schedule = 4;
		?>

		<div class="col-sm-10">

			<input type='text' class="form-control" id='datetimepicker1' name="schedStartDate" value="2016-07-03"/>
			<script type="text/javascript">
				$(function () {
					$('#datetimepicker1').datetimepicker({
						locale: 'en',
						format: "YYYY-MM-DD",
						sideBySide: true
					});
				});
			</script>


		</div>

		<div class="col-sm-10">
			<select class="form-control" name="initialState" value="1">
				<?php 
				$dropInitState = selectInitState();
				foreach ($dropInitState as $key => $dropInitStateItem) {
					if ($dropInitStateItem[0] == $selected){
						echo '<option value='.$dropInitStateItem[0].' selected>'.$dropInitStateItem[1].'</option>';
					}else{
						echo '<option value='.$dropInitStateItem[0].' >'.$dropInitStateItem[1].'</option>';
					}
				}
				?>
			</select>
		</div>
		<div  class="col-sm-10">
			<select id="schedSelect" class="form-control" name="schedType">'
				<?php 
				$dropSchedule = selectAll('taskschedule', 1);
				foreach ($dropSchedule as $key => $dropScheduleItem) {
					if ($dropScheduleItem[0] == $schedule){
						echo '<option value='.$dropScheduleItem[0].' selected>'.$dropScheduleItem[1].'</option>';
					} else{
						echo '<option value='.$dropScheduleItem[0].'>'.$dropScheduleItem[1].'</option>';
					}
				}
				?>
			</select>
			<div id="schedOption4" class="schedulingOptions">
				<div class="panel panel-default">
					<div class="panel-body addTime">
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="0"> Monday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="1"> Tuesday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="2"> Wednesday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="3"> Thursday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="4"> Friday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="5"> Staurday</label>
						<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="6"> Sunday</label>
					</div>
					<input type='text' class="form-control timeInput" name="schedTimesetWeekday"/>
					<div>
					</div>
				</div> 
			</div>
			<div id="schedOption3" class="schedulingOptions">
				<div class="panel panel-default">
					<div class="panel-body addTime">
						Schedule will be set for every day of month, excluding weekends.
						<input type='text' class="form-control timeInput" name="schedTimesetNoWeekends"/>
						<div>											
						</div>
					</div>
				</div>
			</div>
		</div>



		<script>
			$(function () {
				$('.timeInput').each(function(){
					$(this).datetimepicker({locale: 'en', format: "HH:mm"})
				});
			})

			$('.schedulingOptions').hide();
			var selectedSchedOption = $("#schedSelect > option:selected").index();
				$('.schedulingOptions').hide("fast");
				$('#schedOption' + selectedSchedOption).show("slow");
				
			$('#schedSelect').change(function() {
				var selectedSchedOption = $("#schedSelect > option:selected").index();
				$('.schedulingOptions').hide("fast");
				$('#schedOption' + selectedSchedOption).show("slow");
			})
		</script>
	</body>
	</html>
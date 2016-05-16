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
						<select id="schedSelect" class="form-control" name="Schedule">'
							<?php 
								$dropSchedule = selectAll('taskschedule', 1);
								foreach ($dropSchedule as $key => $dropScheduleItem) {
								echo '<option value='.$dropScheduleItem[0].'>'.$dropScheduleItem[1].'</option>';
								}
							?>
						</select>
						<div id="schedOption1" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									<div class="timeset">
										
									</div>
								</div>
								<button id="addTime" class="btn" style="margin: 20px 0 20px 20px">Add Time Line</button>
								<button id="removeTime" class="btn" style="margin: 20px 0 20px 20px">Remove Time Line</button>
							</div>
						</div>
						<div id="schedOption2" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									Schedule will be set for every day of month.
								</div>
							</div>
						</div>
						<div id="schedOption3" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									Schedule will be set for every day of month, excluding weekends.
								</div>
							</div>
						</div>
						<div id="schedOption4" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday1" value="1"> Monday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday2" value="2"> Tuesday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday3" value="3"> Wednesday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday4" value="4"> Thursday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday5" value="5"> Friday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday6" value="6"> Staurday</label>
									<label class="checkbox-inline"><input type="checkbox" id="schedWeekday7" value="7"> Sunday</label>
								</div>
							</div> 
						</div>
						<div id="schedOption5" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									<div class="row">
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday1" value="1"> 01 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday2" value="2"> 02 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday3" value="3"> 03 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday4" value="4"> 04 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday5" value="5"> 05 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday6" value="6"> 06 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday7" value="7"> 07 </input></label>
									</div>
									<div class="row">
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday8" value="8"> 08 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday9" value="9"> 09 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday10" value="10"> 10 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday11" value="11"> 11 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday12" value="12"> 12 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday13" value="13"> 13 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday14" value="14"> 14 </input></label>
									</div>
									<div class="row">
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday15" value="15"> 15 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday16" value="16"> 16 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday17" value="17"> 17 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday18" value="18"> 18 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday19" value="19"> 19 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday20" value="20"> 20 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday21" value="21"> 21 </input></label>
									</div>
									<div class="row">
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday22" value="22"> 22 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday23" value="23"> 23 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday24" value="24"> 24 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday25" value="25"> 25 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday26" value="26"> 26 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday27" value="27"> 27 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday28" value="28"> 28 </input></label>
									</div>
									<div class="row">
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday29" value="29"> 29 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday30" value="30"> 30 </input></label>
										<label class="checkbox-inline"><input type="checkbox" id="schedMonthday31" value="31"> 31 </input></label>
									</div>
								</div>
							</div>
						</div>
						<div id="schedOption6" class="schedulingOptions">
							<div class="panel panel-default">
								<div class="panel-body addTime">
									To add custom Calendar.
								</div>
							</div>
						</div>
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

      	$(function () {
			$('#addTime').on('click',function () {
				$('.timeset').append('<input type="text" class="form-control addedTime" />');
				$('.timeset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "HH:mm",
						sideBySide: true
					});
				});
			})

			$('#removeTime').on('click',function () {
				$('.addedTime:last-child').remove();
			})
		})

      $('.schedulingOptions').hide();
      $('#schedSelect').change(function() {
      	var selectedSchedOption = $("#schedSelect > option:selected").index();
      	$('.schedulingOptions').hide("fast");
      	$('#schedOption' + selectedSchedOption).show("slow");
      })
    </script>
</body>
</html>
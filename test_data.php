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
		include_once('./adds/queries.php');
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
				<form action="./adds/queries.php" enctype='multipart/form-data' method="post" role="form" autocomplete="off" id="scheduleInsertForm">
					<div class="form-group">
						<label class="col-sm-2 control-label margin-top-5">Subject</label>
						<div class="col-sm-10">
							<input name="schedName" class="form-control" placeholder="Task Name">
						</div>
						<label class="col-sm-2 control-label margin-top-5">Initiate State</label>
						<div class="col-sm-10">                                                                       
							<select class="form-control" name="initialState">'
								<?php 
									$dropInitState = selectInitState();
									foreach ($dropInitState as $key => $dropInitStateItem) {
									echo '<option value='.$dropInitStateItem[0].'>'.$dropInitStateItem[1].'</option>';
									}
								?>
							</select>                                                                           
						</div>
						<label class="col-sm-2 control-label margin-top-5">Start Date</label>
						<div class="col-sm-10">
							    
							<input type='text' class="form-control" id='datetimepicker1' name="schedStartDate"/>
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker1').datetimepicker({
										locale: 'en',
										format: "DD/MM/YYYY",
										sideBySide: true
									});
								});
	    					</script>
								
							    
						</div>

						<label class="col-sm-2 control-label margin-top-5">Select Schedule</label>
						<div  class="col-sm-10">
							<select id="schedSelect" class="form-control" name="schedType">'
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
									<button type="button" id="addTime" class="btn" style="margin: 20px 0 20px 20px">Add Time Line</button>
									<button type="button" id="removeTime" class="btn" style="margin: 20px 0 20px 20px">Remove Time Line</button>
								</div>
							</div>
							<div id="schedOption2" class="schedulingOptions">
								<div class="panel panel-default">
									<div class="panel-body addTime">
										Schedule will be set for every day of month.
										<input type='text' class="form-control" id='datetimepicker2' name="schedTimesetDaily"/>
										<script type="text/javascript">
											$(function () {
												$('#datetimepicker2').datetimepicker({
													locale: 'en',
													format: "HH:mm",
													sideBySide: true
												});
											});
										</script>
									</div>
								</div>
							</div>
							<div id="schedOption3" class="schedulingOptions">
								<div class="panel panel-default">
									<div class="panel-body addTime">
										Schedule will be set for every day of month, excluding weekends.
										<input type='text' class="form-control" id='datetimepicker3' name="schedTimesetNoWeekends"/>
										<script type="text/javascript">
											$(function () {
												$('#datetimepicker3').datetimepicker({
													locale: 'en',
													format: "HH:mm",
													sideBySide: true
												});
											});
										</script>										
									</div>
								</div>
							</div>
							<div id="schedOption4" class="schedulingOptions">
								<div class="panel panel-default">
									<div class="panel-body addTime">
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="1"> Monday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="2"> Tuesday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="3"> Wednesday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="4"> Thursday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="5"> Friday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="6"> Staurday</label>
										<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="7"> Sunday</label>
									</div>
								</div> 
							</div>
							<div id="schedOption5" class="schedulingOptions">
								<div class="panel panel-default">
									<div class="panel-body addTime">
										<div class="row">
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="1"> 01 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="2"> 02 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="3"> 03 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="4"> 04 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="5"> 05 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="6"> 06 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="7"> 07 </input></label>
										</div>
										<div class="row">
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="8"> 08 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="9"> 09 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="10"> 10 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="11"> 11 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="12"> 12 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="13"> 13 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="14"> 14 </input></label>
										</div>
										<div class="row">
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="15"> 15 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="16"> 16 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="17"> 17 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="18"> 18 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="19"> 19 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="20"> 20 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="21"> 21 </input></label>
										</div>
										<div class="row">
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="22"> 22 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="23"> 23 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="24"> 24 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="25"> 25 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="26"> 26 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="27"> 27 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="28"> 28 </input></label>
										</div>
										<div class="row">
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="29"> 29 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="30"> 30 </input></label>
											<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="31"> 31 </input></label>
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
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<input  class="btn btn-default" type="submit" form="scheduleInsertForm" name="newSched" style="margin-top: 20px">
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> Classification </h3>
			</div>
			<div class="panel-body">
				<label class="col-sm-2 control-label margin-top-5">System</label>
				<div class="col-sm-10">
					<select id="schedSelect" class="form-control" name="schedType">'
						<?php 
							$dropSystem = selectAll('classsystem', 2);
							foreach ($dropSystem as $key => $dropSystemItem) {
							echo '<option value='.$dropSystemItem[0].'>'.$dropSystemItem[1].'</option>';
							}
						?>
					</select>
				</div>

				<label class="col-sm-2 control-label margin-top-5">Country</label>
				<div class="col-sm-10">
					<select id="schedSelect" class="form-control" name="schedType">'
						<?php 
							$dropCountry = selectAll('classcountry', 2);
							foreach ($dropCountry as $key => $dropCountryItem) {
							echo '<option value='.$dropCountryItem[0].'>'.$dropCountryItem[1].'</option>';
							}
						?>
					</select>
				</div>

				<label class="col-sm-2 control-label margin-top-5">Functional Area</label>
				<div class="col-sm-10">
					<select id="schedSelect" class="form-control" name="schedType">'
						<?php 
							$dropFuncArea = selectAll('classfuncarea', 2);
							foreach ($dropFuncArea as $key => $dropFuncAreaItem) {
							echo '<option value='.$dropFuncAreaItem[0].'>'.$dropFuncAreaItem[1].'</option>';
							}
						?>
					</select>
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
				$('.timeset').append('<input type="text" class="form-control addedTime" name="schedTimeset[]"/>');				
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
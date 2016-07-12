<?php
	session_start();
	$globalTaskID = $_GET['taskID'];
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Edit Task</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />

</head>
<body>
	<div class="container">
	<?php
		include_once('login_check.php');
		include_once('navigation.php');
		include_once('./js/js.php');
		include_once('./js/datepicker_js.php');
		include_once('./adds/queries.php');


		$selectTask = selectEditTask($globalTaskID);
		foreach ($selectTask as $key => $taskItem) {
			$taskName = $taskItem[1];
			$taskInitState = $taskItem[2];
			$taskStartDate = $taskItem[3];
			$taskSchedType = $taskItem[4];
			$taskSystem = $taskItem[5];
			$taskCountry = $taskItem[6];
			$taskFuncArea = $taskItem[7];
			$taskProcedure = $taskItem[8];
			$taskDescription = $taskItem[9];
			$taskObsolite = $taskItem[10];
			$taskCreateName = $taskItem[11];
			$taskCreateDate = $taskItem[12];
			$taskModName = $taskItem[13];
			$taskModDate = $taskItem[14];
		}
	?>
	

		<form action="./adds/queries.php" enctype='multipart/form-data' method="post" role="form" autocomplete="off" id="scheduleInsertForm">
			<input type="hidden" name="schedCreateDate" value="<?php echo $taskCreateDate; ?>">
			<input type="hidden" name="schedTaskID" value="<?php echo $globalTaskID; ?>">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> Schedule </h3>
				</div>
				<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label margin-top-5">Subject</label>
							<div class="col-sm-10">
								<input name="schedName" class="form-control" placeholder="Task Name" value="<?php echo $taskName; ?>">
							</div>
							<label class="col-sm-2 control-label margin-top-5">Initiate State</label>
							<div class="col-sm-10">
								<select class="form-control" name="initialState">'
									<?php 
										$dropInitState = selectInitState();
										foreach ($dropInitState as $key => $dropInitStateItem) {
											if ($dropInitStateItem[0] == $taskInitState){
												echo '<option value='.$dropInitStateItem[0].' selected>'.$dropInitStateItem[1].'</option>';
											}else{
												echo '<option value='.$dropInitStateItem[0].' >'.$dropInitStateItem[1].'</option>';
											}
										}
									?>
								</select>
							</div>
							<label class="col-sm-2 control-label margin-top-5">Start Date</label>
							<div class="col-sm-10">
								    
								<input type='text' class="form-control" id='datetimepicker1' name="schedStartDate" value="<?php echo $taskStartDate; ?>"/>
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
							<label class="col-sm-2 control-label margin-top-5">Activation</label>
							<div class="col-sm-10">
								<select class="form-control" name="schedActive">
									<?php $obsolite = selectEditTaskActive($globalTaskID);
										foreach ($obsolite as $key => $obsoliteItem) {
											if($obsoliteItem[0] == 0) {
												echo '<option value="0" selected>Inactive</option><option value="1">Active</option>';
											}else{
												echo '<option value="0">Inactive</option><option value="1" selected>Active</option>';
											}
										}
									 ?>
								</select>
							</div>
							<label class="col-sm-2 control-label margin-top-5">Select Schedule</label>
							<div  class="col-sm-10">
								<select id="schedSelect" class="form-control" name="schedType">'
									<?php 
										$dropSchedule = selectAll('taskschedule', 1);
										foreach ($dropSchedule as $key => $dropScheduleItem) {
											if ($dropScheduleItem[0] == $taskSchedType){
												echo '<option value='.$dropScheduleItem[0].' selected>'.$dropScheduleItem[1].'</option>';
											}else{
												echo '<option value='.$dropScheduleItem[0].' >'.$dropScheduleItem[1].'</option>';
											}
										}
									?>
								</select>
								<div id="schedOption1" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">
											<div class="timeset">
												<?php if($taskSchedType == 1){

													$tasktimes = selectEditTaskTimes($globalTaskID);
													foreach ($tasktimes as $key => $tasktimesitem) {
														echo '<input type="text" class="form-control addedTime" name="schedTimeset[]" value="'.$tasktimesitem[1].'"/>';
													}
													} ?>
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
												<?php if($taskSchedType == 2){
													$tasktimes = selectEditTaskTimes($globalTaskID);
													foreach ($tasktimes as $key => $tasktimesitem) {
														echo '<input type="text" class="form-control timeInput" name="schedTimesetDaily" value="'.$tasktimesitem[1].'"/>';
													}
													} else {
														echo '<input type="text" class="form-control timeInput" name="schedTimesetDaily"/>';
														} ?>
											<div>
											</div>
										</div>
									</div>
								</div>
								<div id="schedOption3" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">
											Schedule will be set for every day of month, excluding weekends.
											<?php if($taskSchedType == 3){
												$tasktimes = selectEditTaskTimes($globalTaskID);
												foreach ($tasktimes as $key => $tasktimesitem) {
													echo '<input type="text" class="form-control timeInput" name="schedTimesetNoWeekends" value="'.$tasktimesitem[1].'"/>';
												}
											} else {
												echo '<input type="text" class="form-control timeInput" name="schedTimesetNoWeekends"/>';
											} ?>
										<div>
										</div>
										</div>
									</div>
								</div>
								<div id="schedOption4" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">

											<?php if($taskSchedType == 4) {
												$weekdays = selectEditTaskWeedays($globalTaskID);
												$result = array();
												foreach ($weekdays as $key => $weekdaysitem) {
													$result = array_merge($result, $weekdaysitem);
												}
												for ($i=0; $i < 7; $i++) { 
													if ($i == 0) {$day = 'Monday';}
													elseif ($i == 1) {$day = 'Tuesday';}
													elseif ($i == 2) {$day = 'Wednesday';}
													elseif ($i == 3) {$day = 'Thursday';}
													elseif ($i == 4) {$day = 'Friday';}
													elseif ($i == 5) {$day = 'Staurday';}
													elseif ($i == 6) {$day = 'Sunday';}
													if(in_array($i, $result) ){
														echo '<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="'.$i.'" checked>'.$day.'</label>';
													}else{
														echo '<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="'.$i.'">'.$day.'</label>';
													}
												 }
											}else{
												for ($i=0; $i < 7; $i++) { 
													if ($i == 0) {$day = 'Monday';}
													elseif ($i == 1) {$day = 'Tuesday';}
													elseif ($i == 2) {$day = 'Wednesday';}
													elseif ($i == 3) {$day = 'Thursday';}
													elseif ($i == 4) {$day = 'Friday';}
													elseif ($i == 5) {$day = 'Staurday';}
													elseif ($i == 6) {$day = 'Sunday';}													
													echo '<label class="checkbox-inline"><input type="checkbox" name="schedWeekday[]" value="'.$i.'">'.$day.'</label>';
												}
											}
											?>
										</div>
										<!-- <input type='text' class="form-control timeInput" name="schedTimesetWeekday"/> -->
										<?php if($taskSchedType == 4){
											$tasktimes = selectEditTaskTimes($globalTaskID);
											foreach ($tasktimes as $key => $tasktimesitem) {
												echo '<input type="text" class="form-control timeInput" name="schedTimesetWeekday" value="'.$tasktimesitem[1].'"/>';
											}
										}else{
											echo '<input type="text" class="form-control timeInput" name="schedTimesetWeekday"/>';
										} ?>
										<div>
										</div>
									</div> 
								</div>
								<div id="schedOption5" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime" style="margin-left:10px">
											<?php if($taskSchedType == 5) {
												$weekdays = selectEditTaskMonthdays($globalTaskID);
												$result = array();
												foreach ($weekdays as $key => $weekdaysitem) {
													$result = array_merge($result, $weekdaysitem);
												}
												echo '<div class="row">';
												for ($i=1; $i < 32; $i++) {
													$a = sprintf("%02d", $i);
													if(in_array($i, $result) ){
														echo '<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="'.$i.'" checked> '.$a.' </label>';
													}else{
														echo '<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="'.$i.'"> '.$a.' </label>';
													}
													if (($i % 7) == 0)
														{echo '</div><div class="row">';}
												}
												echo '</div>';
											}else{
												echo '<div class="row">';
												for ($i=1; $i < 32; $i++) {
													$a = sprintf("%02d", $i);
													echo '<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="'.$i.'"> '.$a.' </label>';
													if (($i % 7) == 0){echo '</div><div class="row">';}
												} 
												echo '</div>';
											}
											?>

										</div>
										<?php if($taskSchedType == 5){
											$tasktimes = selectEditTaskTimes($globalTaskID);
											foreach ($tasktimes as $key => $tasktimesitem) {
												echo '<input type="text" class="form-control timeInput" name="schedTimesetMonthday" value="'.$tasktimesitem[1].'"/>';
											}
										}else{
											echo '<input type="text" class="form-control timeInput" name="schedTimesetMonthday"/>';
											} ?>
										<div>
										</div>
									</div>
								</div>
								<div id="schedOption6" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">
											<div class="customDateset">
												<?php 
												if($taskSchedType == 6){
													$customdays = selectEditTaskCustomdays($globalTaskID);
													foreach ($customdays as $key => $customdaysitem) {
														echo '<input type="text" class="form-control addedCustomDate" name="schedDatesetCustom[]" value="'.$customdaysitem[0].'"/>';
													}
												}
												?>
											</div>
										</div>
										<button type="button" id="addCustomDate" class="btn" style="margin: 20px 0 20px 20px">Add Date Line</button>
										<button type="button" id="removeCustomDate" class="btn" style="margin: 20px 0 20px 20px">Remove Date Line</button>
										<?php if($taskSchedType == 6){
											$tasktimes = selectEditTaskTimes($globalTaskID);
											foreach ($tasktimes as $key => $tasktimesitem) {
												echo '<input type="text" class="form-control timeInput" name="schedTimesetCustom" value="'.$tasktimesitem[1].'"/>';
											}
										} else {
											echo '<input type="text" class="form-control timeInput" name="schedTimesetCustom"/> <div></div>';
										} ?>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> Classification </h3>
				</div>
				<div class="panel-body">
					<label class="col-sm-2 control-label margin-top-5">System</label>
					<div class="col-sm-10">
						<select class="form-control" name="schedSystem">'
							<?php 
								$dropSystem = selectAll('classsystem', 2);
								foreach ($dropSystem as $key => $dropSystemItem) {
									if ($dropSystemItem[0] == $taskSystem){
										echo '<option value='.$dropSystemItem[0].' selected>'.$dropSystemItem[1].'</option>';
									}else{
										echo '<option value='.$dropSystemItem[0].' >'.$dropSystemItem[1].'</option>';
									}
								}
							?>
						</select>
					</div>

					<label class="col-sm-2 control-label margin-top-5">Country</label>
					<div class="col-sm-10">
						<select class="form-control" name="schedCountry">'
							<?php 
								$dropCountry = selectAll('classcountry', 2);
								foreach ($dropCountry as $key => $dropCountryItem) {
									if ($dropCountryItem[0] == $taskCountry){
										echo '<option value='.$dropCountryItem[0].' selected>'.$dropCountryItem[1].'</option>';
									}else{
										echo '<option value='.$dropCountryItem[0].' >'.$dropCountryItem[1].'</option>';
									}
								}
							?>
						</select>
					</div>

					<label class="col-sm-2 control-label margin-top-5">Functional Area</label>
					<div class="col-sm-10">
						<select class="form-control" name="schedFuncArea">'
							<?php 
								$dropFuncArea = selectAll('classfuncarea', 2);
								foreach ($dropFuncArea as $key => $dropFuncAreaItem) {
									if ($dropFuncAreaItem[0] == $taskFuncArea){
										echo '<option value='.$dropFuncAreaItem[0].' selected>'.$dropFuncAreaItem[1].'</option>';
									}else{
										echo '<option value='.$dropFuncAreaItem[0].' >'.$dropFuncAreaItem[1].'</option>';
									}
								}
							?>
						</select>
					</div>

					<label class="col-sm-2 control-label margin-top-5">Procedure</label>
					<div class="col-sm-10">
						<input id="schedProcName" type="text" class="form-control" placeholder="Task Name" name="schedProcedure" data-precedureid="<?php echo $taskProcedure ?>" data-toggle="modal" data-target="#schedProcedureModal" value="<?php echo selectEditTaskProcedure($taskProcedure)[0][0]; ?>">
						<div class="modal fade" id="schedProcedureModal" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Select Procedure</h4>
									</div>
										
									<div class="modal-body">
										<div>
											<?php
												$countryList = selectAll('classcountry');
												$countryID=1;
												foreach ($countryList as $key => $countrName) {
													echo '<div class="panel-group procedure-list-group radio">';
														echo '<div class="panel panel-primary">';
															echo '<div class="panel-heading">';
																echo '<h4 class="panel-title">';
																	echo '<a data-toggle="collapse" href="#collapse'.$countryID.'"><strong>'.$countrName[1].'</strong></a>';
																echo '</h4>';
															echo '</div>';
															echo '<div id="collapse'.$countryID.'" class="panel-collapse collapse">';
																echo '<ul class="list-group">';
																
																$funcAreaList = selectFuncArea($countrName[0]);
																$funcAreaID=1;
																foreach ($funcAreaList as $key => $funcAreaName){
																	echo '<li class="list-group-item procedure-task-type-item">';
																		echo '<div class="panel-heading">';
																			echo '<h4 class="panel-title">';
																				echo '<a data-toggle="collapse" href="#collapseFuncArea'.$countryID.''.$funcAreaID.'"><strong>'.$funcAreaName[1].'</strong></a>';
																			echo '</h4>';
																		echo '</div>';
																		echo '<div id="collapseFuncArea'.$countryID.''.$funcAreaID.'" class="panel-collapse collapse">';
																					echo '<ul class="list-group procedure-list-group">';
																						$procList = selectProcedure($countrName[0], $funcAreaName[2]);
																						foreach ($procList as $key => $procedureName) {
																						echo '<li class="list-group-item procedure-list-item">';
																							if ($procedureName[0] == $taskProcedure){
																								echo '<label><input type="radio" name="schedProcID" data-procid="'.$procedureName[1].'" value="'.$procedureName[0].'" checked>'.$procedureName[1].'</input></label>';
																							}else{
																								echo '<label><input type="radio" name="schedProcID" data-procid="'.$procedureName[1].'" value="'.$procedureName[0].'" >'.$procedureName[1].'</input></label>';
																							}
																						echo '</li>';
																						}
																					echo '</ul>';
																		echo '</div>';
																	echo '</li>';
																	$funcAreaID++;
																}
																echo '</ul>';
															echo '</div>';
															$countryID++;
														echo '</div>';
													echo '</div>';
												}
											?>
										</div>
									</div>
										
									<div class="modal-footer">
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<button type="button" class="btn btn-primary" id="schedAddProcedure" data-dismiss="modal">Add</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> Description </h3>
				</div>
				<div class="panel-body">
					<textarea class="form-control" name="schedDescription" rows="3" value="<?php echo $taskDescription; ?>"></textarea>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> History </h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<label class="col-sm-2 control-label">Created: </label>
						<div class="col-sm-7" name="schedCreator"><?php echo $taskCreateName; ?></div>
						<label class="col-sm-1 control-label">Date: </label>
						<div class="col-sm-2" name="schedCreateTime"><?php echo $taskCreateDate; ?></div>
					</div>
					<div class="row">
						<label class="col-sm-2 control-label">Last Modified: </label>
						<div class="col-sm-7"><?php echo $taskModName; ?></div>
						<label class="col-sm-1 control-label">Date: </label>
						<div class="col-sm-2"><?php echo $taskModDate; ?></div>
					</div>
				</div>
			</div>
		</form>
			<input  class="btn btn-default" type="submit" form="scheduleInsertForm" name="editSched" value="Create" style="margin-top: 5px">
	</div>

    <script type="text/javascript">
       	$(function () {
			$('.timeInput').each(function(){
				$(this).datetimepicker({
					locale: 'en',
					format: "HH:mm"	
				})
			});

			$('.timeset input').each(function () {
				$(this).datetimepicker({
					locale: 'en',
					format: "HH:mm"
				});
			});
			
			$('.customDateset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "YYYY-MM-DD"
					});
				});

      		$('#schedAddProcedure').on('click', function () {
				$('#schedProcName').val($('input[type="radio"][name="schedProcID"]:checked').data('procid'));
			})


			$('#addTime').on('click',function () {
				$('.timeset').append('<input type="text" class="form-control addedTime" name="schedTimeset[]"/>');
				$('.timeset input').each(function () {
					$(this).datetimepicker({
						locale: 'en',
						format: "HH:mm"
					});
				});
			});

			$('#removeTime').on('click',function () {
				$('.addedTime:last-child').remove();
			})


			$('#addCustomDate').on('click',function () {
				$('.customDateset').append('<input type="text" class="form-control addedCustomDate" name="schedDatesetCustom[]"/>');
				$('.customDateset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "YYYY-MM-DD"
					});
				});
			})

			$('#removeCustomDate').on('click',function () {
				$('.addedCustomDate:last-child').remove();
			})			
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
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
	<div class="container">
	<?php
		include_once('login_check.php');
		include_once('navigation.php');
		include_once('./js/js.php');
		include_once('./js/datepicker_js.php');
		include_once('./adds/queries.php');
	?>
	

		<form action="./adds/queries.php" enctype='multipart/form-data' method="post" role="form" autocomplete="off" id="scheduleInsertForm">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> Schedule </h3>
				</div>
				<div class="panel-body">
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
											format: "YYYY-MM-DD",
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
												<input type='text' class="form-control timeInput" name="schedTimesetDaily"/>
											<div>
											</div>
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
								<div id="schedOption5" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">
											<div class="row">
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="1"> 01 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="2"> 02 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="3"> 03 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="4"> 04 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="5"> 05 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="6"> 06 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="7"> 07 </label>
											</div>
											<div class="row">
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="8"> 08 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="9"> 09 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="10"> 10 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="11"> 11 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="12"> 12 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="13"> 13 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="14"> 14 </label>
											</div>
											<div class="row">
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="15"> 15 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="16"> 16 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="17"> 17 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="18"> 18 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="19"> 19 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="20"> 20 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="21"> 21 </label>
											</div>
											<div class="row">
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="22"> 22 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="23"> 23 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="24"> 24 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="25"> 25 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="26"> 26 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="27"> 27 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="28"> 28 </label>
											</div>
											<div class="row">
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="29"> 29 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="30"> 30 </label>
												<label class="checkbox-inline"><input type="checkbox" name="schedMonthday[]" value="31"> 31 </label>
											</div>
										</div>
										<input type='text' class="form-control timeInput" name="schedTimesetMonthday"/>
										<div>
										</div>										
									</div>
								</div>
								<div id="schedOption6" class="schedulingOptions">
									<div class="panel panel-default">
										<div class="panel-body addTime">
											<div class="customDateset">
												
											</div>
										</div>
										<button type="button" id="addCustomDate" class="btn" style="margin: 20px 0 20px 20px">Add Date Line</button>
										<button type="button" id="removeCustomDate" class="btn" style="margin: 20px 0 20px 20px">Remove Date Line</button>
									</div>
								</div>
							</div>
						</div>					
					<!-- </form> -->
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
								echo '<option value='.$dropSystemItem[0].'>'.$dropSystemItem[1].'</option>';
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
								echo '<option value='.$dropCountryItem[0].'>'.$dropCountryItem[1].'</option>';
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
								echo '<option value='.$dropFuncAreaItem[0].'>'.$dropFuncAreaItem[1].'</option>';
								}
							?>
						</select>
					</div>

					<label class="col-sm-2 control-label margin-top-5">Procedure</label>
					<div class="col-sm-10">
						<input id="schedProcName" type="text" class="form-control" placeholder="Task Name" name="schedProcedure" data-toggle="modal" data-target="#schedProcedureModal">
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
																							echo '<label><input type="radio" name="schedProcID" data-procid="'.$procedureName[1].'" value="'.$procedureName[0].'" checked="">'.$procedureName[1].'</input></label>';
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
					<textarea class="form-control" name="schedDescription" rows="3"></textarea>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> History </h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<label class="col-sm-1 control-label">Created: </label>
						<div class="col-sm-7" name="schedCreator"><?php echo $_SESSION['myusername']; ?></div>
						<label class="col-sm-1 control-label">Date: </label>
						<div class="col-sm-2" name="schedCreateTime"><?php echo date('Y/m/d H:i:s'); ?></div>
					</div>
					<div class="row">
						<label class="col-sm-1 control-label">Modified: </label>
						<div class="col-sm-7"><?php echo $_SESSION['myusername']; ?></div>
						<label class="col-sm-1 control-label">Date: </label>
						<div class="col-sm-2"><?php echo date('Y/m/d H:i:s'); ?></div>
					</div>
				</div>
			</div>
		</form>
			<input  class="btn btn-default" type="submit" form="scheduleInsertForm" name="newSched" value="Create" style="margin-top: 5px">
	</div>

    <script type="text/javascript">
       	$(function () {
			$('.timeInput').each(function(){
				$(this).datetimepicker({
					locale: 'en',
					format: "HH:mm"	
				})
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
				$('.customDateset').append('<input type="text" class="form-control addedCustomDate" name="schedCustomTimeset[]"/>');
				$('.customDateset input').each(function () {

					$(this).datetimepicker({
						locale: 'en',
						format: "YYYY-MM-DD HH:mm",
						sideBySide: true
					});
				});
			})

			$('#removeCustomDate').on('click',function () {
				$('.addedCustomDate:last-child').remove();
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
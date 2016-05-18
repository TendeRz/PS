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


	<script src="/root/PS/js/jquery-2.2.0.js"> </script>
	<script src="/root/PS/js/moment-with-locales.js"></script>
	<script src="/root/PS/js/bootstrap.js"></script>
	<script src="/root/PS/js/bootstrap-datetimepicker.js"></script>
</head>
<body>

	<?php 
		include_once('./adds/modal.php');
	 ?>

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
		
		<label class="col-sm-2 control-label margin-top-5">Subject</label>
		<div class="col-sm-6">
			<input id="schedProcID" type="text" class="form-control" placeholder="Task Name" name="schedProcedure" data-toggle="modal" data-target="#schedProcedureModal">



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
										include_once('./adds/queries.php');
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
																					echo '<label><input type="radio" name="schedProcName" value="'.$procedureName[1].'" checked="">'.$procedureName[1].'</input></label>';
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

		$(function () {
			$('#schedAddProcedure').on('click', function () {
				//$('#schedProcID').val($('#schedprocedure').val());
				$('#schedProcID').val($('input[type="radio"][name="schedProcName"]:checked').val());
			})
		})

	</script>

	<script type="text/javascript">
		
	</script>






</body>
</html>




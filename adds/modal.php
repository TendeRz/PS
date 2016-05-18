
<div class="modal fade" id="newSystemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Set New System</h4>
			</div>
				
			<div class="modal-body">
				<form action="./adds/queries.php" method="post" role="form" autocomplete="off" id="newSystemForm">
					<div class="form-group">
						<div class="input-group">
							<span class="glyphicon glyphicon-floppy-disk input-group-addon" style="top:0px;"></span>
							<input id="newSystemInput" name="newSystem" type="text" class="form-control mailInput" placeholder="System..." onChange="addNewAddition(this.value, this, 'system')">
							<span class="glyphicon glyphicon-remove-circle input-group-addon additionSpan" style="top:0px;"></span>
						</div>
					</div>
				</form>
			</div>
				
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" form="newSystemForm" id="registerSystem" class="btn btn-primary newAddition" disabled="true">Add</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="newCountryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Set New Country</h4>
			</div>
				
			<div class="modal-body">
				<form action="./adds/queries.php" method="post" role="form" autocomplete="off" id="newCountryForm">
					<div class="form-group">
						<div class="input-group">
							<span class="glyphicon glyphicon-floppy-disk input-group-addon" style="top:0px;"></span>
							<input id="newCountryInput" name="newCountry" type="text" class="form-control mailInput" placeholder="Country..." onChange="addNewAddition(this.value, this, 'Country')">
							<span class="glyphicon glyphicon-remove-circle input-group-addon additionSpan" style="top:0px;"></span>
						</div>
					</div>
				</form>
			</div>
				
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" form="newCountryForm" id="registerCountry" class="btn btn-primary newAddition" disabled="true">Add</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="newFuncAreaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Set New Functional Area</h4>
			</div>
				
			<div class="modal-body">
				<form action="./adds/queries.php" method="post" role="form" autocomplete="off" id="newFuncAreaForm">
					<div class="form-group">
						<div class="input-group">
							<span class="glyphicon glyphicon-floppy-disk input-group-addon" style="top:0px;"></span>
							<input id="newFuncAreaInput" name="newFuncArea" type="text" class="form-control mailInput" placeholder="Functional Area..." onChange="addNewAddition(this.value, this, 'FuncArea')">
							<span class="glyphicon glyphicon-remove-circle input-group-addon additionSpan" style="top:0px;"></span>
						</div>
					</div>
				</form>
			</div>
				
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" form="newFuncAreaForm" id="registerFuncArea" class="btn btn-primary newAddition" disabled="true">Add</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- <div class="modal fade" id="schedProcedure" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Select Procedure</h4>
			</div>
				
			<div class="modal-body">
				<input id="schedprocedure" class="form-control" placeholder="Task Name">
				<div>
						<?php
							include_once('./js/js.php');		
							include_once('./adds/queries.php');
							$countryList = selectAll('classcountry');
							$countryID=1;
							foreach ($countryList as $key => $countrName) {
								echo '<div class="panel-group procedure-list-group">';
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
																				echo '<a href="procedure.php?procID='.$procedureName[0].'&procName='.$procedureName[1].'" target="_blank">'.$procedureName[1].'</a>';

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
</div> -->
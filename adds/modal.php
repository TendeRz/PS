
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

<div class="modal fade" id="noCountriesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Error!</h4>
			</div>
			<div class="modal-body">
				Please Select Country!
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">						
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>			
		</div>	
	</div>
</div>

<div class="modal fade" id="newstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Set new status!</h4>
			</div>
			<div class="modal-body">		
				<?php
                echo '<div class="row">';
                    $dropstatus = selectprogressstate();
                    echo '<div class="col-xs-2">Status  </div><div>';
                        echo '<select>';
                            foreach ($dropstatus as $key => $dropstatusItem) {
                            echo '<option value='.$dropstatusItem[0].'>'.$dropstatusItem[1].'</option>';
                            }
                        echo '</select>';                        
                    echo'</div>';
                echo'</div>';
                ?>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">						
						<button type="button" data-toggle="modal" data-target="#newstatus" class="btn btn-primary" id="newstate" onClick="progresstaskstate(this)">Set Status</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>			
		</div>	
	</div>
</div>
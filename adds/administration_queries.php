<?php
session_start();
include_once('const.php');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
if(isset($link)){
}else{
	die('Connection Error!');
}

if (ISSET($_POST['userModalID'])){
	selectUser($_POST['userModalID']);
}

function selectAllUsers($userID){
	global $link;

	$sql = "SELECT * FROM authorization WHERE id LIKE '$userID'";
	if (mysqli_query($link, $sql)) {
		return(mysqli_fetch_all($link->query($sql)));
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

	mysqli_close($link);
}


function selectSecurityGroups(){
	global $link;
	$sql = "SELECT * FROM securitygroups";

	if (mysqli_query($link, $sql)) {
		return(mysqli_fetch_all($link->query($sql)));
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

	mysqli_close($link);
}


function selectUser($userID){
	global $link;

	$sql = "SELECT * FROM authorization WHERE id LIKE '$userID'";
	if (mysqli_query($link, $sql)) {
		$data = mysqli_query($link, $sql);
		while ($row = mysqli_fetch_array($data)) {
			echo '
			<div class="modal-body">
				<div class="form-group profile-update">
					<label for="profileUpdateUsername" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-7">
						<input name="profileUpdateUsername" type="text" class="form-control" value="'.$row['username'].'" placeholder="Enter Username" onChange="#">
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>
				<div class="form-group profile-update">
					<label for="profileUpdateName" class="col-sm-2 control-label">Name</label>
					<div class="col-sm-7">
						<input name="profileUpdateName" type="text" class="form-control" value="'.$row['name'].'" placeholder="Enter Name" onChange="#">
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>
				<div class="form-group profile-update">
					<label for="profileUpdateSurname" class="col-sm-2 control-label">Surname</label>
					<div class="col-sm-7">
						<input name="profileUpdateSurname" type="text" class="form-control" placeholder="Enter Surname" value="'.$row['surname'].'" onChange="#">
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>  
				<div class="form-group profile-update">
					<label for="profileUpdateEmail" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-7">
						<input name="profileUpdateEmail" type="email" class="form-control" placeholder="Enter Emails" value="'.$row['email'].'" onChange="#">
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>
				<div class="form-group profile-update">
					<label for="profileUpdatePassword" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-7">
						<input name="profileUpdatePassword" type="password" class="form-control" placeholder="Enter Password" onChange="#">
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>
				<div class="form-group profile-update">
					<label for="profileUpdateGroup" class="col-sm-2 control-label">Group</label>
					<div class="col-sm-7">
						<select name="Group" class="form-control">';
							
							$dropSecurityGroup = selectSecurityGroups();
							foreach ($dropSecurityGroup as $key => $dropSecurityGroupItem) {
								if($dropSecurityGroupItem[0] == $row['access']) {
									echo '<option value='.$dropSecurityGroupItem[0].' selected>'.$dropSecurityGroupItem[1].'</option>';
								}else{
									echo '<option value='.$dropSecurityGroupItem[0].'>'.$dropSecurityGroupItem[1].'</option>';
								}
							}
							echo '
						</select>
					</div>
					<button class="btn btn-default btn-xs security-group-button" type="button">Update</button>
				</div>
			</div>
			';
		}
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
}

?>





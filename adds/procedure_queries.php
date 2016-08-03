<?php 

session_start();
include_once('const.php');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
if(isset($link)){
}else{
	die('Connection Error!');
}

   //New Procedure
if (ISSET($_POST['newProcedure'])){

	echo $version = $_POST['procversion']+1;
	echo "<br> New Procedure Inserted -> Insert<br>";
	insertNewProcedure(1, 0, $version);
}

    //straight update from planners
if (ISSET($_POST['updateProcedure'])) {
	switch ($_POST['procstate']){
		case 1:
			//echo "<br> Active Procedure Updated -> Insert<br>";			
			$version = $_POST['procversion']+1;
			insertNewProcedure(1, 1, $version);
			break;
		case 3:
			//echo "<br> Draft Updated -> Update<br>";			
			$version = ceil($_POST['procversion']);
			updateSaveProcedure(1, $version);
			break;
		default:
			echo "Action not recognized!";
			spoolPOST1();
			break;
	}
}

    //send for approval
if (ISSET($_POST['sendForApproval'])) {
	switch ($_POST['procstate']){
		case 0:
			//echo "<br> New Procedure Sent for approval -> Insert<br>";
			$version = $_POST['procversion']+0.01;
			insertNewProcedure(4, 0, $version);
			break;
		case 1:
			//echo "<br> Active Procedure Sent for approval -> Insert<br>";			
			$version = $_POST['procversion']+0.01;
			insertNewProcedure(4, 1, $version);
			break;
		case 3:
			//echo "<br> Draft Sent for approval -> Update<br>";			
			$version = $_POST['procversion']+0.01;
			updateSaveProcedure(4, $version);
			break;
		default:
			echo "Action not recognized!";
			spoolPOST1();
			break;
	}
}


    //save as draft
if (ISSET($_POST['saveProcedure'])) {
	switch ($_POST['procstate']){
		case 0:
			//echo "<br> New Procedure save -> Insert with reserved ID<br>";			
			$version = $_POST['procversion']+0.01;
			insertNewProcedure(3, 0, $version);
			break;
		case 1:
			//echo "<br> Active Procedure save -> Insert <br>";			
			$version = $_POST['procversion']+0.01;
			insertNewProcedure(3, 1, $version);
			break;
		case 3:
			//echo "<br> Draft save -> Update<br>";			
			$version = $_POST['procversion']+0.01;
			updateSaveProcedure(3, $version);
			break;
		default:
			echo "Action not recognized!";
			spoolPOST1();
			break;
	}
}        


    //approve procedure
if (ISSET($_POST['procedureApprove'])){
	$version = ceil($_POST['procversion']);
	updateProcedure(1, $version);
}


    //reject procedure
if (ISSET($_POST['procedureReject'])){
	$version = $_POST['procversion'];
	updateProcedure(2, $version);
}

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////     GLOBAL     /////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

$reserveProcedureID;


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////    FUNCTIONS   /////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////



function updateProcedure($state, $version){
	global $link;
	$procArchiveId = $_POST['procarchid'];

	$sql = "UPDATE proceduresarchive SET procstate = '$state', procversion = '$version' WHERE procarchid = '$procArchiveId'";

	if (mysqli_query($link, $sql)) {
		header('Location: /root/PS/procedure_list.php');
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
}



function insertNewProcedure($state, $check, $version){
	global $reserveProcedureID, $link;

	$procid = $_POST['procid'];
	$title = $_POST['procTitle'];
	$system = $_POST['System'];
	$country = $_POST['Country'];
	$funcarea = $_POST['FuncArea'];
	$descript = $_POST['procDescript'];
	$dependecies = $_POST['procDependecies'];
	$access = $_POST['procAccess'];
	$description = $_POST['procDescription'];
	$troubleshoot = $_POST['procTroubleshooting'];
	$impact = $_POST['procImpact'];

	$editor = $_SESSION['myusername'];

	if ($check == 0){
		insertReserveID();

		$sql="INSERT INTO proceduresarchive
		(procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
		ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatename, procmodname )
		VALUES
		('$reserveProcedureID', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
		'$description', '$troubleshoot', '$impact', '$state', '$version', '$editor', '$editor')";

	}else{
		$sql="INSERT INTO proceduresarchive
		(procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
		ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatename, procmodname )
		VALUES
		('$procid', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
		'$description', '$troubleshoot', '$impact', '$state', '$version', '$editor', '$editor')";
	}

	if (mysqli_query($link, $sql)) {
		mysqli_commit($link);
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}else{
		echo "SQL:<br> " . $sql . "<br> Error: <br>" . mysqli_error($link);
	}
	mysqli_close($link);
}

function updateSaveProcedure($state, $version){
	global $reserveProcedureID, $link;

	$procid = $_POST['procid'];
	$title = $_POST['procTitle'];
	$system = $_POST['System'];
	$country = $_POST['Country'];
	$funcarea = $_POST['FuncArea'];
	$descript = $_POST['procDescript'];
	$dependecies = $_POST['procDependecies'];
	$access = $_POST['procAccess'];
	$description = $_POST['procDescription'];
	$troubleshoot = $_POST['procTroubleshooting'];
	$impact = $_POST['procImpact'];
	$editor = $_SESSION['myusername'];

		$sql="UPDATE proceduresarchive
			SET
				ProcTitle = '$title',
				ProcSystem = '$system',
				ProcCountry = '$country',
				ProcFuncArea = '$funcarea',
				ProcDescript = '$descript',
				ProcDependecies = '$dependecies',
				ProcAccess = '$access',
				ProcDescription = '$description',
				ProcTroubleshooting = '$troubleshoot',
				ProcImpact = '$impact',
				procstate = '$state',
				procversion = '$version',
				procmodname = '$editor'
			WHERE
				procarchid = $procid";

	if (mysqli_query($link, $sql)) {
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}else{
		echo "SQL:<br> " . $sql . "<br> Error: <br>" . mysqli_error($link);
	}
	mysqli_close($link);
}


function insertReserveID(){
	global $reserveProcedureID, $link;
	mysqli_autocommit($link, FALSE);
	mysqli_query($link, "INSERT INTO procedures () VALUES ()");
	$reserveProcedureID = mysqli_fetch_assoc(mysqli_query($link, "SELECT LAST_INSERT_ID() as ID;"))['ID'];
	mysqli_rollback($link);
}

function spoolPOST1(){

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo '<br>';
    echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Back</a>';
}
?>
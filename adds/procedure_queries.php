<?php 

session_start();
include_once('const.php');



   //New Procedure
if (ISSET($_POST['newProcedure'])){
	$version = $_POST['procversion']+1;
	insertNewProcedure(1, 0, '$version');
}

    //straight update from planners
if (ISSET($_POST['updateProcedure'])) {
	$version = ceil($_POST['procversion']);
	insertNewProcedure(1, 1, '$version');
}

    //send for approval
if (ISSET($_POST['sendForApproval'])) {
	$version = $_POST['procversion']+0.01;
	insertNewProcedure(4, 1, '$version');
}


    //save as draft
if (ISSET($_POST['saveProcedure'])) {
	switch ($_POST['procstate']) {
		case 1:
		$version = $_POST['procversion']+0.01;
		insertNewProcedure(3, 0, '$version');
		break;
		case 3:
		$version = $_POST['procversion'];
		updateProcedure(3, 1, '$version');
		break;
		default:
		spoolPOST();
		break;
	}        
}

    //approve procedure
if (ISSET($_POST['procedureApprove'])){
	$version = ceil($_POST['procversion']);
	updateProcedure(1, '$version');
}


    //reject procedure
if (ISSET($_POST['procedureReject'])){
	$version = $_POST['procversion'];
	updateProcedure(2, '$version');
}

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////     GLOBAL     /////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

$reserveProcedureID;

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
if(isset($link)){
}else{
	die('Connection Error!');
}
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


	$date = date('Y/m/d H:i:s', time());
	$editor = $_SESSION['myusername'];

	if ($check == 0){
		insertReserveID();

		$sql="INSERT INTO proceduresarchive
		(procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
		ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
		VALUES
		('$reserveProcedureID', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
		'$description', '$troubleshoot', '$impact', '$state', '$version', '$date', '$editor', '$editor')";

	}else{
		$sql="INSERT INTO proceduresarchive
		(procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
		ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
		VALUES
		('$procid', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
		'$description', '$troubleshoot', '$impact', '$state', '$version', '$date', '$editor', '$editor')";
	}

	if (mysqli_query($link, $sql)) {
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
}


function insertReserveID(){
	global $reserveProcedureID, $link;
	$sql_1 = "START TRANSACTION";
	$sql_2 = "INSERT INTO procedures () VALUES ()";
	$sql_3 = "ROLLBACK";
	if (mysqli_query($link, $sql_1)) {
		if (mysqli_query($link, $sql_2)) {
			if (mysqli_query($link, $sql_3)) {
				$reserveProcedureID = mysqli_fetch_assoc(mysqli_query($link, "SELECT LAST_INSERT_ID();"));
			}else{
				echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	} 
}




?>
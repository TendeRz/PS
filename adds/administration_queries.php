<?php
session_start();
include_once('const.php');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
if(isset($link)){
}else{
	die('Connection Error!');
}


function selectUsers($userID){
	global $link;

	$sql = "SELECT * FROM authorization WHERE id LIKE '$userID'";
	if (mysqli_query($link, $sql)) {
		return(mysqli_fetch_all($link->query($sql)));
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}

	mysqli_close($link);
}


?>


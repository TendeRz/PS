<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Task List</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">	

</head>
<body>
	<div class="container">
	<?php
		include_once('login_check.php');
		include_once('navigation.php');
		include_once('./js/js.php');		
		include_once('./adds/queries.php');
	?>

		<table class="table table-hover"> 
			<thead> 
				<tr> 
					<th>Start Date</th> 
					<th>Start Time</th> 
					<th>Country</th>
					<th>Subject</th>
					<th>Status</th>
					<th>System</th>
				</tr> 
			</thead> 
			<tbody> 
	<?php 
		$taskList = selectTaskList();
		$counter = 1;
		foreach ($taskList as $key => $taskListItem) {
			$startDate = $taskListItem[0];
			$startTime = $taskListItem[1];
			$country = $taskListItem[2];
			$subject = $taskListItem[3];
			$status = $taskListItem[4];
			$system = $taskListItem[5];
		echo
 				"<tr> 
					<td>".$startDate."</td> 
					<td>".$startTime."</td> 
					<td>".$country."</td> 
					<td>".$subject."</td> 
					<td>".$status."</td> 
					<td>".$system."</td> 
				</tr>";
				 }?>
			</tbody> 
		</table>



	</div>
</body>
</html>
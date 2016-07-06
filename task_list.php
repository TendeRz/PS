
<?php
session_start();
?>

<html lang="en">
<head>
	<title>Task List</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />	
</head>
<body>
	<div class="container">
		<?php
		include_once('login_check.php');
		include_once('navigation.php');
		include_once('./adds/queries.php');
		
		?>
		

	<?php
		$systemList = selectAll('classsystem');
		$systemID=1;
		foreach ($systemList as $key => $systemName) {
			echo '<div class="panel-group procedure-list-group">';
				echo '<div class="panel panel-primary">';
					echo '<div class="panel-heading">';
						echo '<h4 class="panel-title">';
							echo '<a data-toggle="collapse" href="#collapse'.$systemID.'"><strong>'.$systemName[1].'</strong></a>';
						echo '</h4>';
					echo '</div>';
					echo '<div id="collapse'.$systemID.'" class="panel-collapse collapse">';
						echo '<ul class="list-group">';
						
						$countryList = selectEditCountry($systemName[0]);
						$countryID=1;
						foreach ($countryList as $key => $countryName){
						

									echo '<li class="list-group-item procedure-task-type-item">';
										echo '<div class="panel-heading">';
											echo '<h4 class="panel-title">';
												echo '<a data-toggle="collapse" href="#collapseFuncArea'.$systemID.''.$countryID.'"><strong>'.$countryName[1].'</strong></a>';
											echo '</h4>';
										echo '</div>';
										echo '<div id="collapseFuncArea'.$systemID.''.$countryID.'" class="panel-collapse collapse">';
													echo '<ul class="list-group procedure-list-group">';
														echo '<table class="table table-hover" style="margin-bottom: 0;">';													
														$taskList = selectEditTaskList($systemName[0], $countryName[2]);
														foreach ($taskList as $key => $taskListItem) {
															echo '<tr style="font-size: 90%">';																
																	echo '<td class="col-sm-1" style="padding:0; text-align: center"><span class="glyphicon '.($taskListItem[3] == 0 ? 'glyphicon-ok' : 'glyphicon-remove').'" ></span></td>';
																	echo '<td class="col-sm-8" style="padding:0"> <a href="edit_task.php?taskID='.$taskListItem[0].'" target="_blank">'.$taskListItem[1].'</a> </td>';
																	echo '<td class="col-sm-2" style="padding:0">' .$taskListItem[2]. '</td>';
															echo '</tr>';
														}
														echo '</table>';
													echo '</ul>';
										echo '</div>';
									echo '</li>';
									$countryID++;
						}
						echo '</ul>';
					echo '</div>';
					$systemID++;
				echo '</div>';
			echo '</div>';
		}
	?>
	</div>



	<script>

	</script>
	<?php 
		include_once('./js/js.php');
	?>
</body>
</html>
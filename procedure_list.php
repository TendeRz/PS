<!DOCTYPE html>

<html lang="en">
<head>
	<title>Procedure Storage</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css"></head>
<body>
	<?php
		include_once('./adds/queries.php');
	?>
	<div class="container" style="margin-top: 20px;">
	

	<?php
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
															//echo '<br> CountryID: '.$countrName[0].' FuncID: '.$funcAreaName[2].' ProcID: '.$procedureName[0].' ';
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
	<?php
		include_once('./js/js.php');
	?>
</body>
</html>

<div class="modal-body">
	<div>
		<?php
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
					echo '<label><input type="radio" name="schedProcID" data-procid="'.$procedureName[1].'" value="'.$procedureName[0].'" checked="">'.$procedureName[1].'</input></label>';
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




    function selectProcedure($country_id, $func_id){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT procid, proctitle FROM procedures WHERE proccountry = '$country_id' AND procfuncarea = '$func_id'";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
    }




    function procedure($procid){
    	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
    	$sql="SELECT * FROM procedures WHERE procid='$procid'";
    	return(mysqli_fetch_all($link->query($sql)));
		mysqli_close($link);
    }
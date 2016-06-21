<?php 
    session_start();
	include_once('const.php');
	$username = $_SESSION['myusername'];

	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
	if(isset($link)){
	}else{
		die('Connection Error!');
	}

	if (ISSET($_POST['selected'])){
        selectCountries();
    }

    if (ISSET($_POST['qprogtasklistid'])){
    	quickprogresstaskstate($_POST['qprogtasklistid'], $_POST['qprogtaskid']);
    }

    if (ISSET($_POST['progresstatus'])){
    	progresstaskstate($_POST['progresstatus'], $_POST['progresstasklistid'], $_POST['progresstaskid'], $_POST['progresscomment']);
    	//spoolPOST2();
    }
#############################################
############### FUNCTIONS ################
#############################################

    function selectCountries(){
        global $link;
        $sql="SELECT               
                CONCAT(LPAD(MONTH(TL.tlistfulldate),2,0),'/',LPAD(DAYOFMONTH(TL.tlistfulldate),2,0)) AS Startdate,
                TIME_FORMAT(TL.tlisttime, '%H:%i') AS Starttime,
                CC.ClassCountryName AS Country,
                TL.taskname AS Subject,
                TS.taskstate AS Status,
                CS.ClassSysName AS System,
                TL.tasklistid AS ID,
                TL.taskid AS Taskid,
                IF(LENGTH(TLHR.modifyname)>0, TLHR.modifyname, TL.tlistcreatename) as Lastmod,
                TLHR.tasklisthistoryid,
                TLHR.rank
                FROM 	classcountry CC,
                		classfuncarea CF,
                		classsystem CS,
                		taskstate TS,
                		procedures P, 
                		tasklist TL LEFT JOIN               		
                		(SELECT 	
                				tasklisthistoryid,
								tasklistid,
								CASE
								WHEN @prevRank = tasklistid THEN @curRank := @curRank + 1
								WHEN @prevRank := tasklistid THEN @curRank := 0 
								END AS rank,
								taskid,
								modifydate,
								modifyname,
								modifystate,
								modifycomment

						FROM 	tasklisthistory,
								(SELECT @curRank :=0, @prevRank := NULL) r
						ORDER BY tasklistid, tasklisthistoryid DESC) TLHR ON TL.tasklistid = TLHR.tasklistid
                WHERE
                    TL.tlistsystem = CS.classsysid
                    AND
                    TL.tlistcountry = CC.classcountryid
                    AND
                    TL.tlistfuncarea = CF.classfuncid
                    AND
                    TL.tliststate = TS.taskstateid
                    AND
                    TL.tlistprocedure = P.procid
                    AND
                    TL.tliststate IN (0, 1, 2, 4, 7)
                    AND
                    CC.classcountryid IN (".$_POST['selected'].")                    
                    AND
                    (TLHR.rank = 0 || TLHR.rank IS NULL)
                ORDER BY TL.tlistfulldate, TL.tlisttime; ";
        
        if (mysqli_query($link, $sql)) {
        	echo '
				<table class="table table-hover"> 
					<thead> 
						<tr> 
							<th>Start Date</th> 
							<th>Start Time</th> 
							<th>Country</th>
							<th>Subject</th>
							<th>Status</th>
							<th>System</th>
							<th>Modified</th>
							<th>Progress</th>
						</tr>
					</thead>
					<tbody>
        		';
        	$data = mysqli_query($link, $sql);
        	while ($row = mysqli_fetch_array($data)) {
			echo '
						<tr class="taskrow"> 
							<td class="taskdate">'.$row['Startdate'].'</td> 
							<td class="tasktime">'.$row['Starttime'].'</td> 
							<td>'.$row['Country'].'</td>
							<td><a href="task.php?taskid='.$row['ID'].'" target="_blank">'.$row['Subject'].'</a></td>					
							<td class="status">'.$row['Status'].'</td> 
							<td>'.$row['System'].'</td>
							<td>'.$row['Lastmod'].'</td>
							<td> <button class="btn btn-default btn-xs" type="button" data-taskid="'.$row['Taskid'].'" data-tasklistid="'.$row['ID'].'" onClick="quickprogresstaskstate($(this))">Next</button></td>
						</tr>
				';
			}
			echo '
					</tbody>
				</table>
				';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    mysqli_close($link);
    };
	
    function quickprogresstaskstate($tasklistid, $taskid){    	
    	global $link, $username;    	

    	$sql="UPDATE tasklist SET tliststate = 2 WHERE tasklistid = '$tasklistid'";
    	$sql2="INSERT INTO tasklisthistory (taskid, tasklistid, modifyname, modifystate, modifycomment) VALUES ('$taskid', '$tasklistid', '$username', '2', 'Started' )";
    	if (mysqli_query($link, $sql)) {
    		if (mysqli_query($link, $sql2)){
    		echo "done";
    		} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($link);
    		}
    	}  else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($link);
    	}
    mysql_close($link);
    }

    function progresstaskstate($taskstate, $tasklistid, $taskid, $comment){
    	global $link, $username;

    	$sql="UPDATE tasklist SET tliststate = '$taskstate' WHERE tasklistid = '$tasklistid'";
    	$sql2="INSERT INTO tasklisthistory (taskid, tasklistid, modifyname, modifystate, modifycomment) VALUES ('$taskid', '$tasklistid', '$username', '$taskstate', '$comment' )";
    	if (mysqli_query($link, $sql)) {
    		if (mysqli_query($link, $sql2)){
    		echo "done";
    		} else {
    			echo "Error: " . $sql . "<br>" . mysqli_error($link);
    		}
    	}  else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($link);
    	}
    mysql_close($link);
    }

	function spoolPOST2(){

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

    };
 ?>
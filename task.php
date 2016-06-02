<?php
session_start();
?>

<html lang="en">
<head>
	<title>Task</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<?php $taskid = $_GET['taskid']; ?>
</head>
<body>
	<?php 
		include_once('login_check.php');
        include_once('./adds/queries.php');
    ?>
    <div class="container">
    	<?php include_once('navigation.php');
    		$selectTask = selectTask($taskid);
    		foreach ($selectTask as $key => $selectTaskItem) {
    			$taskname = $selectTaskItem[0];
    			$taskstartdate = $selectTaskItem[1];
    			$taskstate = $selectTaskItem[2];
    			$tasksystem = $selectTaskItem[3];
    			$taskfuncarea = $selectTaskItem[4];
    			$taskcountry = $selectTaskItem[5];
    			$taskproctitle = $selectTaskItem[6];
    			$taskprocid = $selectTaskItem[7];
    			$taskdescription = $selectTaskItem[8];
    			$taskcreatedate = $selectTaskItem[9];
    			$taskcreatename = $selectTaskItem[10];
    		}
    	?>



    	<div class="panel panel-default">
    		<div class="panel-heading">Description</div>
    		<div class="panel-body">
    			<div class="col-sm-2">Subject: </div>
    			<div class="col-sm-10"><?php echo $taskname ?></div>
    			<div class="col-sm-2">Start Date: </div>
    			<siv class="col-sm-10"><?php echo $taskstartdate ?></siv>
    			<div class="col-sm-2">Status:  </div>
    			<siv class="col-sm-10"><?php echo $taskstate ?></siv>
    		</div>
    	</div>
    	<div class="panel panel-default">
    		<div class="panel-heading">Classification</div>
    		<div class="panel-body">
    			<div class="col-sm-2">System: </div>
    			<div class="col-sm-4"><?php echo $tasksystem ?></div>
    			<div class="col-sm-2">Functional Area: </div>
    			<div class="col-sm-4"><?php echo $taskfuncarea ?></div>
    			<div class="col-sm-2">Country: </div>
    			<div class="col-sm-10"><?php echo $taskcountry ?></div>
    		</div>
    	</div>
    	<div class="panel panel-default">
    		<div class="panel-heading">Procedure</div>
    		<div class="panel-body">
    			<div class="col-sm-2">Procedure</div>
    			<div class="col-sm-10"><?php echo '<a href="procedure.php?procID='.$taskprocid.'&procName='.$taskproctitle.'" target="_blank">'.$taskproctitle.'</a>' ?></div>
    		</div>
    	</div>
    	<div class="panel panel-default">
    		<div class="panel-heading">Detailed Description</div>
    		<div class="panel-body"><?php echo $taskdescription ?></div>
    		<div class="panel-body">
    			<textarea class="form-control" rows="3" placeholder="IF got any.."></textarea>
    		</div>
    	</div>
    	<div class="panel panel-default">
    		<div class="panel-heading">History</div>
    		<div class="panel-body">
    			<div class="col-sm-2"><?php echo $taskcreatedate ?></div>
    			<div class="col-sm-4"><?php echo $taskcreatename ?></div>
    			<div class="col-sm-4">What</div>
    		</div>
    	</div>
    </div>
    <?php
            include_once("/js/js.php");
        ?>
</body>
</html>
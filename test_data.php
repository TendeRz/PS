
<!DOCTYPE html>

<html lang="en">
<head>
	<title>Test Task List</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">

</head>
<body>
	<?php
		include_once('./adds/queries.php');
		include_once('./js/js.php');

	?>
	<div class="container">
		<div>
			<?php
			$now = strtotime("yesterday");
			$pushToFirst = -1;
			for($i = $pushToFirst; $i < $pushToFirst+3; $i++)
			{
				$now = strtotime("+".$i." day");
				$year = date("Y", $now);
				$month = date("m", $now);
				$day = date("d", $now);
				$nowString = $year . "-" . $month . "-" . $day;
				$week = (int) ((date('d', $now) - 1) / 7) + 1;
				$weekday = date("N", $now);
        		
        		echo $nowString . "<br />";
        		echo "Year :" . $year . "<br/>";
        		echo "Month :" . $month . "<br/>";
        		echo "Week :" . $week . "<br/>";
        		echo "Day :" . $day . "<br/>";
        		
			}
			?>
		</div>

		<div>
			<?php 
				$tasklist = selectTasks();
				foreach ($tasklist as $key => $value) {
					echo $value[0] . '<br/>';
					echo $value[1] . '<br/>';
					echo $value[2] . '<br/>';
				}
			?>
		</div>
	</div>

</body>
</html>
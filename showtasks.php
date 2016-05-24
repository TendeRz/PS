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

	<?php 
		$showtaks = selecttasklistz();
		foreach ($showtaks as $key => $showtaksitems) {
			$id			= $showtaksitems[0];
			$name		= $showtaksitems[1];
			$state		= $showtaksitems[2];
			$system		= $showtaksitems[3];
			$country	= $showtaksitems[4];
			$funcarea	= $showtaksitems[5];
			$procedure	= $showtaksitems[6];
			$descript	= $showtaksitems[7];
		}
	 ?>

		<div><?php echo $id		?></div>
		<div><?php echo $name	?></div>
		<div><?php echo $state	?></div>
		<div><?php echo $system	?></div>
		<div><?php echo $country ?></div>
		<div><?php echo $funcarea ?></div>
		<div><?php echo $procedure ?></div>
		<div><?php echo $descript ?></div>
	</div>
</body>
</html>
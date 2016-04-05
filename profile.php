
<?php
	session_start();
?>

<html lang="en">
	<head>
		<title>Profile</title>
		<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	</head>
	<body>
		<div class="container">
			<?php 
				include_once('navigation.php');
				include_once('./js/js.php');
				include_once('./adds/queries.php');

				$uzername = $_SESSION['myemail'];
				$profileInfo = selectProfile($uzername);
				foreach ($profileInfo as $key => $profileItem) {
                    $profID = $profileItem[0];
                    $profUsername = $profileItem[1];
                    $profPassword = $profileItem[2];
                    $profName = $profileItem[3];
                    $profSurname = $profileItem[4];
                }
			?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"> Welcome Back, <?php echo $profName ?>! </h3>
				</div>
				<div class="panel-body">
					<div class="col-md-2">
						<img class="avatar" src="./adds/queries.php?usrID=<?php print_r($_SESSION['myemail']); ?>">
					</div>
					<ul class="col-md-1">
						<li>Username: </li>
						<li>Name: </li>
						<li>Surname: </li>
						<li>Password: </li>
						
					</ul>
					<ul class="col-md-9" style="list-style: none">
						<li><?php echo $profUsername ?></li>
						<li><?php echo $profName ?></li>
						<li><?php echo $profSurname ?></li>
						<li><?php echo $profPassword ?></li>						
					</ul>
					<div>
						<button class="button button-primary">Update Picture</button>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
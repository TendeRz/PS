
<?php
	session_start();
?>

<html lang="en">
	<head>
		<title>Index</title>
		<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	</head>
	<body>
		<div class="container">
		<?php
			if(ISSET($_SESSION['myusername'])){
				include_once('navigation.php');
		?>	
					<div>
						<ul class="nav navbar-nav">
							<li><a href="procedure_list.php">Procedure Storages</a></li>
							<li><a href="#">Task Planner</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
						<button id="logoutBTN" class="btn btn-primary" onClick="location.href='logout.php'">Logout</button>
					</div>
			<?php 
				}else{
					include_once('login.php');
				}
			?>
		</div>

		<?php 
			include_once('./js/js.php');
		?>
	</body>
</html>
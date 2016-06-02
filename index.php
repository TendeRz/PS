
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
					<div class="container">
					<img src="/root/PS/img/JB.jpg" alt="JB">
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
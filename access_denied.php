
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
			<div class="alert alert-danger middle margin-top-200" role="alert">
				<strong>Access Denied!</strong> You forgot to Login!
			</div>

			<div class="middle">
				Please: <button id="returnToIndex" class="btn btn-primary" onClick="location.href='index.php'">Login!</button>
			</div>
		</div>			
	</body>
</html>
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

		<table class="table table-hover"> 
			<thead> 
				<tr> 
					<th>#</th> 
					<th>First Name</th> 
					<th>Last Name</th> 
					<th>Username</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
					<th scope="row">1</th> 
					<td>Mark</td> 
					<td>Otto</td> 
					<td>@mdo</td> 
				</tr> 
				<tr> 
					<th scope="row">2</th> 
					<td>Jacob</td> 
					<td>Thornton</td> 
					<td>@fat</td> 
				</tr> 
				<tr> 
					<th scope="row">3</th> 
					<td>Larry</td> 
					<td>the Bird</td> 
					<td>@twitter</td> 
				</tr> 
			</tbody> 
		</table>
		
	</div>
</body>
</html>
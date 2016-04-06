
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
                    $profEmail = $profileItem[5];
                    $profRegDate = $profileItem[7];
                    $profModDate = $profileItem[8];
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
						<li>Email: </li>
						<li>Registered: </li>
						<li>Modified: </li>
					</ul>
					<ul class="col-md-2" style="list-style: none">
						<li><?php echo $profUsername ?></li>
						<li><?php echo $profName ?></li>
						<li><?php echo $profSurname ?></li>
						<li><?php echo $profEmail ?></li>
						<li><?php echo $profRegDate ?></li>
						<li><?php echo $profModDate ?></li>
						
					</ul>
					<div class="col-md-3">
						<ul style="list-style: none">
							<li><a class="btn btn-default btn-block margin-bot-15" role="button" data-toggle="collapse" href="#profileMessages" aria-expanded="false" aria-controls="profileMessages">Messages</a></li>
							<li><a class="btn btn-default btn-block margin-bot-15" role="button" data-toggle="collapse" href="#profileUpdate" aria-expanded="false" aria-controls="profileUpdate">Update Profile</a></li>
							<li><a href="logout.php" class="btn btn-default btn-block margin-bot-15">Logout</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-12">
					<div class="collapse" id="profileMessages">
						<div class="well">
							Sorry, No new Messages for You today.
						</div>
					</div>
					<div class="collapse" id="profileUpdate">
						<div class="well well-updated">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Personal Information!</h3>
								</div>
								<div class="panel-body">
									
										<form class="form-horizontal">
											<div class="form-group">
												<label for="profileUpdateName" class="col-sm-2 control-label">Name</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="profileUpdateName" placeholder="Name">
												</div>
											</div>
											<div class="form-group">
												<label for="profileUpdateSurname" class="col-sm-2 control-label">Surname</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="profileUpdateSurname" placeholder="Surname">
												</div>
											</div>  
											<div class="form-group">
												<label for="profileUpdateEmail" class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<input type="email" class="form-control" id="profileUpdateEmail" placeholder="Email">
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" class="btn btn-default">Update</button>
												</div>
											</div>
										</form>
									
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Password!</h3>
								</div>
								<div class="panel-body">
									<div class="col-md-2">
										Current Password: <br>
										New Password: <br>
										New Password: <br>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Avatar!</h3>
								</div>
								<div class="panel-body">
									<div class="col-md-2">
										Choose New Avatar!
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
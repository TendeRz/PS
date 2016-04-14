
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
				include_once('login_check.php');
				include_once('navigation.php');
				include_once('./js/js.php');
				include_once('./adds/queries.php');

				$uzername = $_SESSION['myusername'];
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
						<img class="avatar" src="./adds/queries.php?usrID=<?php print_r($_SESSION['myusername']); ?>">
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
									
										<form class="form-horizontal" action="./adds/queries.php" method="post" role="form" autocomplete="off" id="updateprofpers">

											<div class="form-group profile-update">
												<label for="profileUpdateName" class="col-sm-2 control-label">Name</label>
												<div class="col-sm-10">
													<input name="profileUpdateName" type="text" class="form-control" value="<?php echo $profName ?>" onChange="checkUpdateProfileForm(this.value, this)">
												</div>
											</div>
											<div class="form-group profile-update">
												<label for="profileUpdateSurname" class="col-sm-2 control-label">Surname</label>
												<div class="col-sm-10">
													<input name="profileUpdateSurname" type="text" class="form-control" value="<?php echo $profSurname ?>" onChange="checkUpdateProfileForm(this.value, this)">
												</div>
											</div>  
											<div class="form-group profile-update">
												<label for="profileUpdateEmail" class="col-sm-2 control-label">Email</label>
												<div class="col-sm-10">
													<input name="profileUpdateEmail" type="email" class="form-control" value="<?php echo $profEmail ?>" onChange="checkUpdateProfileMail(this.value, this)">
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" form="updateprofpers" class="btn btn-default profile-update-button" disabled="true">Update</button>
												</div>
											</div>
										</form>
									
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Password Update!</h3>
								</div>
								<div class="panel-body">
									
										<form class="form-horizontal" action="./adds/queries.php" method="post" role="form" autocomplete="off" id="changePasswordForm">

											<div class="form-group password-update password-update-current">
												<label for="passwordUpdateCurrent" class="col-sm-2 control-label">Current Password</label>
												<div class="col-sm-10">
													<input name="passwordUpdateCurrent" type="password" class="form-control" placeholder="Current Password" onChange="checkUpdatePasswordCurrent(this.value, this)">
												</div>
											</div>
											<div class="form-group password-update password-update-new">
												<label for="passwordUpdateNew" class="col-sm-2 control-label">New Password</label>
												<div class="col-sm-10">
													<input name="passwordUpdateNew" type="password" class="form-control" placeholder="New Password" onChange="checkUpdatePasswordNew(this)">
												</div>
											</div>  
											<div class="form-group password-update password-update-new">
												<label for="passwordUpdateNewRepeat" class="col-sm-2 control-label">New Password</label>
												<div class="col-sm-10">
													<input name="passwordUpdateNewRepeat" type="password" class="form-control" placeholder="Repeat New Password" onChange="checkUpdatePasswordNew(this)">
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" form="changePasswordForm" class="btn btn-default password-update-button" name="changePassword"disabled="true">Update</button>
												</div>
											</div>
										</form>
									
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
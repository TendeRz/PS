				<div class="col-md-6 margin-top-200 col-md-offset-3">
					<div class="panel panel-default">	
				        <div class="panel-heading middle">Please Login</div>
						<div class="panel-body">
				            <form action="./adds/queries.php" method="post" role="form" autocomplete="off" id="login_form1">
				                <div class="form-group">
				                    <div class="input-group">
				                        <span class="glyphicon glyphicon-user input-group-addon" style="top:0px;"></span>
				                        <input name="myusername" type="text" class="form-control" placeholder="Username" onChange="checkUsername(this.value, this)">
				                        <span class="glyphicon glyphicon-remove-circle input-group-addon myUser" style="top:0px;"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                    <div class="input-group">
				                        <span class="glyphicon glyphicon-lock input-group-addon" style="top:0px;"></span>
				                        <input name="mypassword" type="password" class="form-control" placeholder="Password" onchange="validatePswd(this.value, this)">
				                        <span class="glyphicon glyphicon-remove-circle input-group-addon myPwd" style="top:0px;"></span>
				                    </div>
				                </div>
				            </form>
				            <button type="submit" form="login_form1" class="btn btn-primary signIn" disabled>Login</button>
				            <button id="register" class="btn btn-primary" onClick="location.href='registration.php'" disabled="true">Register</button>
						</div>
					</div>
					<div class="middle">
						<a href="sk2bu.php">Forgot Password?</a>
					</div>
				</div>
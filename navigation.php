
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/root/PS/index.php">Home!</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
			<ul class="nav navbar-nav">
				<?php if(ISSET($_SESSION['myusername'])){ ?>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/profile.php' ? ' active' : '');?>"><a href="/root/PS/profile.php">Profile</a></li>
				<?php } ?>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/procedure_list.php' ? ' active' : '');?>"><a href="/root/PS/procedure_list.php">Procedure Storage</a></li>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/new_proc.php' ? ' active' : '');?>"><a href="/root/PS/new_proc.php">New Procedure</a></li>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/task_list.php' ? ' active' : '');?>"><a href="/root/PS/task_list.php">Tasks</a></li>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/new_task.php' ? ' active' : '');?>"><a href="/root/PS/new_task.php" target="_blank">New Task</a></li>
				<li class="<?php echo ($_SERVER['PHP_SELF'] == '/root/PS/weekend.php' ? ' active' : '');?>"><a href="/root/PS/weekend.php" target="_blank">Weekend</a></li>
				
			</ul>
			

			
			<ul class="nav navbar-nav navbar-right">
				<?php
					if(empty($_SESSION['myusername']) || empty($_SESSION['mypassword'])){
				?>
						<li data-toggle="modal" data-target="#myModal"><a href="#">Login</a></li>
				<?php
					}else{
				?>
						<li><a href="/root/PS/logout.php">Logout</a></li>
				<?php
					}
				?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
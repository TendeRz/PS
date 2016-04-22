<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Test Task List</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/datepicker/jsDatePick_ltr.min.css" />
	<script type="text/javascript" src="/root/PS/datepicker/jsDatePick.min.1.3.js"></script>
	<script type="text/javascript">
		window.onload = function(){
			new JsDatePick({
				useMode:2,
				target:"inputField",
				dateFormat:"%Y-%m-%d"
			});
		};
	</script>
</head>
<body>
	<?php
		include_once('./adds/queries.php');
		include_once('./js/js.php');
	?>

	<div class="container">
		<?php 
			include_once('login_check.php');
			include_once('navigation.php');
		?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> Schedule </h3>
			</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Subject</label>
						<div class="col-sm-10">
							<input name="inputfield" class="form-control" placeholder="Placeholder">
						</div>
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Initiate State</label>
						<div class="col-sm-10">                                                                       
                            <select class="form-control" name="System">'
                            	<?php 
                            		$dropInitState = selectInitState();
                                	foreach ($dropInitState as $key => $dropInitStateItem) {
                                	echo '<option value='.$dropInitStateItem[0].'>'.$dropInitStateItem[1].'</option>';
                                	}
                                ?>
                            </select>                                                                           
						</div>
						<label for="inputfield" class="col-sm-2 control-label margin-top-5">Start Date</label>
						<div class="col-sm-10">
							<input id="inputField" class="form-control" />
						</div>
					</div>  
				</div>
		</div>
	</div>

</body>
</html>
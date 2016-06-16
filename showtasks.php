<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Task Planner</title>
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
		include_once('./adds/ajax.php');
		include_once('./adds/modal.php');
	?>

	</div>
	<div class="select-country">
		<button class="btn btn-default btn-xs" onClick="checkallcountries()" style="width:100%">Check All</button>
		<button class="btn btn-default btn-xs" onClick="uncheckallcountries()" style="width:100%">Uncheck</button>
		<form action="" id="setCountries">				
			<?php 
			$setCountry = selectAll('classcountry');
			foreach ($setCountry as $key => $setCountryItem) {
				$countryid = $setCountryItem[0];
				$countryname = $setCountryItem[1];
				echo '
				<label class="checkbox"><input type="checkbox" name="setCountry[]" value="'.$countryid.'">'.$countryname.'</label>
				';
			}
			?>				
		</form>
		<button class="btn btn-primary" onclick="selectcountries()">Set Countries</button>
	</div>
	<div class="container" id="tasklist"></div>

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(checkTasks, 60000);
		});
	</script>
</body>
</html>
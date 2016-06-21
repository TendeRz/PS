<html lang="en">
<head>
	<title>Test Colour Change</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
</head>
<body>
	<div class=container>
		<?php
		include_once('./js/js.php');
		include_once('./adds/queries.php');
		//include_once('./adds/ajax.php');
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

	<div class="container" id="tasklist">
		<button class="btn btn-primary" onclick="testtime()">Call Modal</button>

		<div id="piu" style="border: 1px solid black">This</div>
		<span></span>
	</div>
	
	<script type="text/javascript">
		// $(document).ready(function() {
		// 	setInterval(checkTasks, 60000);
		// });
		function testtime(){

				var now = new Date(Date.now());
				var tasktime = '14:30';
				var taskdate = '06/21';
				var startdate = now.getFullYear() + "/" + taskdate.substr(0, 2) + "/" + taskdate.substr(3, 2);
				var curdate = now.getFullYear() + "/" + (now.getMonth() + 1) + "/" + now.getDate();
				var curtime = now.getHours() + ":" + now.getMinutes();
				//var fullfrom = startdate + ' ' + tasktime + ':00';
				//var fullto = curdate + ' ' + curtime + ':00';
				var timedifference = ( new Date(startdate + ' ' + tasktime + ':00' ) - new Date(curdate + ' ' + curtime + ':00') ) / 60000;
				
				console.log(now);
				console.log(tasktime);
				console.log(taskdate);
				console.log(startdate);
				console.log(curdate);
				console.log(curtime);
				//console.log(fullfrom);
				//console.log(fullto);
				console.log(timedifference);
				
		}

		function callmodal(){
			//$('#newstatus').modal('show');
			$('#piu').data('test', 33);
			var valer = $('#piu').data('test');
			$('span').text(valer);
		}
	</script>
</body>
</html>



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
		?>
	</div>

	<div class="container" id="tasklist">
		<?php
			$datetime1 = new DateTime('2016-07-22 17:00:00');
			$datetime2 = new DateTime('now');
			$interval = $datetime1->diff($datetime2);
			echo 'Time till Friday: '.$interval->format('%d Days and %H Hours');
		?>
	</div>
	
	<script type="text/javascript">
		// $(document).ready(function() {
		// 	setInterval(checkTasks, 60000);
		// });
		// function testtime(){

		// 		var now = new Date(Date.now());
		// 		var tasktime = '14:30';
		// 		var taskdate = '06/21';
		// 		var startdate = now.getFullYear() + "/" + taskdate.substr(0, 2) + "/" + taskdate.substr(3, 2);
		// 		var curdate = now.getFullYear() + "/" + (now.getMonth() + 1) + "/" + now.getDate();
		// 		var curtime = now.getHours() + ":" + now.getMinutes();
		// 		//var fullfrom = startdate + ' ' + tasktime + ':00';
		// 		//var fullto = curdate + ' ' + curtime + ':00';
		// 		var timedifference = ( new Date(startdate + ' ' + tasktime + ':00' ) - new Date(curdate + ' ' + curtime + ':00') ) / 60000;
				
		// 		console.log(now);
		// 		console.log(tasktime);
		// 		console.log(taskdate);
		// 		console.log(startdate);
		// 		console.log(curdate);
		// 		console.log(curtime);
		// 		//console.log(fullfrom);
		// 		//console.log(fullto);
		// 		console.log(timedifference);
				
		// }

		// function callmodal(){
		// 	//$('#newstatus').modal('show');
		// 	$('#piu').data('test', 33);
		// 	var valer = $('#piu').data('test');
		// 	$('span').text(valer);
		// }
	</script>
</body>
</html>



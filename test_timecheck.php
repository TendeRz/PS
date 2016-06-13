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
			<table class="table table-hover">			
				<thead>
					<tr>
						<th>Date</th>
						<th>Time</th>
						<th>Name</th>
						<th>Link</th>
					</tr>		
				</thead>
				<tbody>
					<tr class="testrow task-late">
						<td class="taskdate">06/11</td>
						<td class="testtime" id="testtime_1">10:27</td>
						<td class="status">Close to start</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
					<tr class="testrow task-missed">
						<td class="taskdate">06/11</td>
						<td class="testtime" id="testtime_2">10:35</td>
						<td class="status">Already late</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
					<tr class="testrow task-notpossible">
						<td class="taskdate">06/12</td>
						<td class="testtime" id="testtime_3">15:00</td>
						<td class="status">Not possible now</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
					<tr class="testrow task-inprogress ">
						<td class="taskdate">06/13</td>
						<td class="testtime" id="testtime_4">17:10</td>
						<td class="status">In progress</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
										<tr class="testrow">
						<td class="taskdate">06/13</td>
						<td class="testtime" id="testtime_4">17:10</td>
						<td class="status">In Future</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
										<tr class="testrow">
						<td class="taskdate">06/13</td>
						<td class="testtime" id="testtime_4">17:10</td>
						<td class="status">In Future</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
										<tr class="testrow">
						<td class="taskdate">06/13</td>
						<td class="testtime" id="testtime_4">17:10</td>
						<td class="status">In Future</td>
						<td class="task-link"> <a href="#">Link Uno</a></td>
					</tr>
				</tbody>
			</table>
			<!-- <button class="btn" id="test_button"> Change </button> -->
		</div>

		<script type="text/javascript">
				$(function () {
					$('#test_button').on('click',function () {
						$('.testrow').each(function(){
							var tasktime = $(this).children('.testtime').text();
							var status = $(this).children('.status').text();
							var taskdate = $(this).children('.taskdate').text();
							var now = new Date(Date.now());
							var startdate = now.getFullYear() + "-" + taskdate.substr(0, 2) + "-" + taskdate.substr(3, 2);
							var curdate = now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate();
							var curtime = now.getHours() + ":" + now.getMinutes();

							var timedifference = ( new Date("2016-06-12 " + tasktime ) - new Date("2016-06-11 " + curtime) ) / 60000;
							
							console.log(curdate);


							if (status == 'Not possible now') {
							 	$(this).addClass('task-notpossible');
							} else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 0)) {
								$(this).addClass('task-missed');
							}else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 5)) {
								$(this).addClass('task-late');
							}else if (status == 'In progress'){
								$(this).addClass('task-inprogress');
							}
						})
					})



				});

				function checkTasks(){
					$('.testrow').each(function(){
							var tasktime = $(this).children('.testtime').text();
							var status = $(this).children('.status').text();
							var now = new Date(Date.now());
							var curtime = now.getHours() + ":" + now.getMinutes();

							var timedifference = ( new Date("1970-1-1 " + tasktime ) - new Date("1970-1-1 " + curtime) ) / 60000;
							
							console.log(timedifference);

							if (status == 'Not possible now') {
							 	$(this).addClass('task-notpossible');
							} else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 0)) {
								$(this).addClass('task-missed');
							}else if (((status == 'To be done') || (status == 'Check result')) && (timedifference <= 5)) {
								$(this).addClass('task-late');
							}else if (status == 'In progress'){
								$(this).addClass('task-inprogress');
							}
						})
				};
				
				$(document).ready(function() {
				//setInterval(checkTasks, 10000);
				});
		</script>
	</body>
</html>
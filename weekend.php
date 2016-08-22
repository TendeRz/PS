<html lang="en">
<head>
	<title>Weekend is Coming!</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/flipclock.css">
</head>
<body>
	<div class=container>
		<h1 style="display: flex; justify-content: center; ">Weekend is Coming!</h1>

		<div class="your-clock" style="height: 30em; display: flex;  align-items: center; justify-content: center "></div>
	</div>

	<script src="./js/jquery-2.2.0.js"></script>
	<script src="./js/flipclock.js"></script>
	<script type="text/javascript">
		var d2 = new Date();
		var d1 = new Date("2016-08-24 16:45:00");
		var difference = ((d1-d2)/1000).toString();
		console.log(difference);


		var d3 = new Date();
		var d4 = new Date();
		d4.setDate(d4.getDate() + (5 - 1 - d4.getDay() + 7) % 7 + 1);
		d4.setHours(19,00,00)
		var difference2 = ((d4-d3)/1000).toString();




		console.log(d4);
		console.log(difference2);

		if (difference2 < 604799){
			console.log('Tuesday after 18:00');
			difference2 = 0;
			if (difference2 < 579601){
				console.log('Already wednesday');
				var difference2 = ((d4-d3)/1000).toString();
			}
		}else{
			console.log('not yet Tuesday after 18:00');
		}

		var clock = $('.your-clock').FlipClock(difference, {
			clockFace: 'DailyCounter',
			countdown: true
		});
	</script>
</body>
</html>



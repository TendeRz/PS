<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Date Picker</title>


	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">



	<script src="/root/PS/js/jquery-2.2.0.js"> </script>
	<script src="/root/PS/js/bootstrap.js"></script>

</head>
<body>

	<div class="container">
		<?php 
			$testarray = array(1, 2, 3, 4, 5);

			function tester(){
				echo "Start <br />";				
				$testarray = array(1, 2, 3, 4, 5);

				if (1){
					echo "This should be only Once! <br />";
					foreach ($testarray as $key => $dayset) {
						echo "Day: $dayset <br />";
					}
				} else {
					echo "Dunno whats wrong!";
				}
			}

			tester();
		 ?>

	</div>






</body>
</html>




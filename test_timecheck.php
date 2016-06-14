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
		include_once('./adds/modal.php');
		?>
	</div>

	<div class="col-xs-1 select-country">
		<button class="btn btn-default btn-xs" onClick="checkallcountries()" style="width:100%">Check</button>
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

	</div>

	<script type="text/javascript">
		function selectcountries() {
				var selected = $( "input:checked" ).map(function() {
					return this.value;
				}).get().join();

				if (selected) {
					$.post('./adds/queries.php', {selected}, function(data){
				 		$("#tasklist").html(data);
				 	});
				} else {
					$('#noCountriesModal').modal('show');
				}
		};

		function checkallcountries(){			
			    $('input:checkbox').prop('checked', true);
		};
		function uncheckallcountries(){			
			    $('input:checkbox').prop('checked', false);
		};
	</script>
</body>
</html>



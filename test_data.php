
<!DOCTYPE html>

<html lang="en">
<head>
	<title>Test Data</title>
	<link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">		
	<link rel="stylesheet" href="/root/PS/css/spoiler.css">
	<link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">

</head>
<body>
	<?php
		include_once('./adds/queries.php');
		include_once('./js/js.php');

	?>
	<div class="container" style="border-left: 1px solid #000000; border-right: 1px solid #000000; margin-top: 20px;">
		<div style="border-bottom: 1px solid #000000">
			<?php

			$tpline = selectAll('test_data');
			foreach ($tpline as $key => $tpitem) {
				echo '<div>'.$tpitem[0].'<br>'.$tpitem[1].'</div>';
			}
			?>
		</div>
		<div style="margin-top: 30px">
			
			<form action="./adds/queries.php" method="post">
				Data Fields:
				<textarea name="tptxtdata" id="tptxtdata" cols="30" rows="10"></textarea>
					<script>
						$(document).ready(function() {
							CKEDITOR.replace( 'tptxtdata', {
								"filebrowserUploadUrl": "/root/PS/kcfinder/upload.php?opener=ckeditor&type=files",
								"filebrowserBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
								"filebrowserImageBrowseUrl": "/root/PS/kcfinder/browse.php?opener=ckeditor&type=files",
								"filebrowserImageUploadUrl": "/root/PS/ckeditor/plugins/imgupload/iaupload.php",
								imageUploadUrl: "/root/PS/ckeditor/plugins/imgupload/iaupload1.php?responseType=json"

							});
						});
					</script>
				<input type="submit" name="tpprocedrue">
				<input type="submit" value="Delete" name="tpdelete" >
				<input type="submit" value="Call" name="call" >
			</form>

		</div>
	</div>

</body>
</html>
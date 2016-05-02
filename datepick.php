<?php
  session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <title>Date Picker</title>
  
  
  <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap-datetimepicker.css" />
  

  <script src="/root/PS/js/jquery-2.2.0.js"> </script>
  <script src="/root/PS/js/moment-with-locales.js"></script>
  <script src="/root/PS/js/bootstrap.js"></script>
  <script src="/root/PS/js/bootstrap-datetimepicker.js"></script>
</head>
<body>



<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <input type='text' class="form-control" id='datetimepicker4' />
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                  locale: 'en',
                  format: "DD/MM/YYYY HH:mm",
                  sideBySide: true
                });
            });
        </script>
    </div>
</div>






</div>

</body>
</html>




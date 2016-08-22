<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
</head>

<body>

    <div class="container">
        <?php
        include_once('login_check.php');
        include_once('navigation.php');
        include_once('./adds/administration_queries.php');
        include_once('./js/js.php');
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-Mail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $userlist = selectUsers('%');
                        $userCount = 1;
                        foreach ($userlist as $key => $user) {
                            ?>
                            <tr>
                                <th scope="row"> <?php echo $userCount ?> </th>
                                <td><?php echo $user[1] ?></td>
                                <td><?php echo $user[3] ?></td>
                                <td><?php echo $user[4] ?></td>
                                <td><?php echo $user[5] ?></td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="#">Edit User</a>
                                </td>
                            </tr>
                            <?php
                            $userCount++;
                        }
                     ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php 
    include_once('./adds/footer.php');
    ?>    

</body>
</html>
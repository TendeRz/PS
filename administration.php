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
                        $userlist = selectAllUsers('%');
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
                                    <button class="btn btn-default btn-xs call-modal" onclick="userModal(<?php echo $user[0] ?>)">Edit User</button>
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
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                
                <div id="userinfo"></div>
                
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/root/PS/js/jquery-2.2.0.js"></script>
    <script src="/root/PS/js/bootstrap.js"></script>
    <script>
        $('.call-modal').click(function(){
            $('#editUserModal').modal('show');
        })

        function userModal($userModalID) {
            var userModalID = $userModalID;
            $.post('./adds/administration_queries.php', {userModalID}, function(data){
                $("#userinfo").html(data);
            });
        };
    </script>
</body>
</html>
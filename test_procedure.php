<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Procedures View Build</title>
    <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">



</head>

<body>

    <div class="container" style="margin-top: 20px;">
        <?php
        include_once('login_check.php');
        include_once('navigation.php');
        include_once('./adds/queries.php');
        include_once('./js/js.php');
        include_once('./js/ck_editor_js.php');
        include_once('./adds/modal.php');
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Active Procedures</h3>
            </div>
            <div class="panel-body">
                <?php
                $countryList = selectAll('classcountry');
                $countryID=1;
                foreach ($countryList as $key => $countrName) {
                    echo '<div class="panel-group procedure-list-group">';
                    echo '<div class="panel panel-primary">';
                    echo '<div class="panel-heading">';
                    echo '<h4 class="panel-title">';
                    echo '<a data-toggle="collapse" href="#collapse'.$countryID.'"><strong>'.$countrName[1].'</strong></a>';
                    echo '</h4>';
                    echo '</div>';
                    echo '<div id="collapse'.$countryID.'" class="panel-collapse collapse">';
                    echo '<ul class="list-group">';

                    $funcAreaList = selectFuncArea($countrName[0]);
                    $funcAreaID=1;
                    foreach ($funcAreaList as $key => $funcAreaName){


                        echo '<li class="list-group-item procedure-task-type-item">';
                        echo '<div class="panel-heading">';
                        echo '<h4 class="panel-title">';
                        echo '<a data-toggle="collapse" href="#collapseFuncArea'.$countryID.''.$funcAreaID.'"><strong>'.$funcAreaName[1].'</strong></a>';
                        echo '</h4>';
                        echo '</div>';
                        echo '<div id="collapseFuncArea'.$countryID.''.$funcAreaID.'" class="panel-collapse collapse">';
                        echo '<ul class="list-group procedure-list-group">';
                        $procList = selectProcedure($countrName[0], $funcAreaName[2]);
                        foreach ($procList as $key => $procedureName) {
                            echo '<li class="list-group-item procedure-list-item">';
                            echo '<a href="procedure.php?procID='.$procedureName[0].'&procName='.$procedureName[1].'" target="_blank">'.$procedureName[1].'</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                        echo '</li>';
                        $funcAreaID++;
                    }
                    echo '</ul>';
                    echo '</div>';
                    $countryID++;
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Waiting for Approval</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover"> 
                    <thead> 
                        <tr> 
                            <th>Title</th> 
                            <th>Initiator</th> 
                            <th>Version</th>
                            <th>Country</th>
                            <th>System</th>
                            <th>Functional Area</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php 
                $approvalList = selectForApproval(4);


                foreach ($approvalList as $key => $approvalListItem) {
                    $procApprovalid = $approvalListItem[1];
                    $procApprovalTitle = $approvalListItem[1];
                    $procApprovalInitiator = $approvalListItem[14];
                    $procApprovalVersion = $approvalListItem[12];
                    $procApprovalCountry = $approvalListItem[3];
                    $procApprovalSystem = $approvalListItem[2];
                    $procApprovalFuncArea = $approvalListItem[4];
                    ?>
                    
                        <tr class="taskrow">
                            <td> <a href="#"><?php echo $procApprovalTitle ?></a> </td>
                            <td> <?php echo $procApprovalInitiator ?> </td>
                            <td> <?php echo $procApprovalVersion ?> </td>
                            <td> <?php echo $procApprovalCountry ?> </td>
                            <td> <?php echo $procApprovalSystem ?> </td>
                            <td> <?php echo $procApprovalFuncArea ?> </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Procedures</h3>
            </div>
            <div class="panel-body">
  
            </div>
        </div>
    </div>

</body>
</html>
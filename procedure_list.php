<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Procedure Storage</title>
    <link rel="stylesheet" type="text/css" href="/root/PS/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/root/PS/css/my_style.css">
</head>

<body>

    <div class="container">
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
                <h3 class="panel-title"><a data-toggle="collapse" href="#activeProcedures" aria-expanded="true"><strong>Active Procedures</strong></a></h3>
            </div>
            <div id="activeProcedures" class="panel-body panel-collapse collapse in" aria-expanded="true">
                <?php
                $countryList = selectCountryArchive(1);
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

                    $funcAreaList = selectFuncAreaArchive(1, $countrName[0]);
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
                        $procList = selectProcedureArchive($countrName[0], $funcAreaName[0], 1);
                        foreach ($procList as $key => $procedureName) {
                            echo '<li class="list-group-item procedure-list-item">';
                            echo '<a href="procedure.php?procID='.$procedureName[0].'&procName='.$procedureName[1].'&procArch=0" target="_blank">'.$procedureName[1].'</a>';
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
                <h3 class="panel-title"><a data-toggle="collapse" href="#forApprovalProcedures"><strong>Waiting for Approval</strong></a></h3>
            </div>
            <div id="forApprovalProcedures" class="panel-body panel-collapse collapse">
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
                <h3 class="panel-title"><a data-toggle="collapse" href="#draftProcedures" ><strong>Draft Procedures</strong></a></h3>
            </div>
            <div id="draftProcedures" class="panel-body panel-collapse collapse">
                <?php
                $countryList = selectCountryArchive(3, 'proceduresarchive');
                $countryID=50;
                foreach ($countryList as $key => $countrName) {
                    echo '<div class="panel-group procedure-list-group">';
                    echo '<div class="panel panel-primary ">';
                    echo '<div class="panel-heading">';
                    echo '<h4 class="panel-title">';
                    echo '<a data-toggle="collapse" href="#collapse'.$countryID.'"><strong>'.$countrName[1].'</strong></a>';
                    echo '</h4>';
                    echo '</div>';
                    echo '<div id="collapse'.$countryID.'" class="panel-collapse collapse">';
                    echo '<ul class="list-group">';

                    $funcAreaList = selectFuncAreaArchive(3, $countrName[0], 'proceduresarchive');
                    $funcAreaID=50;
                    foreach ($funcAreaList as $key => $funcAreaName){
                        echo '<li class="list-group-item procedure-task-type-item">';
                        echo '<div class="panel-heading">';
                        echo '<h4 class="panel-title">';
                        echo '<a data-toggle="collapse" href="#collapseFuncArea'.$countryID.''.$funcAreaID.'"><strong>'.$funcAreaName[1].'</strong></a>';
                        echo '</h4>';
                        echo '</div>';
                        echo '<div id="collapseFuncArea'.$countryID.''.$funcAreaID.'" class="panel-collapse collapse">';
                        echo '<ul class="list-group procedure-list-group">';
                        echo '<table class="table table-hover">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th> </th>';
                        echo '<th>Version</th>';
                        echo '<th>Owner</th>';
                        echo '<th>Created</th>';
                        echo '<th>Modified</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        $procList = selectProcedureArchive($countrName[0], $funcAreaName[0], 3, 'proceduresarchive');
                        foreach ($procList as $key => $procedureName) {
                            echo '<tr>';
                            echo '<th scope="row"><a href="procedure.php?procID='.$procedureName[0].'&procName='.$procedureName[1].'&procArch=1" target="_blank">'.$procedureName[1].'</a></th>';
                            echo '<td>'.$procedureName[2].'</td>';
                            echo '<td>'.$procedureName[3].'</td>';
                            echo '<td>'.$procedureName[4].'</td>';
                            echo '<td>'.$procedureName[5].'</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
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
    </div>
<?php 
include_once('./adds/footer.php');
 ?>    

</body>
</html>
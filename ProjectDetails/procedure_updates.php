


new proc menu 
        -save-------------> insert_1 ---------> $_POST['saveProcedure']
                    1) procid -     reserved from procedures
                    2) version -    0.01
                    3) state -      3
                    4) insert into Archive
                    5) open in edit procedure menu

        -create-----------> insert_2 ---------> $_POST['newProcedure']
                    1) procid -     reserved from procedures
                    2) version -    1.00
                    3) state -      1
                    4) insert into Archive
                    5) open procedure list



edit proc menu
        -save-------------> insert_3 ---------> $_POST['saveProcedure']
                    1) procid -     get from php
                    2) version -    max + 0.01
                    3) state -      3
                    4) insert into Archive
                    5) open in edit procedure menu

        -create-------------> insert_4 -------> $_POST['updateProcedure']
                    1) procid -     get from php
                    2) version -    next full max value
                    3) state -      1
                    4) insert into Archive
                    5) open procedure list

        -send for approval-------------> insert_5 -------> $_POST['sendForApproval']
                    1) procid -     get from php
                    2) version -    max + 0.01
                    3) state -      4
                    4) insert into Archive
                    5) open procedure list

        -approve-------------> update -------> $_POST['procedureApprove']
                    1) procid -     get from php
                    2) version -    next full max value
                    3) state -      1
                    4) insert into Archive
                    5) open procedure list

        -reject-------------> update -------> $_POST['procedureReject']
                    1) procid -     get from php
                    2) version -    leave
                    3) state -      2
                    4) insert into Archive
                    5) open procedure list



<?php 
    

    //New Procedure
    if (ISSET($_POST['newProcedure'])){
        $version = $_POST['procversion']+1;
        insertNewProcedure(1, 0, '$version');
    }

    //straight update from planners
    if (ISSET($_POST['updateProcedure'])) {
        $version = ceil($_POST['procversion']);
        insertNewProcedure(1, 1, '$version');
    }

    //send for approval
    if (ISSET($_POST['sendForApproval'])) {
        $version = $_POST['procversion']+0.01;
        insertNewProcedure(4, 1, '$version');
    }


    //save as draft
    if (ISSET($_POST['saveProcedure'])) {
        switch ($_POST['procstate']) {
            case 1:
                $version = $_POST['procversion']+0.01;
                insertNewProcedure(3, 0, '$version');
                break;
            case 3:
                $version = $_POST['procversion'];
                updateProcedure(3, 1, '$version');
                break;
            default:
                spoolPOST();
                break;
        }        
    }

    //approve procedure
    if (ISSET($_POST['procedureApprove'])){
        $version = ceil($_POST['procversion']);
        updateProcedure(1, '$version');
    }


    //reject procedure
    if (ISSET($_POST['procedureReject'])){
        $version = $_POST['procversion'];
        updateProcedure(2, '$version');
    }





function updateProcedure($state, $version){
    global $link;
    $procArchiveId = $_POST['procarchid'];

    $sql = "UPDATE proceduresarchive SET procstate = '$state', procversion = '$version' WHERE procarchid = '$procArchiveId'";

    if (mysqli_query($link, $sql)) {
        header('Location: /root/PS/procedure_list.php');
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

function insertNewProcedure($state, $check, $version){
        global $reserveProcedureID, $link;

        $procid = $_POST['procid'];
        $title = $_POST['procTitle'];
        $system = $_POST['System'];
        $country = $_POST['Country'];
        $funcarea = $_POST['FuncArea'];
        $descript = $_POST['procDescript'];
        $dependecies = $_POST['procDependecies'];
        $access = $_POST['procAccess'];
        $description = $_POST['procDescription'];
        $troubleshoot = $_POST['procTroubleshooting'];
        $impact = $_POST['procImpact'];

        
        $date = date('Y/m/d H:i:s', time());
        $editor = $_SESSION['myusername'];

        if ($check == 0){
            insertReserveID();

            $sql="INSERT INTO proceduresarchive
                (procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
                ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
            VALUES
                ('$reserveProcedureID', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
                '$description', '$troubleshoot', '$impact', '$state', '$version', '$date', '$editor', '$editor')";

        }else{
            $sql="INSERT INTO proceduresarchive
                (procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
                ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
            VALUES
                ('$procid', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
                '$description', '$troubleshoot', '$impact', '$state', '$version', '$date', '$editor', '$editor')";
        }

        if (mysqli_query($link, $sql)) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    mysqli_close($link);
    }


    function insertReserveID(){
        global $reserveProcedureID, $link;
        $sql_1 = "START TRANSACTION";
        $sql_2 = "INSERT INTO procedures () VALUES ()";
        $sql_3 = "ROLLBACK";
        if (mysqli_query($link, $sql_1)) {
            if (mysqli_query($link, $sql_2)) {
                if (mysqli_query($link, $sql_3)) {
                    $reserveProcedureID = mysqli_fetch_assoc(mysqli_query($link, "SELECT LAST_INSERT_ID();"));
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
        } 
    }


 ?>



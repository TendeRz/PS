<?php
    session_start();
	include_once('const.php');
	
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect"); 
	if(isset($link)){
	}else{
		die('Connection Error!');
	}

    if(ISSET($_POST['myusername'])){
        sessionStart($_POST['myusername'], $_POST['mypassword'], $link);
    }    

    if(ISSET($_GET['cFlag'])){
        getFlag($_GET['cFlag'], $link);
    }

    if(ISSET($_GET['proc'])){
    	selectAll('procedures');
    }
    if (ISSET($_POST['tpprocedrue'])){
    	$tptxtdata = $_POST['tptxtdata'];
    	insertProcedure($tptxtdata);    	
    }

    if (ISSET($_POST['tpdelete'])){
    	deleteProcedure();
    }

    if (ISSET($_POST['call'])){
        $calloute = $_FILES['upload'];
        callOut($calloute);
    }

    if (ISSET($_POST['newAdditionCheck'])){
        $newAddition = $_POST['newAdditionCheck'];
        switch ($_POST['addition']) {
            case 'system':
                $table = 'classsystem';
                $column = 'classsysname';
                checkNewAddition($newAddition, $table, $column);
                break;
            case 'Country':
                $table = 'classcountry';
                $column = 'classcountryname';
                checkNewAddition($newAddition, $table, $column);
                break;
            case 'FuncArea':
                $table = 'classfuncarea';
                $column = 'classfuncname';
                checkNewAddition($newAddition, $table, $column);
                break;                            
            default:
                break;
        }
    }

    if (ISSET($_POST['newSystem']) || ISSET($_POST['newCountry']) || ISSET($_POST['newFuncArea'])){
        addNewAdditionQuery();
    }

    if(ISSET($_GET['usrID'])){
        getAvatar($_GET['usrID'], $link);
    }

    if(ISSET($_POST['checkUpdateMail'])){
        checkUpdateMailq($_POST['checkUpdateMail'], $link);
    }

    if(ISSET($_POST['checkUpdatePassword'])){
        checkUpdatePassword($_POST['checkUpdatePassword'], $link);
    }

    if(ISSET($_POST['profileUpdateName'], $_POST['profileUpdateSurname'], $_POST['profileUpdateEmail'])){
        updateProfilePers($_SESSION['myusername'], $_POST['profileUpdateName'], $_POST['profileUpdateSurname'], $_POST['profileUpdateEmail'], $link);
    }

    if(ISSET($_POST['changePassword'])){
        updatePassword($_POST['passwordUpdateNew'], $link);
    }

    if(ISSET($_FILES['avatarUpdate']) && $_FILES['avatarUpdate']['size'] > 0){
        updateAvatar($link);
    }



    if (ISSET($_POST['newSched'])){
        switch ($_POST['schedType']) {
            case 1:
                insertScheduleMoreThenOnce();
                break;
            case 2:
                insertScheduleDaily();
                break;
            case 3:
                insertScheduleDailyNoWeekend();
                break;
            case 4:
                insertScheduleWeekly();
                break;
            case 5:
                insertScheduleMonthly();
                break;
            case 6:
                insertScheduleCustom();
                break;
            default:
                spoolPOST();
                break;
        }        
    }

    if (ISSET($_POST['editSched'])){
        switch ($_POST['schedType']) {
            case 1:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleMoreThenOnce();
                break;
            case 2:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleDaily();
                break;
            case 3:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleDailyNoWeekend();
                break;
            case 4:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleWeekly();
                break;
            case 5:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleMonthly();
                break;
            case 6:
                deleteTask($_POST['schedTaskID'], $_POST['schedName'], 'Deleted for Modification', $_SESSION['myusername']);
                insertScheduleCustom();
                break;
            default:
                spoolPOST();
                break;
        }
    }

    // if (ISSET($_POST['newProcedure'])){
    //     $procTitle = $_POST['procTitle'];
    //     $procSystem = $_POST['System'];
    //     $procCountry = $_POST['Country'];
    //     $procFuncArea = $_POST['FuncArea'];
    //     $procDescript = $_POST['procDescript'];
    //     $procDependecies = $_POST['procDependecies'];
    //     $procAccess = $_POST['procAccess'];
    //     $procDescription = $_POST['procDescription'];
    //     $procTroubleshooting = $_POST['procTroubleshooting'];
    //     $procImpact = $_POST['procImpact'];

    //     insertNewProc($procTitle, $procSystem, $procCountry, $procFuncArea, $procDescript, $procDependecies, $procAccess, $procDescription, $procTroubleshooting, $procImpact);
    //     spoolPOST();
    // }

    //New Procedure
    if (ISSET($_POST['newProcedure'])){
        insertNewProcedure(1, 0);
    }

    //straight update from planners
    if (ISSET($_POST['updateProcedure'])) {
        insertNewProcedure(1, 1);
    }

    //send for approval
    if (ISSET($_POST['sendForApproval'])) {
        insertNewProcedure(4, 1);
    }

    //save draft
    if (ISSET($_POST['saveProcedure'])) {
        insertNewProcedure(3, 1);
    }



/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////     GLOBAL     /////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

$newTaskID;

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////////    FUNCTIONS   /////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////



    function sessionStart($myusername, $mypassword, $link){
        // To protect MySQL injection (more detail about MySQL injection)
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysqli_real_escape_string($link, $myusername);
        $mypassword = mysqli_real_escape_string($link, $mypassword);
        $sql="SELECT * FROM authorization WHERE username='$myusername' and password='$mypassword'";
        $result=mysqli_query($link, $sql);
        $count=mysqli_num_rows($result);
        
        if($count==1){
            $_SESSION['myusername'] = $myusername;
            $_SESSION['mypassword'] = $mypassword;
            header("Location: /root/PS/index.php");
        }else{
            header("Location: /root/PS/index.php");
        }
    mysqli_close($link);
    }


	function selectAll($tableName = "countries", $order = 2){
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
		$sql="SELECT*FROM $tableName ORDER BY $order ASC";
		return(mysqli_fetch_all($link->query($sql)));
		mysqli_close($link);
	}

	function getFlag($flag, $link){
        $flag = mysqli_real_escape_string($link, $_GET['cFlag']);
        $sql = "SELECT cflag FROM countries WHERE cname='$flag'";

        $query = mysqli_query($link, $sql);

            while($row = mysqli_fetch_assoc($query))
            {
            	$avaData = $row['cflag'];
            }
        header("content-type: image/jpeg");
        echo $avaData;
    mysqli_close($link);
    }

    function procedure($procid){
    	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
    	$sql="SELECT * FROM procedures WHERE procid='$procid'";
    	return(mysqli_fetch_all($link->query($sql)));
		mysqli_close($link);
    }






    function selectFuncArea($country_id){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT DISTINCT proccountry, classfuncname, classfuncid FROM procedures, classfuncarea WHERE ProcFuncArea = ClassFuncID AND proccountry = '$country_id' ORDER BY 2 ASC";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
        //$sql = "SELECT * FROM classfuncarea";
        //echo 'This:' . $country_id . '';
    }

    function selectProcedure($country_id, $func_id){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT procid, proctitle FROM procedures WHERE proccountry = '$country_id' AND procfuncarea = '$func_id'";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
        //$sql = "SELECT * FROM classfuncarea";
        //echo 'This:' . $country_id . '';
    }

    function checkNewAddition($newAddition, $table, $column){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT $column FROM $table WHERE $column = '$newAddition'";
        $result=mysqli_query($link, $sql);
        $count=mysqli_num_rows($result);
        if($count==0){
            echo('ok');
        }else{
            echo('not');
        }
        mysqli_close($link);
    }

    function addNewAdditionQuery(){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");       
        if(ISSET($_POST['newSystem'])){
            $table1 = 'classsystem';
            $column1 = 'classsysname';
            $value1 = $_POST['newSystem'];
        }elseif(ISSET($_POST['newCountry'])){
            $table1 = 'classcountry';
            $column1 = 'classcountryname';
            $value1 = $_POST['newCountry'];
        }else{
            $table1 = 'classfuncarea';
            $column1 = 'classfuncname';
            $value1 = $_POST['newFuncArea'];
        }
        $sql = "INSERT INTO $table1 ($column1) VALUES ('$value1')";

        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
        mysqli_close($link);
    }

    function procedurez($procid){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql="SELECT
                D.procid as ID,
                D.proctitle as Title,
                A.classsysname as System,
                B.classcountryname as Country,
                C.classfuncname as Func,
                D.procdescript as Descript,
                D.procdependecies as Depend,
                D.procaccess as Access,
                D.procdescription as Description,
                D.proctroubleshooting as Troubleshooting,
                D.procimpact as Impact,
                D.procversion as Version
                FROM
                classsystem A, classcountry B, classfuncarea C, procedures D
                WHERE A.classsysid = D.procsystem and B.classcountryid = d.proccountry and c.classfuncid = d.procfuncarea and d.procid = '$procid';";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
    }

    function getAvatar($user, $link){
        $user = mysqli_real_escape_string($link, $_GET['usrID']);
        $sql = "SELECT avatar FROM authorization WHERE username='$user'";
        $sql2 = "SELECT avatar FROM authorization WHERE username='he'";
        $query = mysqli_query($link, $sql);
        $query2 = mysqli_query($link, $sql2);
            while($row = mysqli_fetch_assoc($query))
            {
                if(!empty($row['avatar'])){
                    $avaData = $row['avatar'];
                }else{
                    
                    while($row = mysqli_fetch_assoc($query2)){
                        $avaData = $row['avatar'];
                    }
                }
            }
        header("content-type: image/jpeg");
        echo $avaData;
    mysqli_close($link);
    }

    function selectProfile($username){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT * FROM authorization WHERE username = '$username'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function checkUpdateMailq($email, $link){
        //$useremail = mysqli_real_escape_string($email);
        $useremail = $email;
        $usernames = $_SESSION['myusername'];
        $sql = "SELECT username from authorization where email = '$useremail'";
        $result=mysqli_query($link, $sql);
        $count=mysqli_num_rows($result);
        if($count==0){
            echo('ok');
        }else{
            $sql1 = "SELECT username FROM authorization WHERE email = '$useremail' and username = '$usernames'";
            $result1=mysqli_query($link, $sql1);
            $count1=mysqli_num_rows($result1);
            if($count1==1){
                echo('ok');
            }else{
                echo('not');
            }
        }
    mysqli_close($link);
    }

    function updateProfilePers($username, $name, $surname, $email, $link){
        $sql = "UPDATE authorization Set name = '$name', surname = '$surname', email = '$email' WHERE username = '$username'";
        $query = mysqli_query($link, $sql);
        header('Location: /root/PS/profile.php');
    mysqli_close($link);
    }

    function checkUpdatePassword($pass, $link){
        $passwd = $pass;
        $username = $_SESSION['myusername'];
        $sql = "SELECT * FROM authorization WHERE username = '$username' and password = '$passwd'";
        $result=mysqli_query($link, $sql);
        $count=mysqli_num_rows($result);
        
        if($count==1){
            echo('ok');
        }else{
            echo('not');
        }
    mysqli_close($link);
    }

    function updatePassword($pass, $link){
        $username = $_SESSION['myusername'];
        $sql = "UPDATE authorization SET password = '$pass' WHERE username = '$username'";
        $query = mysqli_query($link, $sql);
        header('Location: /root/PS/profile.php');
    mysqli_close($link);
    }

    function updateAvatar($link){
        
        $username = $_SESSION['myusername'];
        $tmpName = $_FILES['avatarUpdate']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $field = fread($fp, filesize($tmpName));
        $field = addslashes($field);
        //echo "Field: ".$field;
        fclose($fp);
        $sql = "UPDATE authorization SET avatar = '$field' WHERE username = '$username'";
        $query = mysqli_query($link, $sql);
        //header("content-type: image/jpeg");
        header('Location: /root/PS/profile.php');
    mysqli_close($link);
    }



    function selectTasks(){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT T.taskname as task, TD.day as day, concat(TT.hours, ':', TT.minutes) as time
                FROM tasks T
                RIGHT JOIN taskdates TD ON TD.taskid = T.taskid
                RIGHT JOIN tasktimes TT ON TT.taskid = T.taskid
                WHERE (TD.year = 2016 or TD.year = 'all')
                      AND
                      (TD.month = 4 or TD.month = 'all')
                      AND
                      (TD.week = 4 or TD.week = 'all')
                      AND
                      (TD.day = 3 or TD.day = 'all')
                ORDER BY time";

        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectInitState(){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql="SELECT * FROM taskstate WHERE taskstateid = 0 || taskstateid = 1";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectprogressstate(){
        global $link;
        $sql="SELECT * FROM taskstate WHERE taskstateid > 2";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }



    function insertNewTask(){
        global $newTaskID, $link;
        
        $schedSubject = stripslashes($_POST['schedName']);
        $schedSubject = mysqli_real_escape_string($link, $_POST['schedName']);
        $schedState = $_POST['initialState'];
        $schedSystem = $_POST['schedSystem'];
        $schedCountry = $_POST['schedCountry'];
        $schedFuncArea = $_POST['schedFuncArea'];
        $schedProcID = $_POST['schedProcID'];
        $schedDescript = stripslashes($_POST['schedDescription']);
        $schedDescript = mysqli_real_escape_string($link, $_POST['schedDescription']);
        $schedType = $_POST['schedType'];
        $schedCreateName = $_SESSION['myusername'];
        if (ISSET($_POST['schedActive'])) {
            $schedObsolite = $_POST['schedActive'];
        }else{
            $schedObsolite = 1;
        }

        if (ISSET($_POST['schedCreateDate'])){
            $schedCreateDate = $_POST['schedCreateDate'];
        }else{
            $schedCreateDate = date('Y/m/d H:i:s');
        }

        $sql="INSERT INTO tasks (taskname, taskinitstate, tasksystem, taskcountry, taskfuncarea, taskprocedure, taskdescription, taskschedtype, taskcreatename, taskcreatedate, taskmodname, taskobsolite) VALUES ('$schedSubject', '$schedState', '$schedSystem', '$schedCountry', '$schedFuncArea', '$schedProcID', '$schedDescript', '$schedType', '$schedCreateName', '$schedCreateDate', '$schedCreateName', '$schedObsolite')";
        
        if (mysqli_query($link, $sql)) {
            echo "New Task Inserted";
            $newTaskID = mysqli_insert_id($link);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }


        echo '<br>';
        echo '<a href="../new_task.php">Back</a>';
        echo '<br>';
    }

    function trigger(){        
        global $newTaskID, $link;

        $sql="INSERT INTO newtask (newtask) VALUES ('$newTaskID')";
        if (mysqli_query($link, $sql)) {
            echo "Trigger Should be Go";            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }

    function insertScheduleMoreThenOnce(){
        global $newTaskID, $link;
        insertNewTask();
        $schedStartDate = $_POST['schedStartDate'];
        $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'all' ,'all' ,'all' ,'all' ,'all')";

        if (mysqli_query($link, $sql)) {
            echo "New schedule created successfully";
            //header("Location: {$_SERVER['HTTP_REFERER']}");
            foreach($_POST['schedTimeset'] as $key => $timeItem){
                $starttime = substr($timeItem, 0, 5);
    
                $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";
                
                if (mysqli_query($link, $sql2)) {
                    echo "<br>";
                    echo "Time added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    trigger();
    mysqli_close($link);
    }

    function insertScheduleDaily(){
        global $newTaskID, $link;
        insertNewTask();
        $schedStartDate = $_POST['schedStartDate'];
        $schedTimesetDaily = $_POST['schedTimesetDaily'];

        $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'all' ,'all' ,'all' ,'all' ,'all')";

        if (mysqli_query($link, $sql)) {
            echo "New schedule created successfully";

            $starttime = substr($schedTimesetDaily, 0, 5);

            $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";

            if (mysqli_query($link, $sql2)) {
                echo "<br>";
                echo "Time added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    trigger();
    mysqli_close($link);
    }    

    function insertScheduleDailyNoWeekend(){
        global $newTaskID, $link;
        insertNewTask();
        $schedStartDate = $_POST['schedStartDate'];
        $schedTimesetNoWeekends = $_POST['schedTimesetNoWeekends'];
        $schedDayset = array(0, 1, 2, 3, 4);

        $starttime = substr($schedTimesetNoWeekends, 0, 5);

        $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";

        if (mysqli_query($link, $sql2)) {
            echo "Time added successfully <br />";
            foreach ($schedDayset as $key => $weekday) {
                $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'all' ,'all' ,'all' ,'$weekday' ,'all')";
                if (mysqli_query($link, $sql)) {
                    echo "Day added successfully <br />";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    trigger();
    mysqli_close($link);
    }

    function insertScheduleWeekly(){
        global $newTaskID, $link;
        insertNewTask();
        $schedStartDate = $_POST['schedStartDate'];
        $schedTimesetWeekday = $_POST['schedTimesetWeekday'];
        
        $starttime = substr($schedTimesetWeekday, 0, 5);

        $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";

        if (mysqli_query($link, $sql2)) {
            echo "Time added successfully <br />";
            foreach ($_POST['schedWeekday'] as $key => $weekday) {
                $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'all' ,'all' ,'all' ,'$weekday' ,'all')";
                 if (mysqli_query($link, $sql)) {
                    echo "Day added successfully <br />";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }                
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    trigger();
    mysqli_close($link);
    }

    function  insertScheduleMonthly(){
        global $newTaskID, $link;
        insertNewTask();
        $schedStartDate = $_POST['schedStartDate'];
        $schedTimesetMonthday = $_POST['schedTimesetMonthday'];
        
        $starttime = substr($schedTimesetMonthday, 0, 5);

        $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";

        if (mysqli_query($link, $sql2)) {
            echo "Time added successfully <br />";
            foreach ($_POST['schedMonthday'] as $key => $monthday) {
                $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'all' ,'all' ,'all' ,'all' ,'$monthday')";
                if (mysqli_query($link, $sql)) {
                    echo "Day added successfully <br />";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }                
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    trigger();
    mysqli_close($link);
    }

    function insertScheduleCustom(){
        global $newTaskID, $link;
        insertNewTask();
        $schedTimesetCustom = $_POST['schedTimesetCustom'];
        $starttime = substr($schedTimesetCustom, 0, 5);
        $schedStartDate = $_POST['schedStartDate'];
        $sql2="INSERT INTO tasktimes (taskid, starttime) VALUES ('$newTaskID', '$starttime')";

        if (mysqli_query($link, $sql2)) {
            echo "Time added successfully <br />";
            foreach ($_POST['schedDatesetCustom'] as $key => $customTimeSet) {
                $taskYear = substr($customTimeSet, 0, 4);
                $taskMonth = substr($customTimeSet, 5, 2);
                $taskDay = substr($customTimeSet, 8, 2);
                $sql="INSERT INTO taskdates (taskid, taskstartdate, year, month, week, weekday, day) VALUES ('$newTaskID', '$schedStartDate' ,'$taskYear' ,'$taskMonth' ,'all' ,'all' ,'$taskDay')";
                if (mysqli_query($link, $sql)) {
                    echo "Day added successfully <br />";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                } 
            }
        }
    trigger();    
    mysqli_close($link);
    }

    function selectTaskList(){
        global $link;
        $sql="SELECT                
                CONCAT(LPAD(MONTH(TL.tlistfulldate),2,0),'/',LPAD(DAYOFMONTH(TL.tlistfulldate),2,0)) AS 'Start Date',
                TIME_FORMAT(TL.tlisttime, '%H:%i') AS 'Start Time',
                CC.ClassCountryName AS Country,
                TL.taskname AS Subject,
                TS.taskstate AS Status,
                CS.ClassSysName AS System,
                TL.tasklistid AS ID
                FROM tasklist TL, classcountry CC, classfuncarea CF, classsystem CS, taskstate TS, procedures P
                WHERE
                    TL.tlistfulldate >= CURDATE()
                    AND
                    TL.tlistsystem = CS.classsysid
                    AND
                    TL.tlistcountry = CC.classcountryid
                    AND
                    TL.tlistfuncarea = CF.classfuncid
                    AND
                    TL.tliststate = TS.taskstateid
                    AND
                    TL.tlistprocedure = P.procid
                    AND
                    TL.tlistcreatestate = TS.taskstateid
                ORDER BY TL.tlistfulldate, TL.tlisttime;";
                if (mysqli_query($link, $sql)) {
                    return(mysqli_fetch_all($link->query($sql)));
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
        
        mysqli_close($link);
    }
  
    
    function selectTask($taskid){
        global $link;
        $sql="SELECT
                TL.taskname,
                CONCAT(TL.tlistfulldate,'  ', TIME_FORMAT(TL.tlisttime, '%H:%i')),
                TS.taskstate,
                CS.ClassSysName,
                CF.classfuncname,
                CC.ClassCountryName,
                P.proctitle,
                TL.tlistprocedure,
                TL.tlistdescription,
                -- IF(LENGTH(TLH.modifydate)>0, TLH.modifydate, TL.tlistcreatedate),
                TL.tlistcreatedate,
                -- IF(LENGTH(TLH.modifyname)>0, TLH.modifyname, TL.tlistcreatename),
                TL.tlistcreatename,
                'Task Created'
                -- TLH.modifycomment
                FROM classcountry CC, classfuncarea CF, classsystem CS, taskstate TS, procedures P, tasklist TL LEFT JOIN tasklisthistory TLH ON TL.tasklistid = TLH.tasklistid
                WHERE
                    TL.tlistsystem = CS.classsysid
                    AND
                    TL.tlistcountry = CC.classcountryid
                    AND
                    TL.tlistfuncarea = CF.classfuncid
                    AND
                    TL.tliststate = TS.taskstateid
                    AND
                    TL.tlistprocedure = P.procid
                    AND
                    TL.tasklistid = '$taskid'";
            if (mysqli_query($link, $sql)) {
                    return(mysqli_fetch_all($link->query($sql)));
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }        
        mysqli_close($link);
    }

    function selectTaskHistory($taskid){
        global $link;
        $sql="SELECT
                TLH.modifydate,
                TLH.modifyname,
                CONCAT('Set ', TS.taskstate),
                IF(LENGTH(TLH.modifycomment)>0, TLH.modifycomment, '&nbsp;')
            FROM
                tasklisthistory TLH, taskstate TS
            WHERE
                TLH.modifystate = TS.taskstateid
                AND
                TLH.tasklistid = '$taskid';";
        if (mysqli_query($link, $sql)) {
                    return(mysqli_fetch_all($link->query($sql)));
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }        
        mysqli_close($link);
    }



    function selectEditTaskList($system_id, $country_id){
        global $link;
        $sql = "SELECT
                    t.taskid as id,
                    t.taskname as name,
                    ts.taskschedule as schedule,
                    t.taskobsolite as obsolite
                FROM 
                    tasks t, taskschedule ts
                WHERE 
                    t.taskschedtype = ts.taskscheduleid
                    AND
                    t.taskcountry = '$country_id'
                    AND
                    t.tasksystem = '$system_id'
                ORDER BY name";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
    }

    function selectEditCountry($system_id){
        global $link;
        $sql = "SELECT DISTINCT taskcountry, ClassCountryName, ClassCountryID from tasks, classcountry WHERE tasksystem = '$system_id' AND ClassCountryID = taskcountry ORDER BY 2";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
    }

    function selectEditTask($taskid){
        global $link;
        $sql = "SELECT 
                    T.taskid,
                    T.taskname,
                    T.taskinitstate,
                    TD.taskstartdate,
                    T.taskschedtype,
                    T.tasksystem,
                    T.taskcountry,
                    T.taskfuncarea,
                    T.taskprocedure,
                    T.taskdescription,
                    T.taskobsolite,
                    T.taskcreatename,
                    T.taskcreatedate,
                    T.taskmodname,
                    T.taskmoddate
                FROM
                    tasks T, taskdates TD
                WHERE
                    T.taskid = TD.taskid
                    AND
                    T.taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
        mysqli_close($link);
    }

    function selectEditTaskProcedure($procid){
        global $link;
        $sql = "SELECT ProcTitle FROM procedures WHERE ProcID = '$procid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectEditTaskTimes($taskid){
        global $link;
        $sql = "SELECT tasktimeid, starttime FROM tasktimes where taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectEditTaskWeedays($taskid){
        global $link;
        $sql = "SELECT weekday FROM taskdates WHERE taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectEditTaskMonthdays($taskid){
        global $link;
        $sql = "SELECT day FROM taskdates WHERE taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectEditTaskCustomdays($taskid){
        global $link;
        $sql = "SELECT CONCAT_WS('-', year, month, day) FROM taskdates WHERE taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function selectEditTaskActive($taskid){
        global $link;
        $sql = "SELECT taskobsolite FROM tasks WHERE taskid = '$taskid'";
        return(mysqli_fetch_all($link->query($sql)));
    mysqli_close($link);
    }

    function deleteTask($taskid, $taskname, $modification, $modifier){
        global $link;
        $sql_1 = "DELETE FROM tasks WHERE taskid = '$taskid'";
        $sql_2 = "DELETE FROM taskdates WHERE taskid = '$taskid'";
        $sql_3 = "DELETE FROM tasktimes WHERE taskid = '$taskid'";
        $sql_4 = "DELETE FROM tasklist WHERE taskid = '$taskid' AND tliststate IN (0,1)";
        $sql_5 = "INSERT INTO TASKHISTORY (taskid, taskname, taskhistorymodification, taskhistoryeditor) VALUES ('$taskid', '$taskname', '$modification', '$modifier')";
        if (mysqli_query($link, $sql_1)) {
            echo "First successfully <br />";
            if (mysqli_query($link, $sql_2)) {
                echo "Second successfully <br />";
                if (mysqli_query($link, $sql_3)) {
                    echo "Third successfully <br />";
                    if (mysqli_query($link, $sql_4)) {
                        echo "Fourth successfully <br />";
                        if (mysqli_query($link, $sql_5)) {
                            echo "Fifth successfully <br />";
                        }else{
                            echo "Error: " . $sql . "<br>" . mysqli_error($link);
                        }
                    }else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($link);
                    }
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



    function spoolPOST(){

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        echo '<br>';
        echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Back</a>';
    }



    function insertProceduresArchive($state){
        global $link;
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
        $version = $_POST['procversion']+1;
        $date = date('Y/m/d h:i:s', time());
        $editor = $_SESSION['myusername'];

        $sql="INSERT INTO proceduresarchive
                (procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
                ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
            VALUES
                ('$procid', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
                '$description', '$troubleshoot', '$impact', '$state', '$version', '$date', '$editor', '$editor')";
        
        if (mysqli_query($link, $sql)) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
        mysqli_close($link);
    }

    function insertNewProc($procTitle, $procSystem, $procCountry, $procFuncArea, $procDescript, $procDependecies, $procAccess, $procDescription, $procTroubleshooting, $procImpact){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "INSERT INTO procedures (procTitle, procSystem, procCountry, procFuncArea, procDescript, procDependecies, procAccess, procDescription, procTroubleshooting, procImpact) VALUES ('$procTitle', '$procSystem', '$procCountry', '$procFuncArea', '$procDescript', '$procDependecies', '$procAccess', '$procDescription', '$procTroubleshooting', '$procImpact')";
        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
        mysqli_close($link);
    }




    function insertNewProcedure($state, $check){
        global $link;

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

        $version = $_POST['procversion']+1;
        $date = date('Y/m/d H:i:s', time());
        $editor = $_SESSION['myusername'];

        if ($check == 0){
            $getnewid = mysqli_fetch_assoc(mysqli_query($link, "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dstorage' AND TABLE_NAME = 'procedures'"));
            $newid = $getnewid['AUTO_INCREMENT'];
            $sql="INSERT INTO proceduresarchive
                (procid, ProcTitle, ProcSystem, ProcCountry, ProcFuncArea, ProcDescript, ProcDependecies, ProcAccess, ProcDescription,
                ProcTroubleshooting, ProcImpact, procstate, procversion, proccreatedate, proccreatename, procmodname )
            VALUES
                ('$newid', '$title', '$system', '$country', '$funcarea', '$descript', '$dependecies', '$access',
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
    }
?>


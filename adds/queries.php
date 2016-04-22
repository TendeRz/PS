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

    if (ISSET($_POST['newProcedure'])){
        $procTitle = $_POST['procTitle'];
        $procSystem = $_POST['System'];
        $procCountry = $_POST['Country'];
        $procFuncArea = $_POST['FuncArea'];
        $procDescript = $_POST['procDescript'];
        $procDependecies = $_POST['procDependecies'];
        $procAccess = $_POST['procAccess'];
        $procDescription = $_POST['procDescription'];
        $procTroubleshooting = $_POST['procTroubleshooting'];
        $procImpact = $_POST['procImpact'];

        insertNewProc($procTitle, $procSystem, $procCountry, $procFuncArea, $procDescript, $procDependecies, $procAccess, $procDescription, $procTroubleshooting, $procImpact);
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


	function selectAll($tableName = "countries"){
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
		$sql="SELECT*FROM $tableName ORDER BY 2 ASC";
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



    function deleteProcedure(){
    	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
    	$sql = "TRUNCATE test_data";
    	if (mysqli_query($link, $sql)) {
			echo "Deleted successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
		header("Location: {$_SERVER['HTTP_REFERER']}");
    }



    function selectFuncArea($country_id){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die("Cannot Connect");
        $sql = "SELECT DISTINCT proccountry, classfuncname, classfuncid FROM procedures, classfuncarea WHERE ProcFuncArea = ClassFuncID AND proccountry = '$country_id'";
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
                D.procimpact as Impact
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
        //$user = mysqli_real_escape_string($username);
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
                WHERE (TD.year = 2016 or TD.year = '*')
                      AND
                      (TD.month = 4 or TD.month = '*')
                      AND
                      (TD.week = 4 or TD.week = '*')
                      AND
                      (TD.day = 3 or TD.day = '*')
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
?>
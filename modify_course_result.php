<?php
    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
        echo "<script> location.href='login.php'; </script>";
        exit;
    }

    else{
        require_once ("config.php");
    }

    $code = $_POST['excode'];
    $name = $_POST['exname'];
    $area = $_POST['exarea'];
    $school = $_POST['exschool'];
    $exam = $_POST['exexam'];
    $offered = $_POST['exoffered'];
    $ugpg = $_POST['exugpg'];
    $type = $_POST['extype'];
    $tel = $_POST['extel'];
    $au = $_POST['exau'];
    $year = $_POST['exyear'];
    $hoursperstaff = $_POST['exhoursperstaff'];
    $numofgroups = $_POST['exnumofgroups'];
    $numofweeks = $_POST['exnumofweeks'];
    $hoursperweek = $_POST['exhoursperweek'];
    $query = "update course 
        set area = '".$area."', exam = '".$exam."', offered = '".$offered."', ugpg = '".$ugpg."', 
        type ='".$type."', school = '".$school."', au = '".$au."', tel = '".$tel."', year = '".$year."', 
        hoursperstaff = '".$hoursperstaff."', numofgroups = '".$numofgroups."', numofweeks = '".$numofweeks."', 
        hoursperweek = '".$hoursperweek."'
        where code = '".$code."'";
    echo $query;
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Cannot update the course table');</script>");
    }
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Course info modified successfully!');
        window.location.href='modify_course.php';</script>");
    exit();
?>
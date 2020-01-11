<?php
    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
        echo "<script> location.href='login.php'; </script>";
        exit;
    }

    else{
        require_once ("config.php");
    }

    $code = $_POST['newcode'];
    $name = $_POST['newname'];
    $area = $_POST['newarea'];
    $school = $_POST['newschool'];
    $exam = $_POST['newexam'];
    $offered = $_POST['newoffered'];
    $ugpg = $_POST['newugpg'];
    $type = $_POST['newtype'];
    $tel = $_POST['newtel'];
    $au = $_POST['newau'];
    $year = $_POST['newyear'];
    $hoursperstaff = $_POST['newhoursperstaff'];
    $numofgroups = $_POST['newnumofgroups'];
    $numofweeks = $_POST['newnumofweeks'];
    $hoursperweek = $_POST['newhoursperweek'];
    $query = "select * from course where code = '".$code."' or coursename = '".$name."'";
    $result = mysqli_query($link, $query);
    $num_results = $result->num_rows;
    if ($num_results > 0) {   
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Registration failed. An existing course is found in database!');
        window.location.href='add_course.php';</script>");
    }
    else {
        $query2 = "insert into course (area, code, coursename, exam, offered, ugpg, type, 
        school, au, tel, year, hoursperstaff, numofgroups, numofweeks, hoursperweek) values
        ('".$area."', '".$code."', '".$name."', '".$exam."', '".$offered."', '".$ugpg."', '".$type."', 
        '".$school."', '".$au."', '".$tel."', '".$year."', '".$hoursperstaff."', '".$numofgroups."', 
        '".$numofweeks."', '".$hoursperweek."')";
        $result2 = mysqli_query($link, $query2);
        if (!$result2) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Cannot insert into course table');</script>");
        }
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Course created successfully!');
        window.location.href='add_course.php';</script>");
    }
    exit();
?>
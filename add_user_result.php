<?php
    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
        echo "<script> location.href='login.php'; </script>";
        exit;
    }

    else{
        require_once ("config.php");
    }

    $firstname = $_POST['regfirstname'];
    $lastname = $_POST['reglastname'];
    $fullname = $_POST['regfullname'];
    $email = $_POST['regemail'];
    $area = $_POST['regarea'];
    $role = $_POST['regrole'];
    $appointment = $_POST['regappointment'];
    $query = "select * from login where email = '".$email."'";
    $result = mysqli_query($link, $query);
    $num_results = $result->num_rows;
    if ($num_results > 0) {   
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('This email is already registered. Please check again!');
        window.location.href='add_user.php';</script>");
    }
    else {
        $query2 = "select * from staff where email = '".$email."'";
        $result2 = mysqli_query($link, $query2);
        $num_results2 = $result2->num_rows;
        if ($num_results2 > 0) {
            $row = $result2->fetch_assoc();
            $staffid = $row['staffid']; 
        }
        else {
            $sql = "insert into staff (area, name, email, appointment) values
            ('".$area."', '".$name."', '".$email."', '".$appointment."')";
            $res = mysqli_query($link, $sql);
            if (!$res) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Cannot insert into staff table');</script>");
            }
            $sql2 = "select from staff where email = '".$email."'";
            $res2 = mysqli_query($link, $sql2);
            $num_res = $res2->num_rows;
            if ($num_res > 0) {
                $row = $res2->fetch_assoc();
                $staffid = $row['staffid']; 
            }
            // $res2->free_result();
            // $res->free_result();
        }
        $query3 = "select * from area where area = '".$area."'";
        $result3 = mysqli_query($link, $query3);
        $num_result3 = $result3->num_rows;
        $row3 = $result3->fetch_assoc();
        $areaid = $row3['areaid'];
        // $result3->free_result();

        $query4 = "insert into login (firstname, lastname, email, password, role, areaid, staffid) values
        ('".$firstname."', '".$lastname."', '".$email."', '".$firstname."".$lastname."', '".$role."', '".$areaid."', '".$staffid."')";
        $result4 = mysqli_query($link, $query4);
        if (!$result4) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Cannot insert into login table');</script>");
        }
        // $result4->free_result();
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('User created successfully!');
        window.location.href='add_user.php';</script>");
    }
    exit();
?>
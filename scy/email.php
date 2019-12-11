<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 17/4/19
 * Time: 01:58
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else {
    $mail_courseids = $_POST['sendemail'];
    $n = count($mail_courseids);
    for ($course = 0; $course < $n; $course++) {
        if ($course==1)echo"Notification Emails have been sent to the corresponding staffs.";
        //Fetch data from database
        require_once("config.php");
        $sqlcourseinfo = "select * from course where courseid=" . $mail_courseids[$course] . ";";
        $rescourseinfo = mysqli_query($link, $sqlcourseinfo);
        $rowcourseinfo = $rescourseinfo->fetch_assoc();

        $sql = "select distinct staffid from examstaff where courseid=" .$mail_courseids[$course]. ";";
        $res = mysqli_query($link, $sql);

        // $row output is * from examstaff (staffid)

        $email_string='';
        $name_string='';

        //we use testing_email first;
        $testing_email='';
        //all email addresses and names in one course for CEM
        for ($i=0; $i< $res->num_rows; ++$i){
            $row = $res->fetch_assoc();
            $sqlstaff="select name, email from staff where staffid=".$row['staffid'].";";
            $resstaff=mysqli_query($link,$sqlstaff);
            $rowstaff = $resstaff->fetch_assoc();

            $email_string=$email_string.$rowstaff['email'].', ';
            $name_string=$name_string.$rowstaff['name'].', ';
        }


        $msg="Dear {$name_string} <br><br>
                    <strong>Appointment of Examiners/Moderators for Semester 1 AY18/19 Examinations</strong><br><br>
                    I am pleased to appoint you as examiner/moderator for the following course in Semester 1, AY2018/2019.
                    <br><br>
                    COURSE CODE: {$rowcourseinfo['code']} <br>
                    COURSE TITLE: {$rowcourseinfo['coursename']} <br><br>
                    Please work closely with the course coordinator and Area Lead on the examination and assessment(s), if any, for this course.<br>
                    Many thanks for your contributions and support in this important matter.<br><br>
                    Your sincerely,<br>
                    Associate Chair (Academic), School of EEE";

        //send email
        mail($testing_email, "Appointment of Examiners/Moderators for Semester 1 AY18/19 Examinations", $msg);

        echo $email_string;
        echo "<br><br>";
        echo $name_string;
        echo "<br><br>";
        echo $msg;
        echo "<br><br><br><br><br>";

    }

//    echo "<script> location.href='form_generation.php'; </script>";
//    exit;
}

?>


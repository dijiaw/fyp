<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 14/5/19
 * Time: 02:48
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else {
    echo"Notification Emails have been sent to the corresponding staffs.";
        //Fetch data from database
        require_once("config.php");

        $sqlstaffid = "select distinct staffid from examstaff;";
        $resstaffid = mysqli_query($link, $sqlstaffid);

        //loop every staff
        for ($i=0; $i< $resstaffid->num_rows; ++$i){
            $rowstaffid = $resstaffid->fetch_assoc();

            $email_string='';
            $name_string='';
            $msg_string='';

            //we use testing_email first;
            $testing_email='';

            $sqlstaffinfo = "select * from staff where staffid={$rowstaffid['staffid']}";
            $resstaffinfo = mysqli_query($link, $sqlstaffinfo);
            $rowstaffinfo = $resstaffinfo->fetch_assoc();
            $email_string=$rowstaffinfo['email'];
            $name_string=$rowstaffinfo['name'];

            $sqlcourse = "select distinct courseid from examstaff where staffid={$rowstaffid['staffid']};";
            $rescourse = mysqli_query($link, $sqlcourse);

            //loop every course for each staff
            for ($j=0; $j< $rescourse->num_rows; ++$j){
                $rowcourse = $rescourse->fetch_assoc();

                $sqlcourseinfo="select * from course where courseid={$rowcourse['courseid']}";
                $rescourseinfo = mysqli_query($link, $sqlcourseinfo);
                $rowcourseinfo = $rescourseinfo->fetch_assoc();

                $role='';
                $sqlrole="select role from examstaff where courseid={$rowcourse['courseid']} and staffid={$rowstaffid['staffid']}";
                $resrole = mysqli_query($link, $sqlrole);

                //loop every role for each course of staff
                for ($k=0; $k< $resrole->num_rows; ++$k){
                    $rowrole = $resrole->fetch_assoc();

//                    echo $rowrole['role'];

                    if($rowrole['role']=='C')
                    {$newrole=' Coordinator ';}
                    else if ($rowrole['role']=='E')
                    {$newrole=' Examiner ';}
                    else if ($rowrole['role']=='M')
                    {$newrole=' Moderator';}

                    $role=$role.$newrole;
                }

                $courseinfo="<br>COURSE CODE: {$rowcourseinfo['code']}<br>
                                COURSE TITLE: {$rowcourseinfo['coursename']}<br>
                                Role: {$role}<br>";
                $msg_string=$msg_string.$courseinfo;
            }

            $msg="Dear Prof. {$name_string} <br><br>
                    <strong>Appointment of Coordinator/Examiners/Moderators for Semester 1 AY18/19 Examinations</strong><br><br>
                    I am pleased to appoint you as coordinator/examiner/moderator for the following courses in Semester 1, AY2018/2019.
                    <br>{$msg_string}<br>
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


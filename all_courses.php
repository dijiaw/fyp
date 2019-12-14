<?php

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View All Courses</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>

<body>
<?php include 'topnav.php'?>

<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4"> View All Courses</h1>
            <p style="background-color:white">As admin, you are able to view all course information</p>
        </div>
    </div>

    <div class="tablenotification">
            <!-- Example row of columns -->
            <div class="table-responsive">
                <table class="table table-hover" style="margin-left: 5%; width: 90%;">
                    <thead>
                    <tr>
                        <th scope="col">Course Code</th>
                        <th scope="col" style="width:35%;">Course</th>
                        <th scope="col">Area</th>
                        <th scope="col">Exam</th>
                        <th scope="col">AU</th>
                        <th scope="col">TEL</th>
                        <th scope="col">Hours</th>
                        </tr>

                    </thead>

                    <tbody>
                    <?php
                    if (isset($_SESSION["staffid"])) {
                        $staff = $_SESSION["staffid"];
                        $sql = "select * from plan";
                        $result=mysqli_query($link,$sql);
                        for ($i=0; $i<$result->num_rows; ++$i) {
                            $row = $result -> fetch_assoc();
                            $course = $row['courseid'];
                            // if (isset($_GET['search'])){
                            //     $sql2="select * from course where courseid=".$course."and (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
                            // }
                            // else {
                            //     $sql2="select * from course where courseid=".$course."";
                            // }
                            $sql2="select * from course where courseid=".$course."";
                            $res=mysqli_query($link,$sql2);
                            for ($j = 0; $j < $res->num_rows; ++$j) {
                                $row2 = $res -> fetch_assoc();
                                echo <<<_END
                                    <tr>
                                    <td>{$row2['code']}</td>
                                    <td>{$row2['coursename']}</td>
                                    <td>{$row2['area']}</td>
                                    <td>{$row2['exam']}</td>
                                    <td>{$row2['au']}</td>
                                    <td>{$row2['tel']}</td>
                                    <td>{$row2['hoursperstaff']}</td></tr>
_END;
                            }
                            $res -> free_result();   
                        }
                        $result -> free_result();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div id="downloadallcourseinfo" style="margin-right: 10%;">
                <a href='download_course.php' class='btn btn-success pull-right' style='float:right;'>Download All Course Information</a>
            </div>

    </div> <!-- /container -->

</main>
<?php include 'footer.php' ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<script language="JavaScript">
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

</body>
</html>

<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("someone@example.com","My subject",$msg);
?>

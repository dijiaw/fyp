<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 23/12/18
 * Time: 04:20
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_GET['search'])){
        $sql="select * from course where exam='yes' and offered='yes' and (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
    }
    else if (isset($_GET['area'])){
        $sql="select * from course where exam='yes' and offered='yes' and area='".$_GET['area']."';";
    }
    else{
        $sql="select * from course where exam='yes' AND offered='yes';";
    }
        $res=mysqli_query($link,$sql);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exam Appointment</title>

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
            <h1 class="display-4"> Exam Appointment</h1>
            <p style="background-color:white">You may send the notification emails to the faculties by selecting the following courses and click "Send Email to Selected Staffs"</p>

            <form class="form-inline" action="appointment.php">
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search by course" name="search">
                <button type="submit" class="btn btn-success mb-2">Search</button>
            </form>
        </div>
    </div>

    <div class="tablenotification">
        <form action="email.php" method="post">
            <?php
            if ($_SESSION["role"]=='admin')
                echo "<div align=\"right\">
                <button type=\"submit\" class=\"btn btn-success mb-2\">Send Notification Email by Course</button>
                <a href='email-to-staff.php' class=\"btn btn-dark mb-2\">by Staff</a>
            </div>";
            ?>

            <!-- Example row of columns -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" style="width:6%;">
                            <div class="btn-group dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Area
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="appointment.php?area=ECAL">ECAL</a>
                                    <a class="dropdown-item" href="appointment.php?area=ENIC">ENIC</a>
                                    <a class="dropdown-item" href="appointment.php?area=INON">INON</a>
                                    <a class="dropdown-item" href="appointment.php?area=HRH">HRH</a>
                                    <a class="dropdown-item" href="appointment.php?area=Others">Others</a>
                                </div>
                            </div>
                        </th>

                        <th scope="col" style="width:35%;">Course</th>
                        <th scope="col">Coordinator</th>
                        <th scope="col">Examiner</th>
                        <th scope="col">Moderator</th>
                        <?php
                                if ($_SESSION["role"]=='admin'){
                                        echo "<th scope=\"col\">
                            <div class=\"form-check\">
                                <input class=\"form-check-input position-static\" type=\"checkbox\" onclick=\"toggle(this)\" id=\"blankCheckbox\" value=\"option1\" aria-label=\"...\">
                               
                            </div>
                        </th>
                    </tr>";
                                }
                                else echo "</tr>";
                        ?>

                    </thead>

                    <tbody>
                    <?php
                    // The query() returns a buffered resultset, with number of rows in num_rows.
                    for ($r = 0; $r < $res->num_rows; ++$r) {
                        // Fetch current row into an associative array called $row
                        $row = $res->fetch_assoc();

                        echo <<<_END
                        <tr>
                        <td>{$row['area']}</td>
                        <td>{$row['code']}-{$row['coursename']}</td>
_END;
                        $sqlc="select * from examstaff where courseid=".$row['courseid']." AND role='C';";
                        $resc=mysqli_query($link,$sqlc);
                        echo "<td>";
                        for ($i=0; $i< $resc->num_rows; ++$i){
                            $rowc=$resc->fetch_assoc();
                            $sqlname="select * from staff where staffid=".$rowc['staffid']."";
                            $resname=mysqli_query($link,$sqlname);
                            $rowname = $resname->fetch_assoc();
                            echo $rowname['name'];
                            echo "<br>";
                        }
                        echo "</td>";

                        $sqle="select * from examstaff where courseid=".$row['courseid']." AND role='E';";
                        $rese=mysqli_query($link,$sqle);
                        echo "<td>";
                        for ($i=0; $i< $rese->num_rows; ++$i){
                            $rowe=$rese->fetch_assoc();
                            $sqlname="select * from staff where staffid=".$rowe['staffid']."";
                            $resname=mysqli_query($link,$sqlname);
                            $rowname = $resname->fetch_assoc();
                            echo $rowname['name'];
                            echo "<br>";
                        }
                        echo "</td>";

                        $sqlm="select * from examstaff where courseid=".$row['courseid']." AND role='M';";
                        $resm=mysqli_query($link,$sqlm);
                        echo "<td>";
                        for ($i=0; $i< $resm->num_rows; ++$i){
                            $rowm=$resm->fetch_assoc();
                            $sqlname="select * from staff where staffid=".$rowm['staffid'].";";
                            $resname=mysqli_query($link,$sqlname);
                            $rowname = $resname->fetch_assoc();
                            echo $rowname['name'];
                            echo "<br>";
                        }
                        echo "</td>";

                        if ($_SESSION["role"]=='admin'){
                            echo "<td>
                                        <div class=\"form-check\">
                                        <input class=\"form-check-input position-static\" type=\"checkbox\" name=\"sendemail[]\" id=\"blankCheckbox\" value=\"{$row['courseid']}\" aria-label=\"...\">
                                        </div>
                                  </td></tr>";
                        }
                        else echo "</tr>";


                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div> <!-- /container -->

</main>

<footer class="card-footer">
    <p>&copy; SHI CHENYU FINAL YEAR PROJECT 2018-2019</p>
</footer>

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

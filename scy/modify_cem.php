<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 13/1/19
 * Time: 14:05
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

    <title>Dash-Exam Appointment</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="jumbotron.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

</head>

<body>
<?php include 'topnav.php'?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <br>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            Admin Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="modify_cem.php">
                            Exam Appointments<span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_course.php">
                            EEE Courses
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_staff.php">
                            Faculties
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_arealead.php">
                            Area Leads
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_status.php">
                            Review Status
                        </a>
                    </li>

                </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Exam Appointment</h1>
            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h4>Choose course to modify</h4>
                    <form class="form-inline" action="modify_cem.php">
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search by course" name="search">
                        <button type="submit" class="btn btn-success mb-2">Search</button>
                    </form>
                </div>
            </div>

            <div class="tablenotification">
                    <!-- Example row of columns -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width:9%;">
                                    <div class="btn-group dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Area
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="modify_cem.php?area=ECAL">ECAL</a>
                                            <a class="dropdown-item" href="modify_cem.php?area=ENIC">ENIC</a>
                                            <a class="dropdown-item" href="modify_cem.php?area=INON">INON</a>
                                            <a class="dropdown-item" href="modify_cem.php?area=HRH">HRH</a>
                                            <a class="dropdown-item" href="modify_cem.php?area=Others">Others</a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" style="width:33%;">Course</th>
                                <th scope="col">Coordinator</th>
                                <th scope="col">Examiner</th>
                                <th scope="col">Moderator</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            // The query() returns a buffered resultset, with number of rows in num_rows.
                            for ($r = 0; $r < $res->num_rows; ++$r) {
                                // Fetch current row into an associative array called $row
                                $row = $res->fetch_assoc();

                                echo <<<_END
                        
                        <tr onclick="location.href='examdetail.php?courseid={$row['courseid']}';">
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
                                    $sqlname="select * from staff where staffid=".$rowm['staffid']."";
                                    $resname=mysqli_query($link,$sqlname);
                                    $rowname = $resname->fetch_assoc();
                                    echo $rowname['name'];
                                    echo "<br>";
                                }
                                echo "</td>";

                                echo <<<_END
                    </tr>
_END;

                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
            </div> <!-- /container -->


        </main>

    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 19/2/19
 * Time: 14:34
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['removecourse'])){
            $sqlremove="delete from course where examid=".$_POST['examid'].";";
            $resremove=mysqli_query($link,$sqlremove);
        }
        else if(isset($_POST['modifyarea'])){
            $sqlarea="update course set area =".$_POST['modifyarea']."where courseid=;";
            $resarea=mysqli_query($link,$sqlarea);
        }

        $courseid=$_POST['courseid'];
    }

    else $courseid=$_GET['courseid'];

    $sql="select * from course where courseid=".$courseid.";";
    $res=mysqli_query($link,$sql);
    $row = $res->fetch_assoc();

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dash-Exam Details</title>

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
                            <span data-feather="home"></span>
                            Admin Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modify_cem.php">
                            <span data-feather="shopping-cart"></span>
                            Exam Appointments<span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="modify_course.php">
                            <span data-feather="shopping-cart"></span>
                            EEE Courses
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_staff.php">
                            <span data-feather="shopping-cart"></span>
                            Faculties
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_arealead.php">
                            <span data-feather="shopping-cart"></span>
                            Area Leads
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_status.php">
                            <span data-feather="shopping-cart"></span>
                            Review Status
                        </a>
                    </li>

                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>exam form template</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">EEE Course >> Details</h1>
            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h2><?php echo $row['code'];echo " - "; echo $row['coursename']?></h2>
                </div>
            </div>


            <div style="float:left; margin-left:50px;">
                <!-- Example row of columns -->
                <div class="table-responsive">
                    <table class="table">
                        <p>Click to change details</p>
                        <thead>
                        <tr>
                            <th scope="col" ">Area</th>
                            <th scope="col" ">Code</th>
                            <th scope="col" ">Coursename</th>
                            <th scope="col" ">Exam</th>
                            <th scope="col" ">Offered</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>
                                <a data-toggle="modal" data-target="#drop{$rowc['examid']}" href="#">{$rowname['name']}</a>
                                <!-- Modal Remove Coordinator-->
                                <div id="drop{$rowc['examid']}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <form action="examdetail.php" method="post">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Remove Faculty</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Do you want to remove <strong>{$rowname['name']}</strong> from <strong>Coordinator</strong>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" id="courseid" name="courseid" value="{$row['courseid']}">
                                                    <input type="hidden" id="examid" name="examid" value="{$rowc['examid']}">
                                                    <input type="submit" class="btn btn-danger" name="removefaculty" value="Remove">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div><br>
                            </td>

                        </tr>
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

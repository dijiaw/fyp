<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 19/3/19
 * Time: 04:59
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_POST['submitupdateadmin'])) {
        $admin_courseids = $_POST['checkcourse'];
        $n = count($admin_courseids);
        for ($i = 0; $i < $n; $i++) {
            $sql = "update tracking set adminid=". $_POST['newadminid']." where courseid=".$admin_courseids[$i]." order by courseid asc ;";
            $res = mysqli_query($link, $sql);
        }
    }

    if (isset($_GET['search'])){
        $sql="select * from course where exam='yes' and offered='yes' and (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
    }
    else if (isset($_GET['area'])){
        $sql="select * from course where exam='yes' and offered='yes' and area='".$_GET['area']."';";
    }
    else if (isset($_GET['ugpg'])){
        $sql="select * from course where exam='yes' and offered='yes' and ugpg='".$_GET['ugpg']."';";
    }
    else{
        $sql="select * from course where exam='yes' and offered='yes';";
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

    <title>Dash-Exam Reviewing Status</title>

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
                        <a class="nav-link" href="modify_cem.php">
                            Exam Appointments
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
                        <a class="nav-link active" href="modify_status.php">
                            Review Status<span class="sr-only">(current)</span>
                        </a>
                    </li>

                </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Exam Reviewing Status</h1>

            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h4>Search course</h4>
                    <form class="form-inline" action="modify_status.php">
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search by course" name="search">
                        <button type="submit" class="btn btn-success mb-2">Search</button>
                    </form>
                </div>
            </div>

            <form action="modify_status.php" method="post" id="updateadmin">
                <div class="tablenotification">
                    <div align="right">
                        Update Admin Assistant by: 1. choose selected course(s) from table; 2. Click the right side button
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-warning mb-2" data-toggle="modal" data-target="#updateadminassistantmodal">Update Admin Assistant</a>
                    </div>
                    <!-- Modal Add New Course-->
                    <div id="updateadminassistantmodal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Admin Assistant</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Update Admin Assistant for the selected courses by checking the following Admin Assistant name.</p>
                                    <?php
                                    $sqladminassistantquery="select * from login;";
                                    $resadminassistantquery=mysqli_query($link,$sqladminassistantquery);
                                    for ($r = 0; $r < $resadminassistantquery->num_rows; ++$r) {
                                        $rowadminassistantquery = $resadminassistantquery->fetch_assoc();
                                        echo <<<_END
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="newadminid" id="newadminid" value={$rowadminassistantquery['userid']}>
                                            <label class="form-check-label" for="adminassistant">{$rowadminassistantquery['lastname']} {$rowadminassistantquery['firstname']}</label>
                                        </div>
                                        <br>
_END;
                                    }
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="submitupdateadmin" id="submitupdateadmin">Update All</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Example row of columns -->
                    <div class="table-responsive">
                        <table class="table-striped">
                            <thead>
                            <tr>
                                <th scope="col" style="width:9%;">
                                    <div class="btn-group dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            UG/PG
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="modify_status.php?ugpg=UG">UG</a>
                                            <a class="dropdown-item" href="modify_status.php?ugpg=PG">PG</a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" style="width:8%;">
                                    <div class="btn-group dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="modify_status.php?area=ECAL">ECAL</a>
                                            <a class="dropdown-item" href="modify_status.php?area=ENIC">ENIC</a>
                                            <a class="dropdown-item" href="modify_status.php?area=INON">INON</a>
                                            <a class="dropdown-item" href="modify_status.php?area=HRH">HRH</a>
                                            <a class="dropdown-item" href="modify_status.php?area=Others">Others</a>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" style="width:43%;">Course</th>
                                <th scope="col">Status</th>
                                <th scope="col">Assistant</th>
                                <th scope="col">Select All&nbsp;<input type="checkbox" onclick="toggle(this)"></th>
                                <script language="JavaScript">
                                    function toggle(source) {
                                        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                        for (var i = 0; i < checkboxes.length; i++) {
                                            checkboxes[i].checked = source.checked;
                                        }
                                    }
                                </script>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // The query() returns a buffered resultset, with number of rows in num_rows.
                            for ($r = 0; $r < $res->num_rows; ++$r) {
                                // Fetch current row into an associative array called $row
                                $row = $res->fetch_assoc();
                                $sqltracking="select * from tracking where courseid=".$row['courseid'].";";
                                $restracking=mysqli_query($link,$sqltracking);
                                $rowtracking = $restracking->fetch_assoc();
                                $sqladmin="select * from login where userid=".$rowtracking['adminid'].";";
                                $resadmin=mysqli_query($link,$sqladmin);
                                $rowadmin = $resadmin->fetch_assoc();
                                $sqlstatus="select * from status where statusid=".$rowtracking['statusid'].";";
                                $resstatus=mysqli_query($link,$sqlstatus);
                                $rowstatus = $resstatus->fetch_assoc();
                                echo <<<_END
                        <tr>
                        <td>{$row['ugpg']}</td>
                        <td>{$row['area']}</td>
                        <td>{$row['code']}-{$row['coursename']}</td>
                        <td>{$rowstatus['status']}</td>
                        <td>{$rowadmin['lastname']} {$rowadmin['firstname']}</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="checkcourse[]" value="{$row['courseid']}"></td>
                     
                        </tr>
_END;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /container -->
            </form>

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
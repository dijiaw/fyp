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

    <title>Add New Course</title>

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
                        Admin Dashboard<span class="sr-only">(current)</span>
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_user.php">
                                Add New User
                            </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="add_course.php">
                            Add New Course
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="modify_course.php">
                            Modify Existing Course
                        </a>
                    </li>

                </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add New Course</h1>
            </div><br>

            <div class="addnewuser">
                    <div class="table-responsive">
                        <form action="add_course_result.php" method="post">
                            <table class="table table-hover">
                                <tr>
                                    <td>Course code</td>
                                    <td><input type="text" name="newcode" id="newcode" required></td>
                                </tr>
                                <tr>
                                    <td>Course name</td>
                                    <td><input type="text" name="newname" id="newname" required></td>
                                </tr>
                                <tr>
                                    <td>Area</td>
                                    <td><select id="newarea" name="newarea">
                                        <option value="ALL">ALL</option>
                                        <option value="ECAL">ECAL</option>
                                        <option value="ENIC">ENIC</option>
                                        <option value="INON">INON</option>
                                        <option value="HRH">HRH</option>
                                        <option value="Others">Others</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td><input type="text" name="newname" id="newname" required></td>
                                </tr>
                                <tr>
                                    <td>Exam</td>
                                    <td><select id="newexam" name="newexam">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Offered</td>
                                    <td><select id="newoffered" name="newoffered">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Undergraduate/Postgraduate</td>
                                    <td><select id="newugpg" name="newugpg">
                                        <option value="UG">UG</option>
                                        <option value="PG">PG</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Course type</td>
                                    <td><select id="newtype" name="newtype">
                                        <option value="LEC">LEC</option>
                                        <option value="TUT">TUT</option>
                                        <option value="LAB">LAb</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>TEL</td>
                                    <td><select id="newtel" name="newtel">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>AU(s)</td>
                                    <td><input type="number" name="newau" id="newau" required></td>
                                </tr>
                                <tr>
                                    <td>Year</td>
                                    <td><input type="number" name="newyear" id="newyear" required></td>
                                </tr>
                                <tr>
                                    <td>Hours per staff</td>
                                    <td><input type="number" name="newhoursperstaff" id="newhoursperstaff" required></td>
                                </tr>
                                <tr>
                                    <td>Number of groups</td>
                                    <td><input type="number" name="newnumofgroups" id="newnumofgroups" required></td>
                                </tr>
                                <tr>
                                    <td>Number of weeks</td>
                                    <td><input type="number" name="newnumofweeks" id="newnumofweeks" required></td>
                                </tr>
                                <tr>
                                    <td>Hours per week</td>
                                    <td><input type="number" name="newhoursperweek" id="newhoursperweek" required></td>
                                </tr>
                            </table>
                            <input type="submit" class="btn btn-success mb-2" name="newuser" style="float:right;" onclick=newcourse()>
                            <script>

                            </script>
                        </form>
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

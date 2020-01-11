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

    <title>Modify Existing Course</title>

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
                        <a class="nav-link" href="add_course.php">
                            Add New Course
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="modify_course.php">
                            Modify Existing Course
                        </a>
                    </li>

                </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modify Exisitng Course</h1>
            </div><br>

            <div class="addnewuser">
                    <div class="table-responsive">
                        <form action="modify_course_result.php" method="post">
                            <table class="table table-hover">
                                <?php
                                    echo "
                                        <input name='hiddencode' type='hidden' id='hiddencode'>
                                        <tr>
                                            <td>Course code</td>
                                            <td><select id='excode' name='excode' onchange='changecode(this.value)'>
                                            <script>
                                                function changecode(val){
                                                    // var exschoolEle = document.getElementById('exschool');
                                                    // exschoolEle.value = val;
                                                    window.location.href = 'modify_course.php?code=' + val;
                                                }
                                            </script>
                                            ";                             
                                    $sql="select * from course";
                                    $res=mysqli_query($link,$sql);
                                    $currentcode = $_GET['code'];
                                    for ($j = 0; $j < $res->num_rows; ++$j) {
                                        $row = $res -> fetch_assoc();
                                        if ($row['code'] == $currentcode) {
                                            echo "<option value='{$row['code']}' selected>{$row['code']}</option>";
                                        }
                                        else echo "<option value='{$row['code']}'>{$row['code']}</option>";
                                    }
                                    echo "</select></td></tr>";    
                                ?>
                                <tr>
                                    <td>Course name</td>
                                    <td><input type="text" name="exname" id="exname" style="width: 16%;" disabled></td>
                                </tr>
                                <tr>
                                    <td>Area</td>
                                    <td><select id="exarea" name="exarea">
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
                                    <td><input type="text" name="exschool" id="exschool" required></td>
                                </tr>
                                <tr>
                                    <td>Exam</td>
                                    <td><select id="exexam" name="exexam">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Offered</td>
                                    <td><select id="exoffered" name="exoffered">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Undergraduate/Postgraduate</td>
                                    <td><select id="exugpg" name="exugpg">
                                        <option value="UG">UG</option>
                                        <option value="PG">PG</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Course type</td>
                                    <td><select id="extype" name="extype">
                                        <option value="LEC">LEC</option>
                                        <option value="TUT">TUT</option>
                                        <option value="LAB">LAb</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>TEL</td>
                                    <td><select id="extel" name="extel">
                                        <option value="yes">yes</option>
                                        <option value="no">no</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>AU(s)</td>
                                    <td><input type="number" name="exau" id="exau" required></td>
                                </tr>
                                <tr>
                                    <td>Year</td>
                                    <td><input type="number" name="exyear" id="exyear" required></td>
                                </tr>
                                <tr>
                                    <td>Hours per staff</td>
                                    <td><input type="number" name="exhoursperstaff" id="exhoursperstaff" required></td>
                                </tr>
                                <tr>
                                    <td>Number of groups</td>
                                    <td><input type="number" name="exnumofgroups" id="exnumofgroups" required></td>
                                </tr>
                                <tr>
                                    <td>Number of weeks</td>
                                    <td><input type="number" name="exnumofweeks" id="exnumofweeks" required></td>
                                </tr>
                                <tr>
                                    <td>Hours per week</td>
                                    <td><input type="number" name="exhoursperweek" id="exhoursperweek" required></td>
                                </tr>
                                <script type="text/javascript">
                                    function load(name, school, area, exam, offered, ugpg, type, tel, au, year, hoursperstaff,
                                    numofgroups, numofweeks, hoursperweek){
                                        document.getElementById('exname').value = name;
                                        document.getElementById('exschool').value = school;
                                        document.getElementById('exarea').value = area;
                                        document.getElementById('exexam').value = exam;
                                        document.getElementById('exoffered').value = offered;
                                        document.getElementById('exugpg').value = ugpg;
                                        document.getElementById('extype').value = type;
                                        document.getElementById('extel').value = tel;
                                        document.getElementById('exau').value = au;
                                        document.getElementById('exyear').value = year;
                                        document.getElementById('exhoursperstaff').value = hoursperstaff;
                                        document.getElementById('exnumofgroups').value = numofgroups;
                                        document.getElementById('exnumofweeks').value = numofweeks;
                                        document.getElementById('exhoursperweek').value = hoursperweek;
                                    }
                                </script>
                                <?php
                                    if ($_GET['code']) {
                                        $code = $_GET['code'];
                                        $sql2 = "select * from course where code = '".$code."'";
                                        $res2 = mysqli_query($link, $sql2);
                                        $row2 = $res2 -> fetch_assoc();
                                        $name = $row2['coursename'];
                                        $school = $row2['school'];
                                        $area = $row2['area'];
                                        $exam = $row2['exam'];
                                        $offered = $row2['offered'];
                                        $ugpg = $row2['ugpg'];
                                        $type = $row2['type'];
                                        $tel = $row2['tel'];
                                        $au = $row2['au'];
                                        $year = $row2['year'];
                                        $hoursperstaff = $row2['hoursperstaff'];
                                        $numofgroups = $row2['numofgroups'];
                                        $numofweeks = $row2['numofweeks'];
                                        $hoursperweek = $row2['hoursperweek'];
                                        echo "<script>load('".$name."', '".$school."', '".$area."', '".$exam."'
                                        , '".$offered."', '".$ugpg."', '".$type."', '".$tel."', '".$au."', '".$year."'
                                        , '".$hoursperstaff."', '".$numofgroups."', '".$numofweeks."', '".$hoursperweek."');</script>";
                                    }        
                                ?>
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

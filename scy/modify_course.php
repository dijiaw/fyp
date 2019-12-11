<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 19/2/19
 * Time: 13:47
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_POST['addcoursesubmit'])){
        $sql="insert into course (area, code, coursename, exam, offered, ugpg) 
                    values ('".$_POST['coursearea']."','".$_POST['coursecode']."','".$_POST['coursename']."','".$_POST['exam']."','".$_POST['offered']."','".$_POST['ugpg']."')";
        $res=mysqli_query($link,$sql);
        $sqlnewid="select * from course where coursename='".$_POST['coursename']."'";
        $resnewid=mysqli_query($link,$sqlnewid);
        $rownewid = $resnewid->fetch_assoc();

        $sql="insert into tracking (courseid) 
                    values (".$rownewid['courseid'].")";
        $res=mysqli_query($link,$sql);
    }
    else if (isset($_GET['updatecourse'])){
        $sql="update course 
              set ugpg='".$_GET['updateugpg']."', area='".$_GET['updatearea']."', code='".$_GET['updatecode']."', coursename='".$_GET['updatecoursename']."', 
                exam='".$_GET['updateexam']."', offered='".$_GET['updateoffered']."'
              where courseid=".$_GET['updatecourse']."; ";
        $res=mysqli_query($link,$sql);
    }
    else if (isset($_GET['confirmdelete'])){
        $sql="delete from course where courseid=".$_GET['confirmdelete'].";";
        $res=mysqli_query($link,$sql);

        $sql="delete from tracking where courseid=".$_GET['confirmdelete'].";";
        $res=mysqli_query($link,$sql);
    }


    if (isset($_GET['search'])){
        $sql="select * from course where (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
    }
    else if (isset($_GET['area'])){
        $sql="select * from course where area='".$_GET['area']."';";
    }
    else if (isset($_GET['ugpg'])){
        $sql="select * from course where ugpg='".$_GET['ugpg']."';";
    }
    else if (isset($_GET['exam'])){
        $sql="select * from course where exam='".$_GET['exam']."';";
    }
    else if (isset($_GET['offered'])){
        $sql="select * from course where offered='".$_GET['offered']."';";
    }
    else{
        $sql="select * from course;";
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
                        <a class="nav-link" href="modify_cem.php">
                            Exam Appointments<span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link  active" href="modify_course.php">
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
                <h1 class="h2">EEE Courses</h1>
                <a class="text-justify btn-sm" href="#" data-toggle="modal" data-target="#addcourse">ADD COURSE
                    <span data-feather="plus-circle"></span>
                </a>
                <!-- Modal Add New Course-->
                <div id="addcourse" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form id="addcourseform" action="modify_course.php" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Course</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="coursecode">Course Code</label>
                                        <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="e.g. EE3012 or EE3012 / IM3002" required>
                                        <small class="form-text text-muted">add a SPACE on each side of "/" when adding IEM code</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="coursename">Course Name</label>
                                        <input type="text" class="form-control" id="coursename" name="coursename" placeholder="e.g. COMMUNICATION PRINCIPLES" required>
                                    </div>

                                    <p style="margin-bottom: 5px;">UG/PG</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ugpg" id="u" value="UG">
                                        <label class="form-check-label" for="u">UG</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ugpg" id="p" value="PG">
                                        <label class="form-check-label" for="p">PG</label>
                                    </div>

                                    <p style="margin-bottom: 5px; margin-top: 10px;">Area</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="coursearea" id="1" value="ECAL">
                                        <label class="form-check-label" for="1">ECAL</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="coursearea" id="2" value="ENIC">
                                        <label class="form-check-label" for="2">ENIC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="coursearea" id="3" value="INON">
                                        <label class="form-check-label" for="3">INON</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="coursearea" id="4" value="HRH">
                                        <label class="form-check-label" for="4">HRH</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="coursearea" id="5" value="Others">
                                        <label class="form-check-label" for="5">Others</label>
                                    </div>

                                    <p style="margin-bottom: 5px; margin-top: 10px;">Final exam?</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exam" id="y" value="yes">
                                        <label class="form-check-label" for="n">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exam" id="n" value="no">
                                        <label class="form-check-label" for="n">No</label>
                                    </div>

                                    <p style="margin-bottom: 5px; margin-top: 10px;">Offer this sem?</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="offered" id="y" value="yes">
                                        <label class="form-check-label" for="n">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="offered" id="n" value="no">
                                        <label class="form-check-label" for="n">No</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="addcoursesubmit" id="addcoursesubmit">Add</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h4>Choose course to modify</h4>
                    <form class="form-inline" action="modify_course.php">
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search by course" name="search">
                        <button type="submit" class="btn btn-success mb-2">Search</button>
                    </form>
                </div>
            </div>

            <div class="tablenotification">
                <!-- Example row of columns -->
                <div class="table-responsive">
                    <table class="table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Edit</th>
                            <th scope="col" style="width:9%;">
                                <div class="btn-group dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        UG/PG
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="modify_course.php?ugpg=UG">UG</a>
                                        <a class="dropdown-item" href="modify_course.php?ugpg=PG">PG</a>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" style="width:8%;">
                                <div class="btn-group dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="modify_course.php?area=ECAL">ECAL</a>
                                        <a class="dropdown-item" href="modify_course.php?area=ENIC">ENIC</a>
                                        <a class="dropdown-item" href="modify_course.php?area=INON">INON</a>
                                        <a class="dropdown-item" href="modify_course.php?area=HRH">HRH</a>
                                        <a class="dropdown-item" href="modify_course.php?area=Others">Others</a>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" style="width:18%;">Code</th>
                            <th scope="col">Course</th>
                            <th scope="col" style="width:8%;">
                                <div class="btn-group dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exam</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="modify_course.php?exam=yes">Yes</a>
                                        <a class="dropdown-item" href="modify_course.php?exam=no">No</a>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" style="width:8%;">
                                <div class="btn-group dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Offer
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="modify_course.php?offered=yes">Yes</a>
                                        <a class="dropdown-item" href="modify_course.php?offered=no">No</a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        // The query() returns a buffered resultset, with number of rows in num_rows.
                        for ($r = 0; $r < $res->num_rows; ++$r) {
                            // Fetch current row into an associative array called $row
                            $row = $res->fetch_assoc();

                            echo <<<_END
                        
                        <form id="updatecourseform" action="modify_course.php">
                        <tr>
                        <td> <input type="checkbox" id="editcheck{$row['courseid']}"></td>
                        <td>
                            <div class="form-group">
                            <select disabled class="form-control" id="updateugpg{$row['courseid']}" name="updateugpg">
_END;
                            if ($row['ugpg']=='UG'){
                                echo "<option selected=\"selected\">UG</option>";
                                echo "<option>PG</option>";
                            }
                            else {
                                echo "<option>UG</option>";
                                echo "<option selected=\"selected\">PG</option>";
                            }
                            echo "</select></div></td>";

//                          course area
                            echo"<td><div class='form-group'><select disabled class='form-control' id='updatearea{$row['courseid']}' name='updatearea'>";
                            if ($row['area']=='ECAL'){
                                echo "<option selected=\"selected\">ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                            }
                            else if ($row['area']=='ENIC'){
                                echo "<option>ECAL</option>";
                                echo "<option selected=\"selected\">ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                            }
                            else if ($row['area']=='INON'){
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option selected=\"selected\">INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                            }
                            else if ($row['area']=='HRH'){
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option selected=\"selected\">HRH</option>";
                                echo "<option>Others</option>";
                            }
                            else{
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option selected=\"selected\">Others</option>";
                            }
                            echo "</select></div></td>";

//                           course code
                            echo"<td><div class='form-group'><input type='text' disabled class='form-control' id='updatecode{$row['courseid']}' name='updatecode' value='{$row['code']}'>";
                            echo "</div></td>";

//                            course name
                            echo"<td><div class='form-group'><input type='text' disabled class='form-control' id='updatecoursename{$row['courseid']}' name='updatecoursename' value='{$row['coursename']}'>";
                            echo "</div></td>";

//                            exam
                            echo"<td><div class='form-group'><select disabled class='form-control' id='updateexam{$row['courseid']}' name='updateexam'>";
                            if ($row['exam']=='yes'){
                                echo "<option selected=\"selected\">yes</option>";
                                echo "<option>no</option>";
                            }
                            else{
                                echo "<option>yes</option>";
                                echo "<option selected=\"selected\">no</option>";
                            }
                            echo "</select></div></td>";

//                            offered
                            echo"<td><div class='form-group'><select disabled class='form-control' id='updateoffered{$row['courseid']}' name='updateoffered'>";
                            if ($row['offered']=='yes'){
                                echo "<option selected=\"selected\">yes</option>";
                                echo "<option>no</option>";
                            }
                            else{
                                echo "<option>yes</option>";
                                echo "<option selected=\"selected\">no</option>";
                            }
                            echo "</select></div></td>";

                                echo <<<_END
                                
                        <td>
                        <button type="submit" class="btn btn-sm btn-success" name="updatecourse" style="font-size:70%" id="updatecourse{$row['courseid']}" value="{$row['courseid']}" disabled>Update</button>
                      
                        <!--enableEdit-->
                        <script>
                            document.getElementById('editcheck{$row['courseid']}').onchange = function() {
                                    document.getElementById('updateugpg{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updatearea{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updatecode{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updatecoursename{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updateexam{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updateoffered{$row['courseid']}').disabled = !this.checked;
                                    document.getElementById('updatecourse{$row['courseid']}').disabled = !this.checked;
                                };
                        </script>
                        </form>
                        
                            <a class="btn-outline-dark btn btn-sm" style="font-size:70%; margin-top:3px;" data-toggle="modal" data-target="#delete{$row['courseid']}">Delete</a>
                                 <!-- Modal Delete Role-->
                                <div id="delete{$row['courseid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    
                                      <form id="deletecourseform" action="modify_course.php">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Delete Course</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are you sure to delete the following course from the database?<br><strong>{$row['code']}<br>{$row['coursename']}</strong></p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="confirmdelete" id="confirmdelete" value="{$row['courseid']}">Confirm Delete</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div>
                        </td>
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

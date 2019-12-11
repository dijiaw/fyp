<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 19/3/19
 * Time: 04:58
 */

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_POST['addstaffsubmit'])){
        $sql="insert into staff (area, name, email, appointment) 
                    values ('".$_POST['staffarea']."','".$_POST['staffname']."','".$_POST['staffemail']."','".$_POST['staffappointment']."');";
        $res=mysqli_query($link,$sql);
    }
    else if (isset($_GET['updatestaff'])){
        $sql="update staff 
              set area='".$_GET['updatearea']."', name='".$_GET['updatename']."', email='".$_GET['updateemail']."', appointment='".$_GET['updateappointment']."'
              where staffid=".$_GET['updatestaff']."; ";
        $res=mysqli_query($link,$sql);
    }
    else if (isset($_GET['confirmdelete'])){
        $sql="delete from staff where staffid=".$_GET['confirmdelete'].";";
        $res=mysqli_query($link,$sql);
    }


    if (isset($_GET['search'])){
        $sql="select * from staff where (name like '%".$_GET['search']."%' or email like '%".$_GET['search']."%')";
    }
    else if (isset($_GET['area'])){
        $sql="select * from staff where area='".$_GET['area']."';";
    }
    else{
        $sql="select * from staff;";
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
                        <a class="nav-link " href="modify_course.php">
                            EEE Courses
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="modify_staff.php">
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
                <h1 class="h2">Faculties</h1>
                <a class="text-justify btn-sm" href="#" data-toggle="modal" data-target="#addstaff">ADD FACULTY
                    <span data-feather="plus-circle"></span>
                </a>
                <!-- Modal Add New Staff-->
                <div id="addstaff" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form id="addstaffform" action="modify_staff.php" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Staff</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="staffname">Name*</label>
                                        <input type="text" class="form-control" id="staffname" name="staffname" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="staffemail">E-mail*</label>
                                        <input type="email" class="form-control" id="staffemail" name="staffemail" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="staffappointment">Appointment*</label>
                                        <input type="text" class="form-control" id="staffappointment" name="staffappointment" placeholder="e.g. Associate Professor/ Admin Staff" required>
                                    </div>

                                    <p style="margin-bottom: 5px; margin-top: 10px;">Area*</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="1" value="ECAL">
                                        <label class="form-check-label" for="1">ECAL</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="2" value="ENIC">
                                        <label class="form-check-label" for="2">ENIC</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="3" value="INON">
                                        <label class="form-check-label" for="3">INON</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="4" value="HRH">
                                        <label class="form-check-label" for="4">HRH</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="5" value="Others">
                                        <label class="form-check-label" for="5">Others</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="staffarea" id="5" value="Admin">
                                        <label class="form-check-label" for="5">Admin</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="addstaffsubmit" id="addstaffsubmit">Add</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h4>Choose staff to modify</h4>
                    <form class="form-inline" action="modify_staff.php">
                        <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="staff name or email" name="search">
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
                            <th scope="col" style="width:8%;">
                                <div class="btn-group dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="modify_staff.php?area=ECAL">ECAL</a>
                                        <a class="dropdown-item" href="modify_staff.php?area=ENIC">ENIC</a>
                                        <a class="dropdown-item" href="modify_staff.php?area=INON">INON</a>
                                        <a class="dropdown-item" href="modify_staff.php?area=HRH">HRH</a>
                                        <a class="dropdown-item" href="modify_staff.php?area=Others">Others</a>
                                        <a class="dropdown-item" href="modify_staff.php?area=Admin">Admin</a>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" style="width:18%;">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Appointment</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        // The query() returns a buffered resultset, with number of rows in num_rows.
                        for ($r = 0; $r < $res->num_rows; ++$r) {
                            // Fetch current row into an associative array called $row
                            $row = $res->fetch_assoc();

                            echo <<<_END
                        
                        <form id="updatestaffform" action="modify_staff.php">
                        <tr>
                        <td> <input type="checkbox" id="editcheck{$row['staffid']}"></td>
_END;

//                          staff area
                            echo"<td><div class='form-group'><select disabled class='form-control' id='updatearea{$row['staffid']}' name='updatearea'>";
                            if ($row['area']=='ECAL'){
                                echo "<option selected=\"selected\">ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                                echo "<option>Admin</option>";
                            }
                            else if ($row['area']=='ENIC'){
                                echo "<option>ECAL</option>";
                                echo "<option selected=\"selected\">ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                                echo "<option>Admin</option>";
                            }
                            else if ($row['area']=='INON'){
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option selected=\"selected\">INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                                echo "<option>Admin</option>";
                            }
                            else if ($row['area']=='HRH'){
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option selected=\"selected\">HRH</option>";
                                echo "<option>Others</option>";
                                echo "<option>Admin</option>";
                            }
                            else if ($row['area']=='Others'){
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option selected=\"selected\">Others</option>";
                                echo "<option>Admin</option>";
                            }
                            else{
                                echo "<option>ECAL</option>";
                                echo "<option>ENIC</option>";
                                echo "<option>INON</option>";
                                echo "<option>HRH</option>";
                                echo "<option>Others</option>";
                                echo "<option selected=\"selected\">Admin</option>";
                            }
                            echo "</select></div></td>";

//                           staff name
                            echo"<td><div class='form-group'><input type='text' disabled class='form-control' id='updatename{$row['staffid']}' name='updatename' value='{$row['name']}'>";
                            echo "</div></td>";

//                            staff email
                            echo"<td><div class='form-group'><input type='text' disabled class='form-control' id='updateemail{$row['staffid']}' name='updateemail' value='{$row['email']}'>";
                            echo "</div></td>";

                            // staff appointment
                            echo"<td><div class='form-group'><input type='text' disabled class='form-control' id='updateappointment{$row['staffid']}' name='updateappointment' value='{$row['appointment']}'>";
                            echo "</div></td>";

                            echo <<<_END
                                
                        <td>
                        <button type="submit" class="btn btn-sm btn-success" name="updatestaff" style="font-size:70%" id="updatestaff{$row['staffid']}" value="{$row['staffid']}" disabled>Update</button>
                      
                        <!--enableEdit-->
                        <script>
                            document.getElementById('editcheck{$row['staffid']}').onchange = function() {
                                    document.getElementById('updatearea{$row['staffid']}').disabled = !this.checked;
                                    document.getElementById('updatename{$row['staffid']}').disabled = !this.checked;
                                    document.getElementById('updateemail{$row['staffid']}').disabled = !this.checked;
                                    document.getElementById('updateappointment{$row['staffid']}').disabled = !this.checked;
                                    document.getElementById('updatestaff{$row['staffid']}').disabled = !this.checked;
                                };
                        </script>
                        </form>
                        
                            <a class="btn-outline-dark btn btn-sm" style="font-size:70%; margin-top:3px;" data-toggle="modal" data-target="#delete{$row['staffid']}">Delete</a>
                                 <!-- Modal Delete Role-->
                                <div id="delete{$row['staffid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    
                                      <form id="deletestaffform" action="modify_staff.php">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Delete Staff</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are you sure to delete the following staff from the database?<br><strong>{$row['appointment']}<br>{$row['name']}<br>{$row['email']}</strong></p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="confirmdelete" id="confirmdelete" value="{$row['staffid']}">Confirm Delete</button>
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

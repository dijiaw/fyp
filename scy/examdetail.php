<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 13/1/19
 * Time: 17:48
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
        if (isset($_POST['removefaculty'])){
            $sqlremove="delete from examstaff where examid=".$_POST['examid'].";";
            $resremove=mysqli_query($link,$sqlremove);
        }
        else if (isset($_POST['searchfaculty'])){
            $sqlsearchfaculty="select * from staff where name like '%".$_POST['search']."%';";
            $ressearchfaculty=mysqli_query($link,$sqlsearchfaculty);
        }
        else if(isset($_POST['addfaculty'])){
            $sqladd="insert into examstaff(staffid, courseid, role) values (".$_POST['staffid'].",".$_POST['courseid'].",'".$_POST['examrole']."');";
            $resadd=mysqli_query($link,$sqladd);
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
                <h1 class="h2">Exam Appointment >> Details</h1>
            </div><br>

            <div class="jumbotron">
                <div class="container">
                    <h2><?php echo $row['code'];echo " - "; echo $row['coursename']?></h2>
                </div>
            </div>

            <div class="col-md-4 d-md-block jumbotron" style="float:left;background-image: none; border:1px solid grey;">
                <h4>Remove Faculty</h4>
                <p>Remove Faculty by clicking the name on the right side.</p>
                <h4>Add Faculty</h4>
                <form class="form-inline" action="examdetail.php" method="post">
                    <input type="hidden" id="courseid" name="courseid" value="<?php echo $row['courseid'] ?>">
                    <input type="text" class="form-control mb-2 mr-sm-1" id="inlineFormInputName2" placeholder="search by faculty name" name="search">
                    <input type="submit" class="btn btn-success mb-2" name="searchfaculty" value="Go">
                </form>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <?php
                        if (!empty($ressearchfaculty)){
                        for ($i=0; $i < $ressearchfaculty->num_rows; ++$i){
                            $rowsearchfaculty = $ressearchfaculty->fetch_assoc();
                            echo <<<_END
                            <tr data-toggle="modal" data-target="#add{$rowsearchfaculty['staffid']}" href="#">
                            <td>{$rowsearchfaculty['name']}<br>
                                {$rowsearchfaculty['email']}<br>
                                {$rowsearchfaculty['appointment']}
                            </td>
                            </tr>
                            <!-- Modal Remove Coordinator-->
                                <div id="add{$rowsearchfaculty['staffid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form action="examdetail.php" method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Add Faculty</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Choose the following role for <strong>{$rowsearchfaculty['name']}</strong> in <strong>{$row['code']}</strong>.</p>
                                        <input class="custom-radio position-static" type="radio" name="examrole" id="examrole" value="C"> Coordinator <br>
                                        <input class="custom-radio position-static" type="radio" name="examrole" id="examrole" value="E"> Examiner <br>
                                        <input class="custom-radio position-static" type="radio" name="examrole" id="examrole" value="M"> Moderator <br>
                                      </div>
                                      <div class="modal-footer">
                                      <input type="hidden" id="staffid" name="staffid" value="{$rowsearchfaculty['staffid']}">
                                      <input type="hidden" id="courseid" name="courseid" value="{$row['courseid']}">
                                       
                                        <input type="submit" class="btn btn-success" name="addfaculty" value="Add">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div><br>
_END;
                        }}
                        ?>
                        </tbody>
                    </table>
                </div>


            </div>

            <div style="float:left; margin-left:50px;">
                <!-- Example row of columns -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" ">Coordinator</th>
                            <th scope="col" ">Examiner</th>
                            <th scope="col" ">Moderator</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        // The query() returns a buffered resultset, with number of rows in num_rows.
                            echo "<tr>";
                            $sqlc="select * from examstaff where courseid=".$courseid." AND role='C';";
                            $resc=mysqli_query($link,$sqlc);
                            echo "<td>";
                            for ($i=0; $i< $resc->num_rows; ++$i){
                                $rowc=$resc->fetch_assoc();
                                $sqlname="select * from staff where staffid=".$rowc['staffid'].";";
                                $resname=mysqli_query($link,$sqlname);
                                $rowname = $resname->fetch_assoc();

                                echo <<<_END
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
_END;
                            }
                            echo "</td>";


                            $sqle="select * from examstaff where courseid=".$courseid." AND role='E';";
                            $rese=mysqli_query($link,$sqle);
                            echo "<td>";
                            for ($i=0; $i< $rese->num_rows; ++$i){
                                $rowe=$rese->fetch_assoc();
                                $sqlname="select * from staff where staffid=".$rowe['staffid']."";
                                $resname=mysqli_query($link,$sqlname);
                                $rowname = $resname->fetch_assoc();

                                echo <<<_END
                                <a data-toggle="modal" data-target="#drop{$rowe['examid']}" href="#">{$rowname['name']}</a>
                                <!-- Modal Remove Examiner-->
                                <div id="drop{$rowe['examid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form action="examdetail.php"  method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Remove Faculty</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Do you want to remove <strong>{$rowname['name']}</strong> from <strong>Examiner</strong>?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="hidden" id="courseid" name="courseid" value="{$row['courseid']}">
                                        <input type="hidden" id="examid" name="examid" value="{$rowe['examid']}">
                                        <input type="submit" class="btn btn-danger" name="removefaculty" value="Remove">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div><br>
_END;
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

                                echo <<<_END
                                <a data-toggle="modal" data-target="#drop{$rowm['examid']}" href="#">{$rowname['name']}</a>
                                <!-- Modal Remove Moderator-->
                                <div id="drop{$rowm['examid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form action="examdetail.php"  method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Remove Faculty</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Do you want to remove <strong>{$rowname['name']}</strong> from <strong>Moderator</strong>?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="hidden" id="courseid" name="courseid" value="{$row['courseid']}">
                                        <input type="hidden" id="examid" name="examid" value="{$rowm['examid']}">
                                        <input type="submit" class="btn btn-danger" name="removefaculty" value="Remove">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div><br>
_END;
                            }
                            echo "</td></tr>";
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

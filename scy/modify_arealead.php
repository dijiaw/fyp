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
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['searchfaculty'])){
            $sqlsearchfaculty="select * from staff where name like '%".$_POST['search']."%';";
            $ressearchfaculty=mysqli_query($link,$sqlsearchfaculty);
        }
        else if(isset($_POST['changefaculty'])){
            $sqladd="update area set leadid=".$_POST['staffid']." where area='".$_POST['arealead']."';";
            $resadd=mysqli_query($link,$sqladd);
        }
    }

    $sql="select * from area;";
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
                        <a class="nav-link" href="modify_cem.php">
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
                        <a class="nav-link active" href="modify_arealead.php">
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
                <h1 class="h2">Area Leads</h1>
            </div><br>
            <div class="col-md-4 d-md-block jumbotron" style="float:left;background-image: none; border:1px solid grey;">
                <h4>Change Area Lead</h4>
                <form class="form-inline" action="modify_arealead.php" method="post">
                    <input type="text" class="form-control mb-2 mr-sm-1" id="inlineFormInputName2" placeholder="search new lead name" name="search">
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
                            <tr data-toggle="modal" data-target="#change{$rowsearchfaculty['staffid']}" href="#">
                            <td>{$rowsearchfaculty['name']}<br>
                                {$rowsearchfaculty['email']}<br>
                                {$rowsearchfaculty['appointment']}
                            </td>
                            </tr>
                            <!-- Modal Change Area Lead-->
                                <div id="change{$rowsearchfaculty['staffid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form action="modify_arealead.php" method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Change Area Lead</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Change the lead of the following area to be <strong>{$rowsearchfaculty['name']}</strong>.</p>
                                        <input class="custom-radio position-static" type="radio" name="arealead" id="arealead" value="ECAL"> ECAL <br>
                                        <input class="custom-radio position-static" type="radio" name="arealead" id="arealead" value="ENIC"> ENIC <br>
                                        <input class="custom-radio position-static" type="radio" name="arealead" id="arealead" value="HRH"> HRH <br>
                                        <input class="custom-radio position-static" type="radio" name="arealead" id="arealead" value="INON"> INON <br>
                                        <input class="custom-radio position-static" type="radio" name="arealead" id="arealead" value="Others"> Others <br>
                                      </div>
                                      <div class="modal-footer">
                                      <input type="hidden" id="staffid" name="staffid" value="{$rowsearchfaculty['staffid']}">
                                        <input type="submit" class="btn btn-success" name="changefaculty" value="Change">
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
                            <th scope="col" ">Area</th>
                            <th scope="col" ">Lead Name</th>
                            <th scope="col" ">Email</th>
                            <th scope="col" ">Appointment</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        for($r = 0; $r<$res->num_rows; ++$r){
                            $row = $res->fetch_assoc();
                            $sqllead="select * from staff where staff.staffid=".$row['leadid'].";";
                            $reslead=mysqli_query($link,$sqllead);
                            $rowlead= $reslead->fetch_assoc();
                            echo <<<_END
                        <tr>
                        <td>{$row['area']}</td>
                        <td>{$rowlead['name']}</td>
                        <td>{$rowlead['email']}</td>
                        <td>{$rowlead['appointment']}</td>
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

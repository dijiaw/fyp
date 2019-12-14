<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_GET['confirmdelete'])){
        $sqlmodal="delete from login where userid=".$_GET['confirmdelete'].";";
        $resmodal=mysqli_query($link,$sqlmodal);
    }
    else if (isset($_POST['editrole']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        echo"success";
        $sqlmodal="update login set role='".$_POST['role']."' where userid=".$_POST['userid'].";";
        $resmodal=mysqli_query($link,$sqlmodal);
    }
    else if (isset($_GET['changepassword'])){
        $sqlmodal="update login set password= md5(".$_GET['changepasswordinput'].") where userid=".$_GET['changepassword'].";";
        $resmodal=mysqli_query($link,$sqlmodal);
    }
    $sql="select * from login where userid<>".$_SESSION["userid"].";";
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

    <title>Dashboard</title>

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
                <a class="nav-link active" href="dashboard.php">
                   Admin Dashboard<span class="sr-only">(current)</span>
                </a>
              </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="modify_cem.php">
                         All Courses
                    </a>
                </li> -->

              <!-- <li class="nav-item">
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
                </li> -->

            </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Dashboard</h1>
          </div><br>

            <div class="table-responsive">
                <table class="table table-hover" style="width:80%; margin:auto;">
                    <div style="width:80%; margin:auto;"><h3>Active User Accounts</h3></div>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
<!--                        <th>Responsible Area</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($r = 0; $r<$res->num_rows; ++$r){
                        $row = $res->fetch_assoc();
                        $sqlrole="select area.area from area, login where login.email='".$row['email']."' and area.areaid=login.areaid;";
                        $resrole=mysqli_query($link,$sqlrole);
                        $rowrole= $resrole->fetch_assoc();
                        echo <<<_END
                        <tr>
                        <td>{$row['lastname']} {$row['firstname']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a data-toggle="modal" data-target="#role{$row['userid']}" href="#">{$row['role']}</a>
                                <!-- Modal Change Role-->
                                <div id="role{$row['userid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form action="dashboard.php" method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Edit Role</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Please choose role for <strong>{$row['lastname']} {$row['firstname']}</strong>.</p>
                                        <div style="margin-left:20px;">
                                        <input type="hidden" id="userid" name="userid" value="{$row['userid']}">
                                        <input class="custom-radio position-static" type="radio" name="role" id="role" value="normal"> Normal <br>
                                        <input class="custom-radio position-static" type="radio" name="role" id="role" value="admin"> Admin <br>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="submit" class="btn btn-success" name="editrole" value="Save">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div>
                        </td>
                        
                        <td><a class="btn-outline-dark btn btn-sm" data-toggle="modal" data-target="#delete{$row['userid']}">Delete</a>
                        <!-- Modal Delete Role-->
                                <div id="delete{$row['userid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    
                                      <form action="dashboard.php">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Delete User</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are you sure to delete the user access of <strong>{$row['lastname']} {$row['firstname']}</strong>?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="confirmdelete" id="confirmdelete" value="{$row['userid']}">Confirm Delete</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                      </div>
                                      </form>
                                      
                                    </div>
                                  </div>
                                </div>
                        </td>
                        <td><a class="btn-outline-dark btn btn-sm" data-toggle="modal" data-target="#changepassword{$row['userid']}">Change Password</a>
                        <!-- Modal Delete Role-->
                                <div id="changepassword{$row['userid']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    
                                      <form action="dashboard.php">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Change User Password</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Please enter the new password for user <strong>{$row['lastname']} {$row['firstname']}</strong>?</p>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="changepasswordinput" placeholder="new password" name="changepasswordinput">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="changepassword" id="changepassword" value="{$row['userid']}">Confirm Change Password</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 23/12/18
 * Time: 07:18
 */
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    if (isset($_POST['updateadminbtn'])){
        if ($_POST['updatestatus']=='Drafting'){
            $newid=1;
        }
        else if ($_POST['updatestatus']=='Area Lead Reviewing'){
            $newid=2;
        }
        else if ($_POST['updatestatus']=='Acad Review (OAS)'){
            $newid=3;
        }
        else if ($_POST['updatestatus']=='Acad Review (non OAS)'){
            $newid=4;
        }
        else if ($_POST['updatestatus']=='Chair Reviewing'){
            $newid=5;
        }
        $sql="update tracking set statusid=".$newid." where courseid=".$_POST['updateadminbtn']." ; ";
        $res=mysqli_query($link,$sql);
    }

    if (isset($_GET['search'])){
        if($_SESSION["role"]=='admin')
            $sql="select * from course where exam='yes' and offered='yes' and (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
        else
            $sql="select course.courseid, course.area, course.code, course.coursename, course.ugpg, tracking.adminid from course left JOIN tracking on course.courseid=tracking.courseid
                  where exam='yes' and offered='yes' and adminid=".$_SESSION["userid"]." and (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
    }
    else if (isset($_GET['area'])){
        if($_SESSION["role"]=='admin')
            $sql="select * from course where exam='yes' and offered='yes' and area='".$_GET['area']."';";
        else
            $sql="select course.courseid, course.area, course.code, course.coursename, course.ugpg, tracking.adminid from course left JOIN tracking on course.courseid=tracking.courseid
                  where exam='yes' and offered='yes' and adminid=".$_SESSION["userid"]." and area='".$_GET['area']."';";
    }
    else{
        if($_SESSION["role"]=='admin')
            $sql="select * from course where exam='yes' AND offered='yes';";
        else
            $sql="select course.courseid, course.area, course.code, course.coursename, course.ugpg, tracking.adminid from course left JOIN tracking on course.courseid=tracking.courseid
                  where exam='yes' and offered='yes' and adminid=".$_SESSION["userid"]." ;";
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

    <title>Paper Reviewing</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>

<body>
<?php include'topnav.php'?>

<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Paper Reviewing</h1>
            <p style="background-color:white">You may download the following three PDF forms for examination administration matters by just one click:<br>1. Tracking Form<br>2. Process Flow Record-Examination
                <br>3. Checklist for Setting Review<br>Meanwhile you can also update the status of the reviewing progress (that you are in charge of) on this page.</p>

            <form class="form-inline" action="form_generation.php">
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search course by course" name="search">
                <button type="submit" class="btn btn-success mb-2">Search</button>
            </form>
        </div>
    </div>

    <div class="tablenotification">
        <form action="trackingform.php" method="post">
            <?php
            if ($_SESSION["role"]=='admin')
                echo "<div align=\"right\">
                <button type=\"submit\" class=\"btn btn-success mb-2\">Download Selected Forms</button>
            </div>";
            ?>
            <!-- Example row of columns -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="btn-group dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="form_generation.php?area=ECAL">ECAL</a>
                                    <a class="dropdown-item" href="form_generation.php?area=ENIC">ENIC</a>
                                    <a class="dropdown-item" href="form_generation.php?area=INON">INON</a>
                                    <a class="dropdown-item" href="form_generation.php?area=HRH">HRH</a>
                                    <a class="dropdown-item" href="form_generation.php?area=Others">Others</a>
                                </div>
                            </div>
                        </th>

                        <th scope="col" style="width:45%">Course</th>
                        <th scope="col">Admin Assistant</th>

                        <th scope="col">
                            <div class="btn-group dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="form_generation.php?status=1">Drafting</a>
                                    <a class="dropdown-item" href="form_generation.php?status=2">Area Lead Reviewing</a>
                                    <a class="dropdown-item" href="form_generation.php?status=3">Acad Review (OAS)</a>
                                    <a class="dropdown-item" href="form_generation.php?status=4">Acad Review (non OAS)</a>
                                    <a class="dropdown-item" href="form_generation.php?status=5">Chair Reviewing</a>
                                </div>
                            </div>
                        </th>
                        <th scope="col">Update Admin</th>

                        <?php
                        if ($_SESSION["role"]=='admin')
                            echo "<th scope=\"col\">
                            <div class=\"form-check\">
                                <input class=\"form-check-input position-static\" type=\"checkbox\" onClick=\"toggle(this)\" id=\"blankCheckbox\">
                            </div>
                        </th>";
                        ?>
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
                        <td>{$row['area']}</td>
                        <td>{$row['code']}-{$row['coursename']}</td>
                        <td>{$rowadmin['lastname']} {$rowadmin['firstname']}</td>
_END;

                            echo"<td><div class='form-group'><select class='form-control' id=\"updatestatus-{$row['courseid']}\">";
                            if ($rowstatus['statusid']==1){
                                echo "<option selected=\"selected\">Drafting</option>";
                                echo "<option>Area Lead Reviewing</option>";
                                echo "<option>Acad Review (OAS)</option>";
                                echo "<option>Acad Review (non OAS)</option>";
                                echo "<option>Chair Reviewing</option>";
                            }
                            else if ($rowstatus['statusid']==2){
                                echo "<option>Drafting</option>";
                                echo "<option selected=\"selected\">Area Lead Reviewing</option>";
                                echo "<option>Acad Review (OAS)</option>";
                                echo "<option>Acad Review (non OAS)</option>";
                                echo "<option>Chair Reviewing</option>";
                            }
                            else if ($rowstatus['statusid']==3){
                                echo "<option>Drafting</option>";
                                echo "<option>Area Lead Reviewing</option>";
                                echo "<option selected=\"selected\">Acad Review (OAS)</option>";
                                echo "<option>Acad Review (non OAS)</option>";
                                echo "<option>Chair Reviewing</option>";
                            }
                            else if ($rowstatus['statusid']==4){
                                echo "<option>Drafting</option>";
                                echo "<option>Area Lead Reviewing</option>";
                                echo "<option>Acad Review (OAS)</option>";
                                echo "<option selected=\"selected\">Acad Review (non OAS)</option>";
                                echo "<option>Chair Reviewing</option>";

                            }
                            else{
                                echo "<option>Drafting</option>";
                                echo "<option>Area Lead Reviewing</option>";
                                echo "<option>Acad Review (OAS)</option>";
                                echo "<option>Acad Review (non OAS)</option>";
                                echo "<option selected=\"selected\">Chair Reviewing</option>";
                            }
                            echo "</select></div></td>";


                            echo <<<_END
                        <td>
                        <button type="button" class="btn btn-sm btn-success" name="updateadminbtn" style="font-size:90%" value="{$row['courseid']}" onclick="updatestatus(this)">Update</button>
                        </td>
_END;
                        if ($_SESSION["role"]=='admin'){
                            echo "<td>
                            <div class=\"form-check\">
                                <input class=\"form-check-input position-static\" type=\"checkbox\" name=\"formgeneration[]\" id=\"blankCheckbox\" value=\"{$row['courseid']}\">
                            </div>
                        </td></tr>";}
                        else echo"</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </form>

        <form action="form_generation.php" id="hidden-form" method="post">
            <input name="updatestatus" type="hidden" id="hidden-form-updatestatus">
            <input name="updateadminbtn" type="hidden" id="hidden-form-updateadminbtn">
        </form>
    </div> <!-- /container -->

</main>

<footer class="container">
    <p>&copy; SHI CHENYU FINAL YEAR PROJECT 2018-2019</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script language="JavaScript">
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function updatestatus(event) {
        console.log("event:");
        console.log(event);
        console.log("function called");
        let course_id = event.value;
        let select = document.getElementById('updatestatus-'+course_id);
        let status = select.options[select.selectedIndex].text;
        // alert("status" + " " + status);
        // alert("course_id" + " " + course_id);
        document.getElementById("hidden-form-updatestatus").value = status;
        document.getElementById("hidden-form-updateadminbtn").value = parseInt(course_id);

        let hidden_form = document.getElementById("hidden-form");
        hidden_form.submit();
    }
</script>

</body>
</html>


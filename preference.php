<?php

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    //Fetch data from database
    $sql="select * from course;";
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

    <title>Teaching Preference Survey</title>

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
            <h1 class="display-4">Teaching Preference Survey</h1>
            <p style="background-color:white">You may submit your top three preferred courses to teach here. <br>
            Courses available are listed below and a click on the course code will show you the OBTL of the course
            for your consideration.<br>You may narrow down your consideration by searching a course code or course 
            in the search box or by specifying your preferred area (ECAL or ENIC or INON or HRH or OTHERS).</p>

            <form class="form-inline" action="preference.php">
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search course" name="search">
                <button type="submit" class="btn btn-success mb-2">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive" style="width: 90%; margin-left: 5%;">
    <div class="tablenotification" >
        <!-- <form action="preference.php" method="post"> -->
            <?php
            // if ($_SESSION["role"]=='admin' or $_SESSION["role"]=='area')
            //     echo "<div align=\"right\">
            //     <button type=\"submit\" class=\"btn btn-success mb-2\">Download Submitted Surveys</button>
            // </div>";
            $codes = array();
            $types = array();
            for ($r = 0; $r < $res->num_rows; ++$r) {
                // Fetch current row into an associative array called $row
                $row = $res->fetch_assoc();
                $code = $row["code"];
                $type = $row["type"];
                array_push($codes, $code);
                array_push($types, $type);
            }
            ?>
            <!-- Example row of columns -->
            <div class="table-responsive">
                <!-- <form class="form-inline" action="preference.php" method="post"> -->
                    <?php
                    if ($_SESSION["role"]=='admin' or $_SESSION["role"]=='area') {
                        echo "<table class='table table-hover'>";
                        echo "<h4>You are logged in as admin. Click the button to download survey result.</h4>";
                        echo "<a href='download_survey.php' class='btn btn-success pull-right' style='float:right;'>Download</a>";
                        echo "</table>";
                    }
                    ?>
                    <table class="table table-hover">
                        <h4>Please Indicate Your Preferences</h4>
                        <?php
                            echo "<input type='hidden' id='valid' value='0' name='valid'";
                        ?>
                        <tr>
                            <td scope="col"><strong>First Choice</strong><select style="margin-left: 20px;" id="first" >
                            <?php
                            $prev = "";
                            foreach($codes as $code) {
                                if ($code != $prev) {
                                    echo '<option'.' value="'.$code.'"'.'>'.$code.'</option>';
                                }
                                $prev = $code;
                            }
                            ?>
                            </select></td>
                            <td scope="col"><strong>Second Choice</strong><select style="margin-left: 20px;" id="second">
                            <?php
                            $prev = "";
                            foreach($codes as $code) {
                                if ($code != $prev) {
                                    echo '<option'.' value="'.$code.'"'.'>'.$code.'</option>';
                                }
                                $prev = $code;
                            }
                            ?>
                            </select></td>
                            <td scope="col"><strong>Third Choice</strong><select style="margin-left: 20px;" id="third">
                            <?php
                            $prev = "";
                            foreach($codes as $code) {
                                if ($code != $prev) {
                                    echo '<option'.' value="'.$code.'"'.'>'.$code.'</option>';
                                }
                                $prev = $code;
                            }
                            ?>
                            </select></td>
                            <td>
                        
                            <button type="submit" class="btn btn-success mb-2" name="preference" onclick=preference()>Submit</button>
                            <script type = "text/javascript" src = "validator.js"></script>
                            <?php
                                $staffid = $_SESSION["staffid"];
                                if ($_GET['valid'] == true) {
                                    $query = "select * from preference where staffid = ".$staffid."";
                                    $result = mysqli_query($link, $query);
                                    $first = $_GET['first'];
                                    $second = $_GET['second'];
                                    $third = $_GET['third'];
                                    if ($result->num_rows > 0) {        
                                        $query2 = "update preference set first = \"".$first."\", second = \"".$second."\", third = \"".$third."\" where staffid = ".$staffid."";
                                        $result2 = mysqli_query($link, $query2);
                                        $result2->free_result();
                                    }
                                    else {
                                        $query2 = "insert into preference (staffid, first, second, third) 
                                        values (\"".$staffid."\",\"".$first."\",\"".$second."\",\"".$third."\")";
                                        $result2 = mysqli_query($link, $query2);
                                        $result2->free_result();
                                    }
                                    $result->free_result();
                                }
                            ?>
                            </td>
                        </tr>
                    </table>
            </div>
            <br><br>
            <div class="table-responsive">
                <table class="table table-hover">
                    <h4>Courses Available</h4>
                    <thead>
                    <tr>
                        <th>
                            <div class="btn-group dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="preference.php?">ALL</a>
                                    <a class="dropdown-item" href="preference.php?area=ECAL">ECAL</a>
                                    <a class="dropdown-item" href="preference.php?area=ENIC">ENIC</a>
                                    <a class="dropdown-item" href="preference.php?area=INON">INON</a>
                                    <a class="dropdown-item" href="preference.php?area=HRH">HRH</a>
                                    <a class="dropdown-item" href="preference.php?area=Others">Others</a>
                                </div>
                            </div>
                        </th>

                        <th scope="col">Course Code</th>
                        <th scope="col" style="width:35%;">Course</th>
                        <th scope="col">Exam</th>
                        <th scope="col">AU</th>
                        <th scope="col">TEL</th>
                        <th scope="col">Hours</th>
                        <th scope="col">Preferences</th>

                    </tr>
                    </thead>

                    <tbody>
                    <input type='hidden' id='firstchoice' name='firstchoice'>
                    <input type='hidden' id='secondchoice' name='secondchoice'>
                    <input type='hidden' id='thirdchoice' name='thirdchoice'>
                    <?php
                    // The query() returns a buffered resultset, with number of rows in num_rows.
                    if (isset($_GET['search'])){
                        $sql="select * from course where (code like '%".$_GET['search']."%' or coursename like '%".$_GET['search']."%')";
                    }
                    else if (isset($_GET['area'])){
                        $sql="select * from course where area='".$_GET['area']."';";
                    }
                    else{
                        $sql="select * from course;";
                    }
                    $res=mysqli_query($link,$sql);
                    for ($r = 0; $r < $res->num_rows; ++$r) {
                        // Fetch current row into an associative array called $row
                        $row = $res->fetch_assoc();
                        echo "<tr><td>{$row['area']}</td>";
                        echo "<td><a href='OBTL/{$row['code']}_test.pdf' target='_blank'>{$row['code']}</a></td>";
                        echo "<td>{$row['coursename']}</td>";
                        echo "<td>{$row['exam']}</td>";
                        echo "<td>{$row['au']}</td>";
                        echo "<td>{$row['tel']}</td>";
                        echo "<td>{$row['hoursperstaff']}</td>";
                        // echo "<td><select id='coursePref' onchange='select({$row['code']});'>
                        echo "<td><select id='coursePref' onchange='select(this.value)'>
                        <option value='{$row['code']}-not'>Please Choose</option>
                        <option value='{$row['code']}-first'>First Choice</option>
                        <option value='{$row['code']}-second'>Second Choice</option>
                        <option value='{$row['code']}-third'>Third Choice</option>
                        </select></td>";
                        echo "<script>
                        var firstEle = document.getElementById('first');
                        var secondEle = document.getElementById('second');
                        var thirdEle = document.getElementById('third');
                        function select(val){   
                            var code = val.split('-')[0];
                            var choice = val.split('-')[1];
                            if (choice == 'first') firstEle.value = code;
                            else if (choice == 'second') secondEle.value = code;
                            else if (choice == 'third') thirdEle.value = code;
                        }
                        </script>";
                    }
//                     $res->free_result();
                    ?>
                    </tbody>
                    
                </table>
                <!-- <button type="submit" class="btn btn-success mb-2" name="preference" onclick=preference()>Submit</button> -->
                
            </div>
        <!-- </form> -->
        

        <!-- <form action="preference.php" id="hidden-form" method="post">
            <input name="updatestatus" type="hidden" id="hidden-form-updatestatus">
            <input name="updateadminbtn" type="hidden" id="hidden-form-updateadminbtn">
        </form> -->
    </div> <!-- /container -->

</main>

<?php include 'footer.php' ?>

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
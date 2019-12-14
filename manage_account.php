<?php

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] === true){
    echo "<script> location.href='login.php'; </script>";
    exit;
}

else{
    require_once ("config.php");
    if (isset($_GET['changepassword'])){
        $sqlmodal="update login set password= md5(".$_GET['changepasswordinput'].") where userid=".$_GET['changepassword'].";";
        $resmodal=mysqli_query($link,$sqlmodal);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manage My Account</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>

<body>
<?php include 'topnav.php'?>

<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Manage My Account</h1>
            <p style="background-color:white">You may change the account password below. If you need to change your information, please contact EEE office.</p>
        </div>
    </div>

    <div class="tablenotification">

            <!-- Example row of columns -->
            <div class="table-responsive">
                <table class="table table-hover" style="margin-left: 5%; width: 90%;">
                    <thead>
                    <tr>
                        <th scope="col" width=20%>Name</th>
                        <th scope="col" width=20%>Email</th>
                        <th scope="col" width=20%>Area</th>
                        <th scope="col" width=20%>Appointment</th>                        
                        </tr>

                    </thead>

                    <tbody>
                    <?php
                    if (isset($_SESSION["staffid"])) {
                        $staff = $_SESSION["staffid"];
                        $sql = "select * from staff where staffid=".$staff."";
                        $result=mysqli_query($link,$sql);
                        $row = $result -> fetch_assoc();
                        echo <<<_END
                            <tr><td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['area']}</td>
                            <td>{$row['appointment']}</td>
_END;
                        $result -> free_result();
                        // $sql2 = "select * from login where staffid=".$staff."";
                        // $result2=mysqli_query($link, $sql2);
                        // $row = $result2->fetch_assoc();
                    }
                    ?>
                    <?php
                        echo <<<_END
                        <td><a class="btn-outline-dark btn btn-sm" data-toggle="modal" data-target="#changepassword{$_SESSION['loggedin']}">Change Password</a>
                        <!-- Modal Delete Role-->
                                <div id="changepassword{$_SESSION['loggedin']}" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    
                                    <form action="manage_account.php">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Change User Password</h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Please enter the new password for user <strong>{$row['name']}</strong>?</p>
                                      <input type="text" class="form-control mb-2 mr-sm-2" id="changepasswordinput" placeholder="new password" name="changepasswordinput">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" name="changepassword" id="changepassword" value="{$_SESSION['loggedin']}">Confirm Change Password</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </form>
                                      
                                    </div>
                                  </div>
                                </div>
                        </td>
                        </tr>
_END;
                    ?>
                        
                    </tbody>
                </table>
            </div>

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
</script>

</body>
</html>

<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("someone@example.com","My subject",$msg);
?>

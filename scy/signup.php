<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 20/12/18
 * Time: 20:32
 */

if(!isset($_SESSION)) session_start();
$register_firstname=$register_lastname=$register_email = $register_password = $register_confirm_password = "";
$register_name_err=$register_email_err = $register_password_err = $register_confirm_password_err = "";


if(isset($_POST['signup'])) {
    require_once ("config.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            $register_firstname = $_POST['firstname'];
            $register_lastname = $_POST['lastname'];
            $register_email = $_POST['email'];
            $register_password = $_POST['password'];
            $register_confirm_password = $_POST['confirm_password'];

            $sql = "SELECT * FROM login WHERE email = '" . $register_email . "'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0)
                $register_email_err = "This email has been registered.";
            else{
                // Validate password
                if (empty($register_password)) {
                    $register_password_err = "Please enter a password.";
                } elseif (strlen($_POST["password"]) < 6) {
                    $register_password_err = "Password must have at least 6 characters.";
                } else{
                    // Validate confirm password
                    if (empty($register_confirm_password)) {
                        $register_confirm_password_err = "Please confirm password.";
                    } else {
                        if (empty($register_password_err) && ($register_password != $register_confirm_password)) {
                            $register_confirm_password_err = "Password does not match.";
                        }
                        else{
                            // Check input errors before inserting in database
                            if (empty($register_name_err) && empty($register_email_err) && empty($register_password_err) && empty($register_confirm_password_err)) {
                                $sql = "INSERT INTO login (firstname, lastname, email, password) VALUES ('" . $register_firstname . "','" . $register_lastname . "','" . $register_email . "', '" . $register_password . "')";
                                if ($link->query($sql) === TRUE) {
                                }
                                else {
                                    echo "Error: " . $sql . "<br>" . $link->error;
                                }
                                echo "<script> location.href='login.php';</script>";
                            }
                        }
                    }
                }
            }

    }
    $link->close();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGN UP HERE</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="login.php">SmartOffice</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        </ul>

        <li class="nav-item dropdown">
            <button type="button" class="btn btn-outline-success dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LOGIN</button>
            <div class="dropdown-menu dropdown-menu-right">
                <form class="px-4 py-3" action="login.php" method="post">
                    <div class="form-group">
                        <label for="exampleDropdownFormEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email@ntu.edu.sg">
                    </div>
                    <div class="form-group">
                        <label for="exampleDropdownFormPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-outline-success">LOG IN</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div>
        </li>
    </div>

</nav>

<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Sign Up Here!</h1>
            <p>Welcome to our SmartOffice website, please kindly fill in the form below.</p>
        </div>
    </div>

    <div class="signupfield">
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First Name*</label>
                        <input type="text" class="form-control" id="firstName" name="firstname" placeholder="" value="<?php echo $register_firstname?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last Name*</label>
                        <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value="<?php echo $register_lastname?>" required >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">NTU Email Address*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="account@(e.)ntu.edu.sg" value="<?php echo $register_email?>" required>
                    <div>
                        <?php
                        if($register_email_err!=="") echo $register_email_err;
                        $register_email_err="";
                        ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="more than 6 characters" value="<?php echo $register_password?>" required>
                    <div>
                        <?php
                        if($register_password_err!=="") echo $register_password_err;
                        $register_password_err="";
                        ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="confirmpassword">Confirm Password*</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirm_password" placeholder="" value="<?php echo $register_confirm_password?>" required>
                    <div>
                        <?php
                        if($register_confirm_password_err!=="") echo $register_confirm_password_err;
                        $register_confirm_password_err="";
                        ?>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-warning btn-lg btn-block" type="submit" name="signup">SIGN UP</button>
            </form>
        </div>
    </div>

    </div>

</main>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>

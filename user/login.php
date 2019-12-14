<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 22/12/18
 * Time: 21:36
 */

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script> location.href='index.php'; </script>";
    exit;
}

if(!isset($_SESSION)) session_start();
$login_email= $login_password = "";
$login_email_err = $login_password_err = "";

if(isset($_POST['login'])) {
    require_once ("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo "<script> location.href='index.php'; </script>";
            exit;
        }
        else {
            $login_email = $_POST['email'];
            $login_password = $_POST['password'];
            // Validate email
            if (empty($login_email)) {
                $login_email_err = "Please enter an email.";
            } else {
                // Prepare a select statement
                $sql = "SELECT * FROM login WHERE email = '" . $login_email . "'";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) == 0)
                    $login_email_err = "The user doesn't exist.";
                else{
                    // Validate password
                    if (empty($login_password)) {
                        $login_password_err = "Please enter a password.";
                    } elseif (strlen($_POST["password"]) < 6) {
                        $login_password_err = "Password must have at least 6 characters.";
                    } else{
                        $sql = "SELECT password FROM login WHERE email = '" . $login_email . "'";
                        $result = mysqli_query($link, $sql) -> fetch_assoc()['password'];
                        if($result !== $login_password)
                            $login_password_err = "The password is wrong.";
                        else{
                            $sql = "SELECT role FROM login WHERE email = '" . $login_email . "'";
                            $role = mysqli_query($link, $sql) -> fetch_assoc()['role'];
                            if($role =='pending'){
                                // echo "<script> location.href='signup_pending.php'; </script>";
                                exit;
                            }else{
                                // Check input errors before inserting in database
                                if (empty($login_email_err) && empty($login_password_err)) {

                                    if (!isset($_SESSION)) session_start();
                                    $sql = "SELECT * FROM login WHERE email = '" . $login_email . "'";
                                    $row = mysqli_query($link, $sql)->fetch_assoc();
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["userid"] = $row['userid'];
                                    $_SESSION["username"] = $row['firstname'];
                                    $_SESSION["role"] = $row['role'];
                                    $_SESSION["staffid"] = $row['staffid'];
                                    echo "<script> location.href='index.php'; </script>";
                                }
                            }
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

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <img class="mb-4" src="assets/brand/NTULOGO.png" alt="" width="270" height="100">
    <h1 class="h3 mb-3 font-weight-normal">EEE Smart Office</h1>
    <h1 class="h3 mb-3 font-weight-normal">Please login</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email Address" value="<?php echo $login_email?>" required autofocus>
    <?php
    if($login_email_err!=="") echo $login_email_err;
    $login_email_err="";
    ?>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo $login_password?>" required>
    <?php
    if($login_password_err!=="") echo $login_password_err;
    $login_password_err="";
    ?>
    <button class="btn btn-lg btn-block btn-success" name="login" type="submit">Login</button>
    <!-- <a href="signup.php" class="btn btn-lg btn-block btn-warning">Sign Up</a> -->
    <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
</form>

</body>
</html>

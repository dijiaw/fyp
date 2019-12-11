<?php
/**
 * Created by PhpStorm.
 * User: pomegranate
 * Date: 22/12/18
 * Time: 23:17
 */

if(!isset($_SESSION)) session_start();

function logout(){
    if(!isset($_SESSION)) session_start();
    $_SESSION = array();
    session_destroy();
    echo "<script> location.href='login.php'; </script>";
}

if (isset($_GET['logout'])) logout();
?>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand mr-5" href="home.php">SmartOffice</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-4">
                <a class="nav-link" href="appointment.php">Exam Appointment</a></li>
            <li class="nav-item">
                <a class="nav-link" href="form_generation.php">Paper Reviewing</a></li>
        </ul>

        <li class="nav-item dropdown">
            <button type="button" class="btn btn-outline-success dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi! <?php echo $_SESSION['username'] ?></button>
            <div class="dropdown-menu dropdown-menu-right">
                <?php
                if ($_SESSION["role"]=='admin')
                    echo "<a class=\"dropdown-item\" href=\"dashboard.php\">Dashboard</a>";
                ?>
                <a class="dropdown-item" href="home.php?logout=true'">Log Out</a>
                <div class="dropdown-divider"></div>
                <?php
                if ($_SESSION["role"]=='admin')
                    echo "<a class=\"dropdown-item disabled\">You are an ADMIN user!</a>";
                else echo "<a class=\"dropdown-item disabled\">You are a NORMAL user, <br>hence you have no access<br> to the Admin Dashboard, <br>please contact <strong>Ms. Ng Shiu</strong> <br> <strong>Fern</strong> for any issues.</a>";
                ?>
            </div>
        </li>

    </div>
</nav>

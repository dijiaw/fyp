<?php
// define('DB_SERVER', '127.0.0.1');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'FYP');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'f36ee');
define('DB_PASSWORD', 'f36ee');
define('DB_NAME', 'f36ee');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
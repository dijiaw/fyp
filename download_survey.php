<?php
//include database configuration file
include 'config.php';


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=survey.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output column headings
$fields = array('preference_id', 'staff_id', 'staff_name', 'staff_email', 'first_choice', 'second_choice', 'third_choice');
fputcsv($output, $fields);

//get records from database
$query = mysqli_query($link,"SELECT * FROM preference");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $sql = "SELECT * FROM staff where staffid=".$row['staffid']."";
        $query2 = mysqli_query($link, $sql);
        $row2 = $query2->fetch_assoc();
        $lineData = array($row['preferenceid'], $row['staffid'], $row2['name'], $row2['email'], $row['first'], $row['second'], $row['third']);
        fputcsv($output, $lineData);
    }
    fclose($output);
}
exit;

?>
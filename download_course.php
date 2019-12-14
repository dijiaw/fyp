<?php
//include database configuration file
include 'config.php';


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=courses.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output column headings
$fields = array('course_id', 'area', 'code', 'coursename', 'exam', 'offered(Y/N)', 'undergraduate/postgraduate', 'type', 'school', 'au', 'tel(Y/N)', 'year', 'hours_per_staff', 'number_of_groups', 'number_of_weeks', 'hours_per_week');
fputcsv($output, $fields);

//get records from database
$query = mysqli_query($link,"SELECT * FROM course");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        fputcsv($output, $row);
    }
    
    fclose($output);
}
exit;

?>
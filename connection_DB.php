<?php
global $db_host,$db_username,$db_password,$Database,$connection;
$db_host = 'localhost' ;
$db_username ='root';
$db_password ='';
$Database = 'eid_activities';

$connection = mysqli_connect($db_host, $db_username, $db_password, $Database);  

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $Database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
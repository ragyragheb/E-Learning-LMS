<?php
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "lms";
$dbname = "ELearning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    echo 'database connection error';
}
?>
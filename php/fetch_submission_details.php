<?php
require 'database_connection.php';
if(isset($_POST['id'])){
$id = $_POST["id"];
$sql="SELECT * FROM student_submission where id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$row = mysqli_fetch_object($result);
echo json_encode($row);}

if(isset($_POST['grade'])){
    $submission_id=$_POST['submission_id'];
    $grade = $_POST['grade'];

$sql="UPDATE student_submission SET grade = $grade where id = $submission_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
}
?>
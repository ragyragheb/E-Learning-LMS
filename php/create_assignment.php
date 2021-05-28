<?php
require 'database_connection.php';
if(isset($_POST['add'])){
    $aName = $_POST['assignment_name'];
    $aDesc = $_POST['assignment_desc'];
    $aDeadline = $_POST['assignment_deadline'];

    try{
        $sql="INSERT into assignment(name, description, deadline) VALUES('$aName','$aDesc','$aDeadline')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "Assignment Added";
    }
    catch(Exception $e){
        echo "Can't add assignment";
    }
}


?>
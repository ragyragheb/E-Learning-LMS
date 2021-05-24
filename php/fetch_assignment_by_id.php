<?php

require 'database_connection.php';
    
if(isset($_POST['assignment_id'])){
    $id = $_POST['assignment_id'];

    try{

    $sql="SELECT * FROM assignment WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    $results = $result->fetch_all(MYSQLI_ASSOC)[0]; // FETCH ALL DATA AS AN ARRAY.
    
    
    echo json_encode($results); //TURNS ARRAY TO JSON STRING.
    }
    catch(Exception $e){
        echo json_encode(array("error"=>"An error has occured"));
    }
}
?>
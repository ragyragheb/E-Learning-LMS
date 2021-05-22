<?php 

require 'database_connection.php';

if(isset($_POST['fetch_submissions'])){
    $sql="SELECT student_name FROM submission";
   $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

   echo ' <ul>';
    while($row = $result ->fetch_assoc()){
                
           echo' <li>'.$row['student_name'].'</li>';
        
    }
    echo '</ul>';



}



?>
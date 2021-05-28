<?php
require 'database_connection.php';


/*STEPS
    1- make an empty array, call it new assignments, 
    get all assignments as an associative array from the db
    2- loop through each assignment
        3- get an associative array of submissions from the db for the specified assignment.
        4- loop through each submission and change the directory to an accessible directory(to be able to open it in browser).
        5- make a new key in the assignment , call it (submissions), pait the list of the submissions to that key.
        6- push the new assignment (with the new key) to the empty array of modified assignments.
    7- send all the assignments as a JSON object to the client.
*/

try{
    $sql = "SELECT * FROM assignment";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $assignments = $result->fetch_all(MYSQLI_ASSOC);
    $new_assignments = array();
    foreach ($assignments as $assignment){
        try{
            $id = $assignment['id'];
            $sql="SELECT id, student_name, assignment_dir FROM student_submission WHERE assignment_id='$id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            $submissions = $result->fetch_all(MYSQLI_ASSOC);

            for($i=0; $i<count($submissions); $i++){

                               
                $submissions[$i]['assignment_dir'] = 'http://localhost/E-Learning-LMS/php/'.$submissions[$i]['assignment_dir'];
               
            }
            $assignment['submissions'] = $submissions;
            array_push($new_assignments,$assignment);

        }catch (Exception $e){
            echo json_encode(array("error" => "error fetching submissions"));
        }
    }
    echo json_encode(array("assignments" => $new_assignments));
}catch(Exception $e){
    echo json_encode(array("error" => "error fetching assignments"));
}

?>
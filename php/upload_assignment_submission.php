<?php

require 'database_connection.php';

//This file is used to fetch submissions on assignments (alternative)

if (isset($_POST['submit']))
{
    $student_name = $_POST['student_name'];
    $assignment_id = $_POST['assignment_id'];
    date_default_timezone_set('Africa/Cairo');
    $date = date('d/m/y, h:i:s');

    if ($_FILES['assignment_file']['error'] != 0) //if ther is no error recieving the file.
    {
        echo 'Something wrong with the file.';
    }
    else
    {   
        $file_name = $_FILES['assignment_file']['name'];
        $file_tmp = $_FILES['assignment_file']['tmp_name'];

        $location = "upload/".$file_name; //SETTING FILE LOCATION ON THE SERVER.
        if ( move_uploaded_file($file_tmp, $location) ) { 
            
            try{
            $sql = "INSERT INTO student_submission(student_name, assignment_dir, assignment_id, grade, submission_time) VALUES ('$student_name', '$location', '$assignment_id', '0', '$date')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            echo 'Success'; 
            }catch(Exception $e){
                echo 'Failure';
            }

          } else { 
            echo 'Failure'; 
          }
            
        }
        
    }

?>

<?php

require 'database_connection.php';

//to be implemented when the final HTML and ajax are ready
// $sql ="SELECT name, description, deadline FROM assignment where id = '1'";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result ->fetch_assoc();
// echo '<div id="deadline">'.$row['deadline'].'</div>';
// $.ajax({url: "test.php"}).done(function( html ) {
//     $("#results").append(html);
// });

if (isset($_POST['submit']))
{
    $student_name = $_POST['student_name'];
    $assignment_id = $_POST['assignment_id'];

    if ($_FILES['assignment_file']['error'] != 0) //if ther is no error recieving the file.
    {
        echo 'Something wrong with the file.';
    }
    else
    {   //pdf file uploaded okay.
        //attached pdf file information
        $file_name = $_FILES['assignment_file']['name'];
        $file_tmp = $_FILES['assignment_file']['tmp_name'];

        $location = "upload/".$file_name; //SETTING FILE LOCATION ON THE SERVER.
        if ( move_uploaded_file($file_tmp, $location) ) { 
            
            try{
            $sql = "INSERT INTO student_submission(student_name, assignment_dir, assignment_id) VALUES ('$student_name', '$location', '$assignment_id')";
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

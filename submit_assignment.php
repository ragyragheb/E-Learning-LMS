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
    $studentName = $_POST['name'];

    if ($_FILES['assignment_file']['error'] != 0)
    {
        echo 'Something wrong with the file.';
    }
    else
    { //pdf file uploaded okay.
        //attached pdf file information
        $file_name = $_FILES['assignment_file']['name'];
        $file_tmp = $_FILES['assignment_file']['tmp_name'];

        if ($pdf_blob = fopen($file_tmp, "rb"))
        {

                $sql = "INSERT INTO submission(file, grade, student_name) VALUES ('$pdf_blob', '-1', '$studentName')";
                if ($conn->query($sql) === true)
                {
                    echo "New record created successfully";
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            

        }
        else
        {
            //fopen() was not successful in opening the .pdf file for reading.
            echo 'Could not open the attached pdf file';
        }

    }
}

?>

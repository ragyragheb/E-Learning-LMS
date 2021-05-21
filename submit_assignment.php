<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    echo 'database connection error';
}

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
            //  $fileContents= file_get_contents($_FILES['assignment_file']['tmp_name']);

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

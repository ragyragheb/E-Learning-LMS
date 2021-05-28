<?php 

require 'database_connection.php';

$sql="SELECT * FROM assignment";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$assignments = array();
while ($row = mysqli_fetch_object($result))
{
    $assignments[]=$row;
}
 
echo json_encode($assignments);


?>
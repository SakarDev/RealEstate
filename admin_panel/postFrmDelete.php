<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$property_id = $_POST['id'];

$sql = "DELETE FROM property WHERE property_id = $property_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}



echo json_encode($data);

?>

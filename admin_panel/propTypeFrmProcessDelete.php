<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$property_type_id = $_POST['id'];

$sql = "DELETE FROM property_type WHERE property_type_id = $property_type_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}



echo json_encode($data);

?>

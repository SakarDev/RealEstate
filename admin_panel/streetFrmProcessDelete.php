<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$street_id = $_POST['id'];

$sql = "DELETE FROM street WHERE street_id = $street_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}


echo json_encode($data);

?>

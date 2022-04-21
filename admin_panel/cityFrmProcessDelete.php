<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$city_id = $_POST['id'];

$sql = "DELETE FROM city WHERE city_id = $city_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}


echo json_encode($data);

?>

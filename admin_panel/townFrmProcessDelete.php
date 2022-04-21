<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$town_id = $_POST['id'];

$sql = "DELETE FROM town WHERE town_id = $town_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}


echo json_encode($data);

?>

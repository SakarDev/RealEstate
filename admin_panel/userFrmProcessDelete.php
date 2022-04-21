<?php 

require_once('includes/conn.php');
session_start();

$data = [];

$user_id = $_POST['id'];

$sql = "DELETE FROM user WHERE user_id = $user_id ";
$query = $conn->query($sql);

if($query){
    $data["success"] = true;
}else{
    $data["success"] = false;
}

echo json_encode($data);

?>

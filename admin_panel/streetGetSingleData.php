<?php 
require_once("includes/conn.php");
$id = $_POST['id'];
$sql = "SELECT * FROM street WHERE street_id = $id LIMIT 1";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
//response
echo json_encode($row);
?>

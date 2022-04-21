<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];
//record id
$edited_city = $_POST['edited_city'];
$city_id = $_POST['city_id'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // city
   if (!isset($_POST['edited_city']) || empty($_POST["edited_city"])) {
      $errors['edited_city'] = "City is required";
   } else {
      $edited_city = test_input($_POST["edited_city"]);
      // check if edited_city only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $edited_city)) {
          $errors['edited_city'] = "Only letters and white space allowed";
      }
   }
}


function test_input($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $GLOBALS['conn']->real_escape_string($data);
   return $data;
}

if(empty($errors)){
    //  LAST CHECK to see if edited city already exists in the database or not
    $stmt_check = $conn->prepare("SELECT * FROM city WHERE city_name =?");
    $stmt_check->bind_param("s", $edited_city);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if($result->num_rows > 0){
       $errors['edited_city'] = "City already exist!";
    }
    $stmt_check->close();
 }


if (!empty($errors)) {
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
   $data["success"] = true;
   $data["message"] = "Success!";

   // -------------Updating data in the database-------------
   // prepare and bind
   $stmt = $conn->prepare("UPDATE city SET city_name = ? WHERE city_id = ?");
   $stmt->bind_param("si", $edited_city, $city_id);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}


// backend response
echo json_encode($data);
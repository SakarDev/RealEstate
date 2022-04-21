<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // city
    if (!isset($_POST['new_city']) || empty($_POST["new_city"])) {
       $errors['new_city'] = "City is required";
    } else {
       $new_city = test_input($_POST["new_city"]);
       // check if new_city only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $new_city)) {
           $errors['new_city'] = "Only letters and white space allowed";
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
   //  LAST CHECK to see if city already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM city WHERE city_name =?");
   $stmt_check->bind_param("s", $new_city);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['new_city'] = "City already exist!";
   }
   $stmt_check->close();
}


if (!empty($errors)) {
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
   $data["success"] = true;
   $data["message"] = "Success!";

   // -------------Inserting data to the database-------------
   // prepare and bind
   $stmt = $conn->prepare("INSERT INTO city (city_name) VALUES (?)");
   $stmt->bind_param("s", $new_city);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}



// backend response
echo json_encode($data);
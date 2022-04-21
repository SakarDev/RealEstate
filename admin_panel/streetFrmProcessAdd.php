<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // street
    if (!isset($_POST['new_street']) || empty($_POST["new_street"])) {
       $errors['new_street'] = "Street is required";
    } else {
       $new_street = test_input($_POST["new_street"]);
       // check if new_street only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $new_street)) {
           $errors['new_street'] = "Only letters and white space allowed";
       }
    }

   // city
   if (!isset($_POST['cityRelated']) || empty($_POST["cityRelated"])) {
      $errors['cityRelated'] = "City is required";
   } else {
      $cityRelated = test_input($_POST["cityRelated"]);
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
   //  LAST CHECK to see if street already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM street WHERE street_name =?");
   $stmt_check->bind_param("s", $new_street);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['new_street'] = "street already exist!";
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
   $stmt = $conn->prepare("INSERT INTO street (street_name, city_id_streetfk) VALUES (?, ?)");
   $stmt->bind_param("si", $new_street, $cityRelated);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}



// backend response
echo json_encode($data);
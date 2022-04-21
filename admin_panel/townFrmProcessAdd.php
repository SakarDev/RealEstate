<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // town
    if (!isset($_POST['new_town']) || empty($_POST["new_town"])) {
       $errors['new_town'] = "town is required";
    } else {
       $new_town = test_input($_POST["new_town"]);
       // check if new_town only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $new_town)) {
           $errors['new_town'] = "Only letters and white space allowed";
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
   //  LAST CHECK to see if town already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM town WHERE town_name =?");
   $stmt_check->bind_param("s", $new_town);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['new_town'] = "Town already exist!";
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
   $stmt = $conn->prepare("INSERT INTO town (town_name, city_id_townfk) VALUES (?, ?)");
   $stmt->bind_param("si", $new_town, $cityRelated);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}



// backend response
echo json_encode($data);
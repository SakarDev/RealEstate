<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // property type
    if (!isset($_POST['new_property_type']) || empty($_POST["new_property_type"])) {
       $errors['new_property_type'] = "Property type is required";
    } else {
       $new_property_type = test_input($_POST["new_property_type"]);
       // check if new_property_type only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $new_property_type)) {
           $errors['new_property_type'] = "Only letters and white space allowed";
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
   //  LAST CHECK to see if property type already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM property_type WHERE property_type_name =?");
   $stmt_check->bind_param("s", $new_property_type);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['new_property_type'] = "Property type already exist!";
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
   $stmt = $conn->prepare("INSERT INTO property_type (property_type_name) VALUES (?)");
   $stmt->bind_param("s", $new_property_type);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}



// backend response
echo json_encode($data);
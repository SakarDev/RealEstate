<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];
//record id
$edited_property_type = $_POST['edited_property_type'];
$property_type_id = $_POST['property_type_id'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // property type
   if (!isset($_POST['edited_property_type']) || empty($_POST["edited_property_type"])) {
      $errors['edited_property_type'] = "Property type is required";
   } else {
      $edited_property_type = test_input($_POST["edited_property_type"]);
      // check if edited_property_type only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $edited_property_type)) {
          $errors['edited_property_type'] = "Only letters and white space allowed";
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
   //  LAST CHECK to see if edited property type already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM property_type WHERE property_type_name =?");
   $stmt_check->bind_param("s", $edited_property_type);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['edited_property_type'] = "Property type already exist!";
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
   $stmt = $conn->prepare("UPDATE property_type SET property_type_name = ? WHERE property_type_id = ?");
   $stmt->bind_param("si", $edited_property_type, $property_type_id);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}


// backend response
echo json_encode($data);
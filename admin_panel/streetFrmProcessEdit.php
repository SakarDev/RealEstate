<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];
//record id
$edited_street = $_POST['edited_street'];
$street_id = $_POST['street_id'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // street
   if (!isset($_POST['edited_street']) || empty($_POST["edited_street"])) {
      $errors['edited_street'] = "Street is required";
   } else {
      $edited_street = test_input($_POST["edited_street"]);
      // check if edited_street only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $edited_street)) {
          $errors['edited_street'] = "Only letters and white space allowed";
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
    //  LAST CHECK to see if edited street already exists in the database or not
    $stmt_check = $conn->prepare("SELECT * FROM street WHERE street_name =?");
    $stmt_check->bind_param("s", $edited_street);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if($result->num_rows > 0){
       $errors['edited_street'] = "street already exist!";
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
   $stmt = $conn->prepare("UPDATE street SET street_name = ? WHERE street_id = ?");
   $stmt->bind_param("si", $edited_street, $street_id);
   $stmt->execute();

   //retreive back the city name to the table 
   $sql = "SELECT * FROM street JOIN city ON street.city_id_streetfk=city.city_id ";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $data['cityName']=$row['city_name'];

   $stmt->close();
   $conn->close();
}


// backend response
echo json_encode($data);
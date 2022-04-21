<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];
//record id
$edited_town = $_POST['edited_town'];
$town_id = $_POST['town_id'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // town
   if (!isset($_POST['edited_town']) || empty($_POST["edited_town"])) {
      $errors['edited_town'] = "Town is required";
   } else {
      $edited_town = test_input($_POST["edited_town"]);
      // check if edited_town only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $edited_town)) {
          $errors['edited_town'] = "Only letters and white space allowed";
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
    //  LAST CHECK to see if edited town already exists in the database or not
    $stmt_check = $conn->prepare("SELECT * FROM town WHERE town_name =?");
    $stmt_check->bind_param("s", $edited_town);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    if($result->num_rows > 0){
       $errors['edited_town'] = "Town already exist!";
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
   $stmt = $conn->prepare("UPDATE town SET town_name = ? WHERE town_id = ?");
   $stmt->bind_param("si", $edited_town, $town_id);
   $stmt->execute();

   //retreive back the city name to the table 
   $sql = "SELECT * FROM town JOIN city ON town.city_id_townfk=city.city_id ";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $data['cityName']=$row['city_name'];

   $stmt->close();
   $conn->close();
}


// backend response
echo json_encode($data);
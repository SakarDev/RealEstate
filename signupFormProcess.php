<?php
require_once('includes/conn.php');
session_start();

$errors = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // firstName
    if (!isset($_POST['firstName']) || empty($_POST["firstName"])) {
       $errors['firstName'] = "First name is required";
    } else {
       $firstName = test_input($_POST["firstName"]);
       // check if firstName only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
           $errors['firstName'] = "Only letters and white space allowed";
       }
    }
    
    // lastName 
    if (!isset($_POST['lastName']) || empty($_POST["lastName"])) {
       $errors['lastName'] = "Last name is required";
    } else {
       $lastName = test_input($_POST["lastName"]);
       // check if lastName only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
           $errors['lastName'] = "Only letters and white space allowed";
       }
    }
    
    // email
    if (!isset($_POST['email']) || empty($_POST["email"])) {
       $errors['email'] = "Email is required";
    } else {
       $email = test_input($_POST["email"]);
       // check if e-mail address is well formated
       if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) ) {
           $errors['email'] = "Invalid email format";
       }
      //  in the end again we check if specified email has account or not
    }
    
    // password
    if (!isset($_POST['password']) || empty($_POST["password"])) {
       $errors['password'] = "Password is required";
    } else {
       $password = $_POST["password"];
       $confirmPassword = $_POST["confirmPassword"];
       // check starts/ends with space
       if (str_starts_with($password, ' ') || str_ends_with($password, ' ')) {
           $errors['password'] = "Your password can't start or end with a blank space";
       }
       
       if ($password != $confirmPassword) {
           $errors['password'] = "Those passwords didn't match. Try again.";
       }else{
          // Validate password strength
          $uppercase    = preg_match('@[A-Z]@', $password);
          $lowercase    = preg_match('@[a-z]@', $password);
          $number       = preg_match('@[0-9]@', $password);
          $specialChars = preg_match('@[^\w]@', $password);
          if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
              $errors['password'] = 'Password should be at least 8 characters long, include at least one upper case letter, one lower case letter, one number, and one special character.';
          }
       }
    }

   //   telephone
   if (!isset($_POST['telephone']) || empty($_POST["telephone"])) {
      $errors['telephone'] = "Phone number is required";
   } else {
      $telephone = test_input($_POST["telephone"]);
      // the format /^[0-9]{11}+$/ will check for phone number with 11 digits and only numbers
      if(!preg_match('/^[0-9]{11}+$/', $telephone)) {
         $errors['telephone'] = "Invalid phone number (11 digits are allowed)";
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
   //  LAST CHECK to see if email already exists in the database or not
   $stmt_check = $conn->prepare("SELECT * FROM user WHERE email =?");
   $stmt_check->bind_param("s", $email);
   $stmt_check->execute();
   $result = $stmt_check->get_result();
   if($result->num_rows > 0){
      $errors['email'] = "Email already have an account!";
   }
   $stmt_check->close();
}



if (!empty($errors)) {
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
   $data["success"] = true;
   $data["message"] = "Success!";
   $_SESSION['signupSuccess'] = 1;

   // -------------Inserting data to the database-------------
   $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   // prepare and bind
   $r = 0;
   $stmt = $conn->prepare("INSERT INTO user (firstName, lastName, email, pass, telephone, role) VALUES (?, ?, ?, ?, ?, ?)");
   $stmt->bind_param("sssssi", $firstName, $lastName, $email, $hashed_password, $telephone, $r);
   $stmt->execute();
   // 
   $stmt->close();
   $conn->close();
}



// backend response
echo json_encode($data);
<?php
require_once('includes/conn.php');
session_start();
$errors = [];
$data = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // email
    $isSetEmail = $isSetPassword = false;
    if (!isset($_POST['email']) || empty($_POST["email"])) {
        $errors['email'] = "Email is required";
     } else {
        $isSetEmail = 1;
        $email = test_input($_POST["email"]);
     }
     
     // password
     if (!isset($_POST['password']) || empty($_POST["password"])) {
        $errors['password'] = "Password is required";
     } else {
        $isSetPassword = 1;
        $password = $_POST["password"];
     }

    // remember me
    if(!empty($_POST["remember"])) {
        setcookie ("email", $_POST["email"],time()+ 3600 * 24);
        setcookie ("password", $_POST["password"],time()+ 3600* 24);
    } else {
        setcookie("email","");
        setcookie("password","");
    }

    if($isSetEmail == 1 && $isSetPassword == 1){
        $stmt_check = $conn->prepare( "SELECT * FROM user WHERE email = ?;");
        $stmt_check->bind_param("s", $_POST['email']);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();
        if($row && password_verify($password, $row['pass'])){
            // $_SESSION['user'] = $row;
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['isLoggedIn'] = true;
        }else{
            $errors['wrongUnamePass'] = "wrong";
        }
        $stmt_check->close();
        $conn->close();

    }

}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (!empty($errors)) {
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
   $data["success"] = true;
   $data["message"] = "Success!";
}

// backend response
echo json_encode($data);
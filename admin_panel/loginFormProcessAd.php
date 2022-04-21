<?php
require_once('includes/conn.php');
session_start();
$errors = [];
$data = [];


function getIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // After 3 failed login attempts we block the ip address for 5 minutes

    $time = time() - (5 * 60); // Attempt lock time (5 minutes)
    $ipAddress = getIpAddr(); // Stroing user IP address in a variable.

    // counting number of login attempts according to the ip address and prvevious (login attempt time)
    $result = $conn->query("select count(*) as attempt_count from loginlogs where tryTime > $time and IpAddress='$ipAddress'");
    $row = $result->fetch_assoc();
    $attempt_count = $row['attempt_count'];

    if ($attempt_count == 3) {
        $errors['attemptsTitle'] = "You've reached your limit!";
        $errors['attemptsMsg'] = "To many failed login attempts. Please login after 5 minutes";
    } else {

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
        if (!empty($_POST["remember"])) {
            setcookie("email", $_POST["email"], time() + 3600 * 24);
            setcookie("password", $_POST["password"], time() + 3600 * 24);
        } else {
            setcookie("email", "");
            setcookie("password", "");
        }

        if ($isSetEmail == 1 && $isSetPassword == 1) {
            $stmt_check = $conn->prepare("SELECT * FROM user WHERE email = ?;");
            $stmt_check->bind_param("s", $_POST['email']);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            $row = $result->fetch_assoc();
            // if role==1 means it's admin
            if ($row && password_verify($password, $row['pass']) && $row['role']==1) {
                // $_SESSION['user'] = $row;
                $_SESSION['firstName'] = $row['firstName'];
                // $_SESSION['isLoggedIn'] = 1;
                $_SESSION['isLoggedInAdmin'] = 1;
                $conn->query("delete from loginlogs where ipAddress='$ipAddress'");
            } else {
                $errors['wrongUnamePass'] = "wrong";
                $attempt_count++;
                $remaining_attempts = 3 - $attempt_count;
                if ($remaining_attempts == 0) {
                    $errors['attemptsTitle'] = "You've reached your limit!";
                    $errors['attemptsMsg'] = "To many failed login attempts. Please login after 5 minutes";
                } else {
                    $errors['attemptsTitle'] = "Incorrect email or password!";
                    $errors['attemptsMsg'] = "Please enter valid login details. $remaining_attempts attempts remaining";
                }
                $tryTime = time();
                $conn->query("insert into loginlogs(ipAddress, tryTime) values('$ipAddress','$tryTime')");
            }
            $stmt_check->close();
        }else{
            $attempt_count++;
            $remaining_attempts = 3 - $attempt_count;
            if ($remaining_attempts == 0) {
                $errors['attemptsTitle'] = "You've reached your limit!";
                $errors['attemptsMsg'] = "To many failed login attempts. Please login after 5 minutes";
            } else {
                $errors['attemptsTitle'] = "Incorrect email or password!";
                $errors['attemptsMsg'] = "Please enter valid login details. $remaining_attempts attempts remaining";
            }
            $tryTime = time();
            $conn->query("insert into loginlogs(ipAddress, tryTime) values('$ipAddress','$tryTime')");
            $conn->close();
        }
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

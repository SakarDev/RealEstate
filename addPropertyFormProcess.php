<?php
session_start();
require_once('includes/conn.php');

$errors = [];
$data = [];
$town = null;



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    // property_title
    if (!isset($_POST['property_title']) || empty($_POST["property_title"])) {
        $errors['property_title'] = "Property tile is required";
    } else {
        $property_title = test_input($_POST["property_title"]);
        // check if property_title only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $property_title)) {
            $errors['property_title'] = "Only letters and white space allowed";
        }
    }

    // property_type
    if (!isset($_POST['property_type']) || empty($_POST["property_type"])) {
        $errors['property_type'] = "Property type is required";
    } else {
        $property_type = test_input($_POST["property_type"]);
    }

    // transaction_type
    if (!isset($_POST['transaction_type']) || empty($_POST["transaction_type"])) {
        $errors['transaction_type'] = "Transaction type is required";
    } else {
        $transaction_type = test_input($_POST["transaction_type"]);
    }

    // city
    if (!isset($_POST['city']) || empty($_POST["city"])) {
        $errors['city'] = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    // town (optional)
    if (isset($_POST['town']) && !empty($_POST["town"])) {
        $town = test_input($_POST["town"]);
    }

    // street
    if (!isset($_POST['street']) || empty($_POST["street"])) {
        $errors['street'] = "Street is required";
    } else {
        $street = test_input($_POST["street"]);
    }

    // area
    if (!isset($_POST['area']) || empty($_POST["area"])) {
        $errors['area'] = "Area is required";
    } else {
        $area = test_input($_POST["area"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $area)) {
            $errors['area'] = "Invalid area (should contain only numbers)!";
        }
    }

    // price
    if (!isset($_POST['price']) || empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $price)) {
            $errors['price'] = "Invalid price (should contain only numbers)!";
        }
    }

    // no_bedrooms
    if (!isset($_POST['no_bedrooms']) || empty($_POST["no_bedrooms"])) {
        $errors['no_bedrooms'] = "Number of bedrooms is required";
    } else {
        $no_bedrooms = test_input($_POST["no_bedrooms"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $no_bedrooms)) {
            $errors['no_bedrooms'] = "Invalid no_bedrooms (should contain only numbers)!";
        }
    }

    // no_bathrooms
    if (!isset($_POST['no_bathrooms']) || empty($_POST["no_bathrooms"])) {
        $errors['no_bathrooms'] = "Number of bathrooms is required";
    } else {
        $no_bathrooms = test_input($_POST["no_bathrooms"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $no_bathrooms)) {
            $errors['no_bathrooms'] = "Invalid number of bathrooms (should contain only numbers)!";
        }
    }

    // no_garages
    if (!isset($_POST['no_garages']) || empty($_POST["no_garages"])) {
        $errors['no_garages'] = "Number of garages is required";
    } else {
        $no_garages = test_input($_POST["no_garages"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $no_garages)) {
            $errors['no_garages'] = "Invalid number of garages (should contain only numbers)!";
        }
    }

    // no_floors
    if (!isset($_POST['no_floors']) || empty($_POST["no_floors"])) {
        $errors['no_floors'] = "Number of floors is required";
    } else {
        $no_floors = test_input($_POST["no_floors"]);
        // the format "/^[0-9]+$/" checks if only contains numbers
        if (!preg_match("/^[0-9]+$/", $no_floors)) {
            $errors['no_floors'] = "Invalid number of floors (should contain only numbers)!";
        }
    }

    // property_image
    if (!isset($_FILES['property_image']['name']) || empty($_FILES['property_image']['name'])) {
        $errors['property_image'] = "Property image is required";
    }

    //   telephone
    if (!isset($_POST['telephone']) || empty($_POST["telephone"])) {
        $errors['telephone'] = "Phone number is required";
    } else {
        $telephone = test_input($_POST["telephone"]);
        // the format /^[0-9]{11}+$/ will check for phone number with 11 digits and only numbers
        if (!preg_match('/^[0-9]{11}+$/', $telephone)) {
            $errors['telephone'] = "Invalid phone number (11 digits are allowed)";
        }
    }

    // description 
    if (!isset($_POST['description']) || empty($_POST["description"])) {
        $errors['description'] = "Description is required";
    } else {
        $description = test_input($_POST["description"]);
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $GLOBALS['conn']->real_escape_string($data);
    return $data;
}

if (!empty($errors)) {
    $data["success"] = false;
    $data["errors"] = $errors;
} else {
    $data["success"] = true;
    $data["message"] = "Success!";


    // rename and store the image in the uploads folder 
    $fileExt = explode('.', $_FILES['property_image']['name']);
    $fileActualExt = strtolower(end($fileExt));
    //allowed file types to be uploded
    $allowed = array('jpg', 'jpeg', 'png');
    $errors['property_image'] = "It came here!";


    if (in_array($fileActualExt, $allowed)) {
        if ($_FILES['property_image']['error'] == 0) {
            //generating a new name using uniqid() function which generates a unique identifier based on the current time in microseconds
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = "uploads/" . $fileNameNew;
            // move the uploaded file from the temporary location to the new destination we specified
            $fileTmpLocation = $_FILES['property_image']['tmp_name'];
            move_uploaded_file($fileTmpLocation, $fileDestination);
        } else {
            $errors['property_image'] = "There was an error uploading your file!";
        }
    } else {
        $errors['property_image'] = "Only (png/jpg/jpeg) file types are allowed!";
    }
    // -------------Inserting data to the database-------------



    // town is optional
    if ($town != "") {
        $stmt = $conn->prepare("INSERT INTO property (
            property_title, 
            property_type_id_propertyfk, 
            transaction_type, 
            city_id_propertyfk, 
            town_id_propertyfk , 
            street_id_propertyfk, 
            user_id_propertyfk, 
            area, 
            price, 
            no_bedrooms, 
            no_bathrooms, 
            no_garages, 
            no_floors, 
            property_image, 
            property_telephone, 
            description  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sisiiiiiiiiiisis",
            $property_title,
            $property_type,
            $transaction_type,
            $city,
            $town,
            $street,
            $_SESSION['user_id'],
            $area,
            $price,
            $no_bedrooms,
            $no_bathrooms,
            $no_garages,
            $no_floors,
            $fileDestination,
            $telephone,
            $description
        );
    } else {
        $stmt = $conn->prepare("INSERT INTO property (
            property_title, 
            property_type_id_propertyfk, 
            transaction_type, 
            city_id_propertyfk, 
            street_id_propertyfk, 
            user_id_propertyfk, 
            area, 
            price, 
            no_bedrooms, 
            no_bathrooms, 
            no_garages, 
            no_floors, 
            property_image, 
            property_telephone, 
            description  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sisiiiiiiiiisss",
            $property_title,
            $property_type,
            $transaction_type,
            $city,
            $street,
            $_SESSION['user_id'],
            $area,
            $price,
            $no_bedrooms,
            $no_bathrooms,
            $no_garages,
            $no_floors,
            $fileDestination,
            $telephone,
            $description
        );
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();
}



// backend response
echo json_encode($data);
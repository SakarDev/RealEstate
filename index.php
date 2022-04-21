<?php
session_start();
$page = "index";
require_once('includes/conn.php');

// Fetch all the data needed
$property_type_query = "SELECT * FROM property_type ORDER BY property_type_id DESC";
$property_type_result = $conn->query($property_type_query);

$city_query = "SELECT * FROM city ORDER BY city_name DESC";
$city_result = $conn->query($city_query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wonder Area</title>
    <link rel="icon" id="favicon" href="assets/icons/logo.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/main.min.css">
</head>

<body>

    <div class="banner">

        <!-- the navigation here differs from other pages navigation because of scrolling-active  -->
        <nav class="navbar navbar-expand-md fixed-top navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/icons/logo.png" alt="Wonder Area">
                </a>
                <button id="humbergur-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="addProperty.php">Add Property</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                        <?php
                        if (!isset($_SESSION['isLoggedIn'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        } else {
                            echo '<li class="nav-item" id="logout"><a class="nav-link" href="logout.php">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="banner-text">
            <h1 class="h1 text-white">A home changes everything</h1>
        </div>

        <!-- search section  -->
        <div class="container py-5 px-xl-5">
            <div class="row justify-content-center">
                <div class="col-xxl-10 col-12 p-2 rounded">
                    <form id="search-form" action="" method="POST">
                        <div id="search-bg" class="row input-group rounded justify-content-center">
                            <!-- buy or rent dropdown -->
                            <div id="buy-rent-dropdown"
                                class="btn-group col-lg-2 col-md-auto bg-white rounded-start p-2">
                                <select class="form-select" id="transaction_type" name="transaction_type">
                                    <option selected value="">Buy | Rent</option>
                                    <option value="rent">Rent</option>
                                    <option value="sale">Sale</option>
                                </select>
                            </div>
                            <!-- select box  property_type  -->
                            <div class="btn-group col-lg-3 col-md-auto bg-white p-2">
                                <select class="form-select" id="property_type" name="property_type">
                                    <option selected value="">Property type</option>
                                    <?php
                                    if ($property_type_result->num_rows > 0) {
                                        while ($row = $property_type_result->fetch_assoc()) {
                                            echo '<option value="' . $row['property_type_id'] . '">' . $row['property_type_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Property type available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- city -->
                            <div class="btn-group col-lg-2 col-md-auto bg-white p-2">
                                <select class="form-select" id="city" name="city">
                                    <option selected value="">City</option>
                                    <?php
                                    if ($city_result->num_rows > 0) {
                                        while ($row = $city_result->fetch_assoc()) {
                                            echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No City available</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="btn-group col-lg-2 col-md-auto bg-white p-2">
                                <!-- select box  street -->
                                <select class="form-select" id="street" name="street">
                                    <option selected value="">Street</option>
                                </select>
                            </div>

                            <!-- search should open up a modal to search for property -->
                            <button class="btn btn-prim col-md-auto col-3" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-wrapper">
            <div class="contact-box overflow-visible">
                <div class="line"></div>
                <p id="title">Contact main Agent!</p>
                <p><a href="tel:+13413234047">
                        <i class="fa fa-phone"></i>(341) 323 - 4047</a></p>
                <p><a href="mailto:hello@wonderarea.com"><i class="fa fa-envelope-o"></i>
                        hello@wonderarea.com</a></p>
                <p><a href="https://www.google.com/maps/place/Tuy+Malik+St,+Sulaymaniyah/@35.5716826,45.4534664,17z/data=!3m1!4b1!4m5!3m4!1s0x40002c5b14c9d881:0xc6622a7d1d50c72!8m2!3d35.5716826!4d45.4556551"
                        target="_blank"><i class="fa fa-home"></i>
                        St.123, Sulaymaniyah, TM</a></p>
                <p>
                    <a href="signup.php" target="_blank">
                        <input type="button" value="REGISTER FOR FREE"></a>
                </p>
            </div>
        </div>
    </div>





    <!-- Cards -->
    <div class="btn-cont mt-5">
        <a href="addProperty.php" class="btn btn-primary">+ Add property</a>
    </div>
    <div class="card-container">
        <div class="rows">
            <!-- the content here is fetched when the page is loading -->
        </div>
    </div>


    <div class="social-icons">
        <li><a href="https://www.facebook.com/sakar.h.saeed/"><span><i class="fa fa-facebook-f"></i></span></a></li>
        <li><a href="https://twitter.com/Sakar_Hamasaeed"><span><i class="fa fa-twitter"></i></span></a></li>
        <li><a href="https://www.instagram.com/sakar.hamasaeed/"><span><i class="fa fa-instagram"></i></span></a></li>
    </div>


    <!-- modal (add street) -->
    <div id="modal_search" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search For Property</h5>
                </div>
                <form id="searchModal-form" method="POST" action="indexFetch.php">
                    <div class="modal-body">

                        <!-- buy or rent dropdown -->
                        <div id="buyRent-group" class="col-md-12 form-group">
                            <label for="transaction_type_modal" class="form-label">Transaction Type</label>
                            <select class="form-select" id="transaction_type_modal" name="transaction_type_modal">
                                <option selected value="">Choose...</option>
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                            </select>
                        </div>

                        <!-- select box property_type  -->
                        <div class="col-md-12 form-group">
                            <label for="property_type_modal" class="form-label">Property type</label>
                            <select class="form-select" id="property_type_modal" name="property_type_modal">
                                <option selected value="">Choose...</option>
                                <?php
                                $property_type_query = "SELECT * FROM property_type ORDER BY property_type_id DESC";
                                $property_type_result = $conn->query($property_type_query);
                                
                                if ($property_type_result->num_rows > 0) {
                                    while ($row = $property_type_result->fetch_assoc()) {
                                        echo '<option value="' . $row['property_type_id'] . '">' . $row['property_type_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No Property type available</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- city -->
                        <div class="col-md-12 form-group">
                            <label for="city_modal" class="form-label">City</label>
                            <select class="form-select" id="city_modal" name="city_modal">
                                <option selected value="">Choose...</option>
                                <?php
                                $city_query = "SELECT * FROM city ORDER BY city_name DESC";
                                $city_result = $conn->query($city_query);
                                if ($city_result->num_rows > 0) {
                                    while ($row = $city_result->fetch_assoc()) {
                                        echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No City available</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- street -->
                        <div class="col-md-12 form-group">
                            <label for="street_modal" class="form-label">Street</label>
                            <select class="form-select" id="street_modal" name="street_modal">
                                <option selected value="">Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

    </script>




    <!-- footer -->
    <?php include_once("includes/footer.php"); ?>


    <!-- <script src="assets/bootstrap-5/js/bootstrap.min.js"></script> -->
    <script src="assets/jquery3.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="customScript.js"> </script>

</body>

</html>
<?php
session_start();
$page = "addProperty";
require_once('includes/conn.php');

// Fetch all the data needed
$property_type_query = "SELECT * FROM property_type ORDER BY property_type_id DESC"; 
$property_type_result = $conn->query($property_type_query); 

$city_query = "SELECT * FROM city ORDER BY city_name DESC"; 
$city_result = $conn->query($city_query); 

?>
<!DOCTYPE html>
<html>

<head>
    <title>Add property</title>
    <link rel="icon" id="favicon" href="assets/icons/logo.ico" />



</head>

<body>

    <div class="navigationOnly">
        <?php require_once('includes/header.php'); ?>
    </div>

    <?php 
    // if user didn't login
    if(!isset($_SESSION['isLoggedIn'])){
    echo '<script>
    $(document).ready(function() {
      $("#should-login-signup").modal("show");
    });
    </script>';
    // header('location: login.php');
  }
    ?>

    <div class="container p-5">
        <form enctype="multipart/form-data" id="addProperty-form" action="addPropertyFormProcess.php" method="POST"
            class="row g-3 col-xl-8 col-lg-10 col-12  mx-auto border p-3">
            <h3>Add new property</h3>
            <!-- property title -->
            <div id="property_title-group" class="col-md-6 form-group">
                <label for="property_title" class="form-label">Property title</label>
                <input type="text" id="property_title" name="property_title" class="form-control">
            </div>

            <!-- select box  property_type  -->
            <div id="property_type-group" class="col-md-6 form-group">
                <label for="property_type" class="form-label">Property type</label>
                <select class="form-select" id="property_type" name="property_type">
                    <option selected disabled value="">Choose...</option>
                    <?php 
                    if($property_type_result->num_rows > 0){
                        while($row = $property_type_result->fetch_assoc()){  
                            echo '<option value="'.$row['property_type_id'].'">'.$row['property_type_name'].'</option>'; 
                        }
                    }else{
                        echo '<option value="">No Property type available</option>'; 
                    }
                    ?>
                </select>
            </div>

            <!-- transaction type -->
            <div id="transaction_type-group" class="col-md-6 form-group">
                <label for="transaction_type" class="form-label">Transaction type</label>
                <select class="form-select" id="transaction_type" name="transaction_type">
                    <option selected disabled value="">Choose...</option>
                    <option value="rent">Rent</option>
                    <option value="sale">Sale</option>
                </select>
            </div>

            <!-- select box  city -->
            <div id="city-group" class="col-md-6 form-group">
                <label for="city" class="form-label">City</label>
                <select class="form-select" id="city" name="city">
                    <option selected disabled value="">Choose...</option>
                    <?php
                    if($city_result->num_rows > 0){
                        while($row = $city_result->fetch_assoc()){  
                            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>'; 
                        }
                    }else{
                        echo '<option value="">No City available</option>'; 
                    }
                    ?>
                </select>
            </div>

            <!-- select box town  -->
            <div id="town-group" class="col-md-6 form-group">
                <label for="town" class="form-label">Town</label>
                <select class="form-select" id="town" name="town">
                    <option selected disabled value="">Choose...</option>
                    <option value="">Select city first</option>
                </select>
            </div>

            <!-- select box  street -->
            <div id="street-group" class="col-md-6 form-group">
                <label for="street" class="form-label">Street</label>
                <select class="form-select" id="street" name="street">
                    <option selected disabled value="">Choose...</option>
                    <option value="">Select city first</option>
                </select>
            </div>

            <!-- area -->
            <div id="area-group" class="col-md-6 form-group">
                <label for="area" class="form-label">Area in sq ft</label>
                <input type="number" id="area" name="area" class="form-control">
            </div>
            <!-- price -->
            <div id="price-group" class="col-md-6 form-group">
                <label for="price" class="form-label">Price</label>
                <input type="text" id="price" name="price" class="form-control">
            </div>
            <!-- number of bedrooms -->
            <div id="no_bedrooms-group" class="col-md-6 form-group">
                <label for="no_bedrooms" class="form-label">Number of bedrooms</label>
                <input type="number" id="no_bedrooms" name="no_bedrooms" class="form-control">
            </div>
            <!-- number of bathrooms -->
            <div id="no_bathrooms-group" class="col-md-6 form-group">
                <label for="no_bathrooms" class="form-label">Number of bathrooms</label>
                <input type="number" id="no_bathrooms" name="no_bathrooms" class="form-control">
            </div>
            <!-- number of garages -->
            <div id="no_garages-group" class="col-md-6 form-group">
                <label for="no_garages" class="form-label">Number of garages</label>
                <input type="number" id="no_garages" name="no_garages" class="form-control">
            </div>
            <!-- number of floors -->
            <div id="no_floors-group" class="col-md-6 form-group">
                <label for="no_floors" class="form-label">Number of floors</label>
                <input type="number" id="no_floors" name="no_floors" class="form-control">
            </div>
            <!-- property image	 -->
            <div id="property_image-group" class="col-md-6 form-group">
                <label for="property_image" class="form-label">Property image</label>
                <input type="file" accept="image/png, image/jpg, image/jpeg" id="property_image" name="property_image"
                    class="form-control">
            </div>
            <!-- property telephone -->
            <div id="telephone-group" class="col-md-6 form-group">
                <label for="telephone" class="form-label">Phone Number</label>
                <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="0770 xxx xx xx">
            </div>
            <!-- description -->
            <div id="description-group" class="col-md-6 form-group">
                <label for="description" class="form-label">Discription</label>
                <textarea id="description" name="description" class="form-control" rows="3"
                    placeholder="Optional"></textarea>
            </div>
            <!-- publish button -->
            <div class="col-12">
                <button class="btn col-md-2 col-sm-12 btn-primary" type="submit" name="publish">Publish</button>
            </div>
        </form>
    </div>

    <!-- modal (should-login-signup)  -->
    <div id="should-login-signup" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login or signup!</h5>
                </div>
                <div class="modal-body">Please login, if you don't have an account you can signup!</div>
                <div class="modal-footer">
                    <a type="button" href="login.php" class="btn btn-primary">Login</a>
                    <a type="button" href="signup.php" class="btn btn-secondary">Signup</a>
                </div>
            </div>
        </div>
    </div>

    <!-- modal success add -->
    <div id="success_addPropertyType" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Thanks</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#should-login-signup').on('hidden.bs.modal', function () {
            window.location = "login.php";
        });
    </script>

    <?php require_once('includes/footer.php'); ?>


    <script src="addPropertyForm.js"></script>

</body>

</html>
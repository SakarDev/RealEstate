<?php 
$page = "signup";
require_once('includes/conn.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="icon" id="favicon" href="assets/icons/logo.ico" />



</head>

<body>

    <div class="navigationOnly">
        <?php require_once('includes/header.php'); ?>
    </div>
    <div class="container p-5">
        <form id="signup-form" action="signupFormProcess.php" method="POST"
            class="row g-3 col-xl-8 col-lg-10 col-12  mx-auto border p-3">
            <h3>User Registeration</h3>
            <!-- first name -->
            <div id="firstName-group" class="col-md-6 form-group">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control">
            </div>
            <!-- last name -->
            <div id="lastName-group" class="col-md-6 form-group">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control">
            </div>
            <!-- email -->
            <div id="email-group" class="col-md-12 form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" id="email" name="email" class="form-control"
                        aria-describedby="inputGroupPrepend validationServerEmailFeedback">
                </div>
            </div>
            <!-- password -->
            <div id="password-group-id" class="col-md-6 password-group form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <!-- confirm password -->
            <div id="confirmPassword-group-id" class="col-md-6 password-group form-group">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" name="confirmPassword">
            </div>
            <!-- show/hide password -->
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onclick="showHidePassw()" id="showHidePass">
                    <label class="form-check-label" for="showHidePass">Show/Hide Password</label>
                </div>
            </div>
            <!-- telephone -->
            <div id="telephone-group" class="col-md-6 form-group">
                <label for="telephone" class="form-label">Phone Number</label>
                <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="0770 xxx xx xx">
            </div>

            <!-- submit button -->
            <div class="col-12">
                <button class="btn col-md-2 col-sm-12 col-xs-12 btn-primary" type="submit" name="submit">Signup</button>
            </div>
        </form>
    </div>

    <?php require_once('includes/footer.php'); ?>


    <script src="signupForm.js"></script>

</body>

</html>
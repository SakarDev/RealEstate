<?php session_start(); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css">
<link rel="stylesheet" href="css/main.min.css">

<div class="navigationOnly">
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-secon">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/icons/logo.png" alt="Wonder Area">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?php if($page=='index') echo 'active'; ?>"
                            aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($page=='addProperty') echo 'active'; ?>"
                            href="addProperty.php">Add Property</a></li>
                    <li class="nav-item"><a class="nav-link <?php if($page=='signup') echo 'active'; ?>"
                            href="signup.php">Signup</a></li>
                    <?php 
                    if(!isset($_SESSION['isLoggedIn'])){
                        echo '<li class="nav-item"><a class="nav-link ';
                        if($page=='login') echo 'active';
                       echo '" href="login.php">Login</a></li>';
                    }else{
                        echo '<li class="nav-item" id="logout"><a class="nav-link" href="logout.php">Logout</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<script src="assets/jquery3.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
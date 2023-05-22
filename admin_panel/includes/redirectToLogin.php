<?php 
    if (!isset($_SESSION['isLoggedInAdmin']) || $_SESSION['isLoggedInAdmin'] != 1) {
        header("location: loginAd.php");
        exit();
}
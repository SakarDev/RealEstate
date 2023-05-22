<?php
require_once("conn.php");
require_once("redirectToLogin.php") ?>

<link rel="stylesheet" href="../css/main.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/admin_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-warning">
            <i class="fa fa-bars"></i>
        </button>

        <header class="p-3 mb-3 border-bottom">
            <div class="container px-5">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/images/profile/user.png" alt="mdo" width="32" height="32" class="rounded-circle me-3">
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="signupAd.php">Register admin</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logoutAd.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
</nav>

<script src="../assets/jquery3.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/sidebarAdminPanel.js"></script>

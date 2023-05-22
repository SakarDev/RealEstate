<?php
session_start();
$page = "login";

if(isset($_SESSION['signupSuccess'])){
  if($_SESSION['signupSuccess'] == 1){
    unset($_SESSION['signupSuccess']);
    echo '<script>
    $(document).ready(function() {
      $("#modal-signup-success").modal("show");
    });
    </script>';
  }
}

if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==1){
  header("location: index.php");
}

// it needs to be after the header("location: index.php"); otherwise it will not work because of the header only once the header is sent :)
require_once 'includes/header.php';

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="icon" id="favicon" href="/assets/icons/logo.ico" />



  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  <!-- Custom styles for this template -->
  <link href="login.css" rel="stylesheet">

</head>

<body>

  <div class="text-center login-formaka">
    <main class="form-signin">
      <form id="login-form" action="loginFormProcess.php" method="POST">
        <img class="mb-4" src="assets/images/user.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <!-- email -->
        <div class="form-floating" id="email-group">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
            value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>">
          <label for="floatingInput">Email address</label>
        </div>
        <br>
        <!-- password -->
        <div class="form-floating" id="password-group">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
            value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
          <label for="floatingPassword">Password</label>
        </div>
        <!-- remember me -->
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me" name="remember" id="remember"
              <?php if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])){ echo "checked";}?>>
            Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </main>
  </div>

  <!-- Modal (signup success) -->
  <div id="modal-signup-success" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registeration complete</h5>
        </div>
        <div class="modal-body">Account created successfully!</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Thanks</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal (login-fail) -->
  <div id="modal-login-fail" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Wrong email or password!</h5>
        </div>
        <div class="modal-body">Please check your email or password, if you don't have an account you can signup!</div>
        <div class="modal-footer">
          <a type="button" href="signup.php" class="btn btn-success">Signup</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thanks</button>
        </div>
      </div>
    </div>
  </div>

  <script src="loginForm.js"></script>

  <?php require_once('includes/footer.php'); ?>
</body>

</html>
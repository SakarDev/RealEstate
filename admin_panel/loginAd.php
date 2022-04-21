<?php
session_start();

if (isset($_SESSION['isLoggedInAdmin']) && $_SESSION['isLoggedInAdmin'] == 1) {
  header("location: dashboard.php");
  exit();
  echo "<script> alert('logina'); </script>";
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <link href="loginAd.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.min.css">
</head>

<body>

  <div class="text-center login-formaka">
    <main class="form-signin">
      <form id="login-form" action="loginFormProcessAd.php" method="POST">
        <img class="mb-4" src="../assets/images/user.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <!-- email -->
        <div class="form-floating" id="email-group">
          <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
            value="<?php if (isset($_COOKIE["email"])) { echo $_COOKIE["email"];} ?>">
          <label for="floatingInput">Email address</label>
        </div>
        <br>
        <!-- password -->
        <div class="form-floating" id="password-group">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"
            value="<?php if (isset($_COOKIE["password"])) {echo $_COOKIE["password"]; } ?>">
          <label for="floatingPassword">Password</label>
        </div>
        <!-- remember me -->
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me" name="remember" id="remember"
              <?php if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {echo "checked";} ?>>
            Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>
    </main>
  </div>


  <!-- Modal (login-fail) -->
  <div id="modal-login-fail" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"></div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Thanks</button>
        </div>
      </div>
    </div>
  </div>


  <script src="../assets/jquery3.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="loginFormAd.js"></script>

</body>

</html>
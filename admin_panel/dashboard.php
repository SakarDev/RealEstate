<?php
session_start();
$page = "dashboard"; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <title>Dashboard</title>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">

    <?php require_once("includes/admin_sidebar.php"); ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 px-md-5">

      <?php require_once("includes/admin_header.php"); ?>

      <link rel="stylesheet" href="../css/main.min.css">


      <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Users</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM user";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Admins</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM user where role=1";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Posts</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM property ";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Property types</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM property_type ";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total City</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM city";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Town</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM town";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title h5">Total Streets</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT count(*) as myCounter FROM street";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  echo $row['myCounter'];
                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>


</body>

</html>
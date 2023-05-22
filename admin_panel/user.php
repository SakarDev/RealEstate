<?php
session_start();
$page = "user"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <title>Users</title>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <?php require_once("includes/admin_sidebar.php"); ?>


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <?php require_once("includes/admin_header.php"); ?>

      <!-- Bootstrap CSS -->
      <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
      
      <h3>Users</h3>
      <div class="alert alert-warning" role="alert">
        Role 1 means admin while role 0 means user.
      </div>
      <br>



      
      <!-- from here to bottom needs this style and these 2 scripts -->
      <link rel="stylesheet" href="../css/main.min.css">
      <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

      <div class="row">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="userTbl" class="table">
                <thead>
                  <th>Id</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Telephone</th>
                  <th>Role</th>
                  <th>Options</th>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          $('#userTbl').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'userFetch.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [6]
            }, ]
          });
        });
      </script>

       <!-- Modal (delete user) -->
       <div id="modal-delete-user" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
            </div>
            <div class="modal-body">Are you sure you want to delete this user?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteConfirmed">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

      <!-- modal success add-delete-modify -->
      <div id="add-delete-modify-user" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





    </div>
  </div>

  <script src="userForm.js"></script>


</body>


</html>
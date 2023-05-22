<?php
session_start();
$page = "propertyType"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <title>Property Type</title>
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

      <h3>Property Type</h3>
      <br>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-property-type">+Add
        Property</button>
      <br>
      <br>

      <!-- from here to bottom needs this style and these 2 scripts -->
      <link rel="stylesheet" href="../css/main.min.css">
      <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

      <div class="row">
        <div class="container">
          <!-- <div class="btnAdd">
            <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <table id="propertyTypeTbl" class="table">
                <thead>
                  <th>Id</th>
                  <th>Property Name</th>
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
        $(document).ready(function () {
          $('#propertyTypeTbl').DataTable({
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'propertyTypeFetch.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [2]
            }, ]
          });

        });
      </script>


      <!-- modal (add property type) -->
      <div id="modal-add-property-type" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add property type</h5>
            </div>
            <form id="addProperty-form" method="POST" action="propTypeFrmProcessAdd.php">
              <div class="modal-body">
                <div id="new_property_type-group" class="col-md-12 form-group">
                  <label for="new_property_type" class="form-label">Property name: </label>
                  <input type="text" id="new_property_type" name="new_property_type" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal (edit property type) -->
      <div id="modal-edit-property-type" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit property type</h5>
            </div>
            <form id="editProperty-form" method="POST" action="propTypeFrmProcessEdit.php">
              <div class="modal-body">
                <!-- these 2 hidden inputs are needed for the updating purpose -->
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="trid" id="trid" value="">
                <div id="edited_property_type-group" class="col-md-12 form-group">
                  <label for="edited_property_type" class="form-label">Property name: </label>
                  <input type="text" id="edited_property_type" name="edited_property_type" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal (delete property type) -->
      <div id="modal-delete-property-type" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete property type</h5>
            </div>
            <div class="modal-body">Are you sure you want to delete this property type?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteConfirmed">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>


      <!-- modal success add-delete-modify -->
      <div id="add-delete-modify-propertyType" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
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


    </div>
  </div>


  <script src="propertyTypeForm.js"></script>
</body>

</html>
<?php
session_start();
$page = "street";
require_once("includes/conn.php");
// Fetch all the city data for the dropdowns 
$query = "SELECT * FROM city ORDER BY city_name DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <title>Street</title>
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

      <div>
        <h3>Street</h3>
      </div>
      <br>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-street">+Add
        street</button>
      <br>
      <br>


      <!-- from here to bottom needs this style and these 2 scripts -->
      <link rel="stylesheet" href="../css/main.min.css">
      <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

      <div class="row">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="streetTbl" class="table">
                <thead>
                  <th>Id</th>
                  <th>Street Name</th>
                  <th>City Name</th>
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
          $('#streetTbl').DataTable({
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'streetFetch.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [3]
            }, ]
          });

        });
      </script>


      <!-- modal (add street) -->
      <div id="modal-add-street" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add street</h5>
            </div>
            <form id="addStreet-form" method="POST" action="streetFrmProcessAdd.php">
              <div class="modal-body">
                <!-- select box city -->
                <div id="cityRelated-group" class="col-md-12 form-group">
                  <label for="cityRelated" class="form-label">City</label>
                  <select class="form-select" id="cityRelated" name="cityRelated">
                    <option selected value="">Choose...</option>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
                      }
                    } else {
                      echo '<option value="">No city available</option>';
                    }
                    ?>
                  </select>
                </div>
                <div id="new_street-group" class="col-md-12 form-group">
                  <label for="new_street" class="form-label">Street name: </label>
                  <input type="text" id="new_street" name="new_street" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal (edit street ) -->
      <div id="modal-edit-street" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit street</h5>
            </div>
            <form id="editStreet-form" method="POST" action="streetFrmProcessEdit.php">
              <div class="modal-body">
                <!-- these 2 hidden inputs are needed for the updating purpose -->
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="trid" id="trid" value="">
                <div id="edited_street-group" class="col-md-12 form-group">
                  <label for="edited_street" class="form-label">street name: </label>
                  <input type="text" id="edited_street" name="edited_street" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal (delete street) -->
      <div id="modal-delete-street" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete street</h5>
            </div>
            <div class="modal-body">Are you sure you want to delete this street?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteConfirmed">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>


      <!-- modal success add-delete-modify -->
      <div id="add-delete-modify-street" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
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

  <script src="streetForm.js"></script>


</body>

</html>
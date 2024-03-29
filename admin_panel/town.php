<?php
session_start();
$page = "town";
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

  <title>Town</title>
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

      <h3>Modify town</h3>
      <br>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-add-town">+Add Town</button>
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
              <table id="townTbl" class="table">
                <thead>
                  <th>Id</th>
                  <th>Town Name</th>
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
        $(document).ready(function() {
          $('#townTbl').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'townFetch.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [3]
            }, ]
          });

        });
      </script>


      <!-- modal (add town) -->
      <div id="modal-add-town" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add town</h5>
            </div>
            <form id="addTown-form" method="POST" action="townFrmProcessAdd.php">
              <div class="modal-body">
                <!-- select box city -->
                <div id="cityRelated-group" class="col-md-12 form-group">
                  <label for="cityRelated" class="form-label">City</label>
                  <select class="form-select" id="cityRelated" name="cityRelated">
                    <option selected value="">Choose...</option>
                    <?php 
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){  
                            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>'; 
                        }
                    }else{
                        echo '<option value="">No city available</option>'; 
                    }
                    ?>
                  </select>
                </div>
                <div id="new_town-group" class="col-md-12 form-group">
                  <label for="new_town" class="form-label">Town name: </label>
                  <input type="text" id="new_town" name="new_town" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>

       <!-- modal (edit town ) -->
       <div id="modal-edit-town" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit town</h5>
            </div>
            <form id="editTown-form" method="POST" action="townFrmProcessEdit.php">
              <div class="modal-body">
                <!-- these 2 hidden inputs are needed for the updating purpose -->
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="trid" id="trid" value="">
                <div id="edited_town-group" class="col-md-12 form-group">
                  <label for="edited_town" class="form-label">Town name: </label>
                  <input type="text" id="edited_town" name="edited_town" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal (delete town) -->
      <div id="modal-delete-town" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete town</h5>
            </div>
            <div class="modal-body">Are you sure you want to delete this town?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteConfirmed">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>


       <!-- modal success add-delete-modify -->
       <div id="add-delete-modify-town" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

  <script src="townForm.js"></script>



</body>

</html>
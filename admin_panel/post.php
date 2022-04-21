<?php $page = "post"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" id="favicon" href="../assets/icons/logo.ico" />

  <title>Posts</title>
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

      <h3>Properties Published</h3>
      <br>


      <!-- from here to bottom needs this style and these 2 scripts -->
      <link rel="stylesheet" href="../css/main.min.css">
      <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

      <div class="row">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table id="postTbl" class="table">
                <thead>
                  <th>Property Id</th>
                  <th>Property Title</th>
                  <th>Posted By</th>
                  <th>City</th>
                  <th>Date Published</th>
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
          $('#postTbl').DataTable({
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
              $(nRow).attr('id', aData[0]);
            },
            'serverSide': 'true',
            'processing': 'true',
            'paging': 'true',
            'order': [],
            'ajax': {
              'url': 'postFetch.php',
              'type': 'post',
            },
            "aoColumnDefs": [{
              "bSortable": false,
              "aTargets": [5]
            }, ]
          });
        });
      </script>


      <!-- modal (view post in detail ) -->
      <div id="modal_viewPost" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Property</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal (delete property) -->
      <div id="modal-delete-post" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
            </div>
            <div class="modal-body">Are you sure you want to delete this published property?</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="deleteConfirmed">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>


      <!-- modal success add-delete-modify -->
      <div id="success_delete-post" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


  <script src="postForm.js"></script>

</body>

</html>
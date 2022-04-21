$(document).ready(function () {

    // -----------------Add new town-----------------START
    $("#addTown-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var formData = {
            new_town: $("#new_town").val(),
            cityRelated: $("#cityRelated").val(),
        };

        $.ajax({
            type: "POST",
            url: "townFrmProcessAdd.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.new_town) {
                    $("#new_town-group input").addClass("is-invalid");
                    $("#new_town-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.new_town + "</small></div>"
                    );
                }

                if (data.errors.cityRelated) {
                    $("#cityRelated-group input").addClass("is-invalid");
                    $("#cityRelated-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.cityRelated + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the newly added town
                mytable = $('#townTbl').DataTable();
                mytable.draw();
                
                // clean the form
                $('#addTown-form')[0].reset();
                $('#modal-add-town').modal('hide');
                // show successfully added town modal
                $("#add-delete-modify-town .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-town .modal-body").append(
                    '<p class="beErroraka">' +  "Town added successfuly" +  '</p>'
                );
                $("#add-delete-modify-town").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#addTown-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
          
        event.preventDefault();
    });
    // -----------------Add new town-----------------END




     // -----------------Update town-----------------START
    //on click on the edit button of each record of the table
    $('#townTbl').on('click', '.editbtn ', function(event) {
        var table = $('#townTbl').DataTable();
        // var cityName = $(this).data('cityName');
        // the id of the <tr>
        var id = $(this).data('id');
        var trid = $(this).closest('tr').attr('id');
        $('#modal-edit-town').modal('show');
  
        $.ajax({
          url: "townGetSingleData.php",
          data: {id: id},
          type: 'POST',
        }).done(function(data) {
            var json = JSON.parse(data);
            $('#edited_town').val(json.town_name);
            $('#id').val(id);
            $('#trid').val(trid);
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#ediTtown-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });
    //on submit the edit town form
    $("#editTown-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var edited_town = $('#edited_town').val();
        var trid = $('#trid').val();
        var id = $('#id').val();

        var formData = {
            edited_town: edited_town,
            town_id: id,
        };

        $.ajax({
            type: "POST",
            url: "townFrmProcessEdit.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.edited_town) {
                    $("#edited_town-group input").addClass("is-invalid");
                    $("#edited_town-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.edited_town + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the updated town
                mytable = $('#townTbl').DataTable();
                var cityName = data.cityName;
                var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                var row = mytable.row("[id='" + trid + "']");
                row.row("[id='" + trid + "']").data([id, edited_town, cityName, button]);
                
                // clean the form
                $('#editTown-form')[0].reset();
                $('#modal-edit-town').modal('hide');
                // show successfully edited town modal
                $("#add-delete-modify-town .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-town .modal-body").append(
                    '<p class="beErroraka">' +  "Town updated successfuly" +  '</p>'
                );
                $("#add-delete-modify-town").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#edittown-form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
                + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
        event.preventDefault();
    });
    // -----------------Update town-----------------END





    // -----------------Delete town-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-town').modal('show');
    });
    $(document).on('click', '#deleteConfirmed', function(event){
        event.preventDefault();
        $.ajax({
            url: "townFrmProcessDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-town').modal('hide');
                // show successfully deleted town modal
                $("#add-delete-modify-town .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-town .modal-body").append(
                    '<p class="beErroraka">' +  "Town deleted successfuly" +  '</p>'
                );
                $("#add-delete-modify-town").modal("show");

            } else {
                alert('Failed');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#edittown-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete town-----------------END



});




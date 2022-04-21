$(document).ready(function () {

    // -----------------Add new city-----------------START
    $("#addCity-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var formData = {
            new_city: $("#new_city").val(),
        };

        $.ajax({
            type: "POST",
            url: "cityFrmProcessAdd.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.new_city) {
                    $("#new_city-group input").addClass("is-invalid");
                    $("#new_city-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.new_city + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the newly added city
                mytable = $('#cityTbl').DataTable();
                mytable.draw();
                
                // clean the form
                $('#addCity-form')[0].reset();
                $('#modal-add-city').modal('hide');
                // show successfully added city modal
                $("#add-delete-modify-city .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-city .modal-body").append(
                    '<p class="beErroraka">' +  "City added successfuly" +  '</p>'
                );
                $("#add-delete-modify-city").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#addCity-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
          
        event.preventDefault();
    });
    // -----------------Add new city-----------------END




     // -----------------Update city-----------------START
    //on click on the edit button of each record of the table
    $('#cityTbl').on('click', '.editbtn ', function(event) {
        var table = $('#cityTbl').DataTable();
        // the id of the <tr>
        var trid = $(this).closest('tr').attr('id');
        var id = $(this).data('id');
        $('#modal-edit-city').modal('show');
  
        $.ajax({
          url: "cityGetSingleData.php",
          data: {id: id},
          type: 'POST',
        }).done(function(data) {
            var json = JSON.parse(data);
            $('#edited_city').val(json.city_name);
            $('#id').val(id);
            $('#trid').val(trid);
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editCity-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });
    //on submit the edit city form
    $("#editCity-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var edited_city = $('#edited_city').val();
        var trid = $('#trid').val();
        var id = $('#id').val();

        var formData = {
            edited_city: edited_city,
            city_id: id,
        };

        $.ajax({
            type: "POST",
            url: "cityFrmProcessEdit.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.edited_city) {
                    $("#edited_city-group input").addClass("is-invalid");
                    $("#edited_city-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.edited_city + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the updated city
                mytable = $('#cityTbl').DataTable();
                var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                var row = mytable.row("[id='" + trid + "']");
                row.row("[id='" + trid + "']").data([id, edited_city, button]);
                
                // clean the form
                $('#editCity-form')[0].reset();
                $('#modal-edit-city').modal('hide');
                // show successfully edited city modal
                $("#add-delete-modify-city .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-city .modal-body").append(
                    '<p class="beErroraka">' +  "City updated successfuly" +  '</p>'
                );
                $("#add-delete-modify-city").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editCity-form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
                + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
        event.preventDefault();
    });
    // -----------------Update city-----------------END





    // -----------------Delete city-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        // var table = $('#cityTbl').DataTable();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-city').modal('show');
    });
    $(document).on('click', '#deleteConfirmed', function(event){
        // var table = $('#cityTbl').DataTable();
        event.preventDefault();
        $.ajax({
            url: "cityFrmProcessDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-city').modal('hide');
                // show successfully deleted city modal
                $("#add-delete-modify-city .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-city .modal-body").append(
                    '<p class="beErroraka">' +  "City deleted successfuly" +  '</p>'
                );
                $("#add-delete-modify-city").modal("show");

            } else {
                alert('Failed');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editCity-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete city-----------------END



});




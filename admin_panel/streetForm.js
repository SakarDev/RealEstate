$(document).ready(function () {

    // -----------------Add new street-----------------START
    $("#addStreet-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var formData = {
            new_street: $("#new_street").val(),
            cityRelated: $("#cityRelated").val(),
        };

        $.ajax({
            type: "POST",
            url: "streetFrmProcessAdd.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.new_street) {
                    $("#new_street-group input").addClass("is-invalid");
                    $("#new_street-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.new_street + "</small></div>"
                    );
                }

                if (data.errors.cityRelated) {
                    $("#cityRelated-group input").addClass("is-invalid");
                    $("#cityRelated-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.cityRelated + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the newly added street
                mytable = $('#streetTbl').DataTable();
                mytable.draw();
                
                // clean the form
                $('#addStreet-form')[0].reset();
                $('#modal-add-street').modal('hide');
                // show successfully added street modal
                $("#add-delete-modify-street .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-street .modal-body").append(
                    '<p class="beErroraka">' +  "Street added successfuly" +  '</p>'
                );
                $("#add-delete-modify-street").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#addStreet-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
          
        event.preventDefault();
    });
    // -----------------Add new street-----------------END




     // -----------------Update street-----------------START
    //on click on the edit button of each record of the table
    $('#streetTbl').on('click', '.editbtn ', function(event) {
        var table = $('#streetTbl').DataTable();
        // the id of the <tr>
        var id = $(this).data('id');
        var trid = $(this).closest('tr').attr('id');
        $('#modal-edit-street').modal('show');
  
        $.ajax({
          url: "streetGetSingleData.php",
          data: {id: id},
          type: 'POST',
        }).done(function(data) {
            var json = JSON.parse(data);
            $('#edited_street').val(json.street_name);
            $('#id').val(id);
            $('#trid').val(trid);
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#ediTStreet-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });
    //on submit the edit street form
    $("#editStreet-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var edited_street = $('#edited_street').val();
        var trid = $('#trid').val();
        var id = $('#id').val();

        var formData = {
            edited_street: edited_street,
            street_id: id,
        };

        $.ajax({
            type: "POST",
            url: "streetFrmProcessEdit.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.edited_street) {
                    $("#edited_street-group input").addClass("is-invalid");
                    $("#edited_street-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.edited_street + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the updated street
                mytable = $('#streetTbl').DataTable();
                var cityName = data.cityName;
                var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                var row = mytable.row("[id='" + trid + "']");
                row.row("[id='" + trid + "']").data([id, edited_street, cityName, button]);
                
                // clean the form
                $('#editStreet-form')[0].reset();
                $('#modal-edit-street').modal('hide');
                // show successfully edited street modal
                $("#add-delete-modify-street .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-street .modal-body").append(
                    '<p class="beErroraka">' +  "street updated successfuly" +  '</p>'
                );
                $("#add-delete-modify-street").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editStreet-form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
                + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
        event.preventDefault();
    });
    // -----------------Update street-----------------END





    // -----------------Delete street-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        // var table = $('#streetTbl').DataTable();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-street').modal('show');
    });
    $(document).on('click', '#deleteConfirmed', function(event){
        // var table = $('#streetTbl').DataTable();
        event.preventDefault();
        $.ajax({
            url: "streetFrmProcessDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-street').modal('hide');
                // show successfully deleted street modal
                $("#add-delete-modify-street .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-street .modal-body").append(
                    '<p class="beErroraka">' +  "street deleted successfuly" +  '</p>'
                );
                $("#add-delete-modify-street").modal("show");

            } else {
                alert('Failed');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editStreet-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete street-----------------END



});




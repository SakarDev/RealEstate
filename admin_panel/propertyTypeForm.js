$(document).ready(function () {

    // -----------------Add new property-----------------START
    $("#addProperty-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var formData = {
            new_property_type: $("#new_property_type").val(),
        };

        $.ajax({
            type: "POST",
            url: "propTypeFrmProcessAdd.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.new_property_type) {
                    $("#new_property_type-group input").addClass("is-invalid");
                    $("#new_property_type-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.new_property_type + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the newly added property type
                mytable = $('#propertyTypeTbl').DataTable();
                mytable.draw();
                
                // clean the form
                $('#addProperty-form')[0].reset();
                $('#modal-add-property-type').modal('hide');
                // show successfully added property type modal
                $("#add-delete-modify-propertyType .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-propertyType .modal-body").append(
                    '<p class="beErroraka">' +  "Property type added successfuly" +  '</p>'
                );
                $("#add-delete-modify-propertyType").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#addProperty-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
          
        event.preventDefault();
    });
    // -----------------Add new property-----------------END




     // -----------------Update property-----------------START
    //on click on the edit button of each record of the table
    $('#propertyTypeTbl').on('click', '.editbtn ', function(event) {
        var table = $('#propertyTypeTbl').DataTable();
        // the id of the <tr>
        var trid = $(this).closest('tr').attr('id');
        var id = $(this).data('id');
        $('#modal-edit-property-type').modal('show');
  
        $.ajax({
          url: "propertyTypeGetSingleData.php",
          data: {id: id},
          type: 'POST',
        }).done(function(data) {
            // console.log(data);
            var json = JSON.parse(data);
            $('#edited_property_type').val(json.property_type_name);
            $('#id').val(id);
            $('#trid').val(trid);
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editProperty-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });
    //on submit the edit property form
    $("#editProperty-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();
        var edited_property_type = $('#edited_property_type').val();
        var trid = $('#trid').val();
        var id = $('#id').val();

        var formData = {
            edited_property_type: edited_property_type,
            property_type_id: id,
        };

        $.ajax({
            type: "POST",
            url: "propTypeFrmProcessEdit.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.edited_property_type) {
                    $("#edited_property_type-group input").addClass("is-invalid");
                    $("#edited_property_type-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.edited_property_type + "</small></div>"
                    );
                }
            } else {
                //refresh the table to see the updated property type
                mytable = $('#propertyTypeTbl').DataTable();
                var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
                var row = mytable.row("[id='" + trid + "']");
                row.row("[id='" + trid + "']").data([id, edited_property_type, button]);
                
                // clean the form
                $('#editProperty-form')[0].reset();
                $('#modal-edit-property-type').modal('hide');
                // show successfully edited property type modal
                $("#add-delete-modify-propertyType .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-propertyType .modal-body").append(
                    '<p class="beErroraka">' +  "Property type updated successfuly" +  '</p>'
                );
                $("#add-delete-modify-propertyType").modal("show");
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editProperty-form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
                + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
            
          });
        event.preventDefault();
    });
    // -----------------Update property-----------------END





    // -----------------Delete property-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        // var table = $('#propertyTypeTbl').DataTable();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-property-type').modal('show');
    });
    $(document).on('click', '#deleteConfirmed', function(event){
        // var table = $('#propertyTypeTbl').DataTable();
        event.preventDefault();
        $.ajax({
            url: "propTypeFrmProcessDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-property-type').modal('hide');
                // show successfully deleted property type modal
                $("#add-delete-modify-propertyType .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-propertyType .modal-body").append(
                    '<p class="beErroraka">' +  "Property type deleted successfuly" +  '</p>'
                );
                $("#add-delete-modify-propertyType").modal("show");

            } else {
                alert('Failed');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editProperty-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete property-----------------END






});




$(document).ready(function () {

    // -----------------Delete user-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-user').modal('show');
    });
    $(document).on('click', '#deleteConfirmed', function(event){
        event.preventDefault();
        $.ajax({
            url: "userFrmProcessDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-user').modal('hide');
                // show successfully deleted user modal
                $("#add-delete-modify-user .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#add-delete-modify-user .modal-body").append(
                    '<p class="beErroraka">' +  "User deleted successfuly" +  '</p>'
                );
                $("#add-delete-modify-user").modal("show");

            } else {
                alert('Failed');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#modal-delete-user").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete user-----------------END

});




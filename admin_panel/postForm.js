$(document).ready(function () {

     // -----------------View post-----------------START
    //on click on the view button of each record of the table
    $('#postTbl').on('click', '.viewbtn ', function(event) {
        var id = $(this).data('id');
        $.ajax({
          url: "postGetSingleData.php",
          data: {property_id: id},
          type: 'POST',
        }).done(function(data) {
            $('#modal_viewPost .modal-body').html(data);
            $('#modal_viewPost').modal('show');
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#modal_viewPost").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });
    
    // -----------------View post-----------------END





    // -----------------Delete post-----------------START

    var id;
    $(document).on('click', '.deleteBtn', function(event) {
        $(".beErroraka").remove();
        event.preventDefault();
        //the id is used in onclick of the deleteConfirmed right down below
        id = $(this).data('id');
        $('#modal-delete-post').modal('show');
    });

    $(document).on('click', '#deleteConfirmed', function(event){
        event.preventDefault();
        $.ajax({
            url: "postFrmDelete.php",
            data: {id: id},
            type: "post"
        }).done(function(data) {
            var json = JSON.parse(data);
            if (json.success) {
                $("#" + id).closest('tr').remove();
                //hide the delete confirmation modal
                $('#modal-delete-post').modal('hide');
                // show successfully deleted post modal
                $("#success_delete-post .modal-header").append(
                    '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" +  '</h5>'
                );
                $("#success_delete-post .modal-body").append(
                    '<p class="beErroraka">' +  "Post deleted successfuly" +  '</p>'
                );
                $("#success_delete-post").modal("show");

            } else {
                alert('Failed to delete post!');
            }
        })
        .fail(function (data, textStatus, errorThrown) {
            $("#editpost-form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
        });
    });  

    // -----------------Delete post-----------------END



});




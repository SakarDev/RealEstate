$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-floating input").removeClass("is-invalid");
        $(".erroraka").remove();
        var formData = {
            email: $("#email-group #floatingInput").val(),
            password: $("#floatingPassword").val(),
            remember: $("#remember").val(),
        };

        $.ajax({
            type: "POST",
            url: "loginFormProcess.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                
                console.log(data);
                if (data.errors.email) {
                    $("#email-group input").addClass("is-invalid");
                    $("#email-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.email + "</small></div>"
                    );
                }
                if (data.errors.password) {
                    $("#password-group input").addClass("is-invalid");
                    $("#password-group").append(
                        '<div class="text-danger erroraka"> <small>' + data.errors.password + "</small></div>"
                    );
                }
                
                $("#modal-login-fail").modal("show");
                
            } else {
                // clean the form
                $('#login-form')[0].reset();
                window.location = 'index.php';
            }
        }).fail(function (data, textStatus, errorThrown) {
            $("form").html(
              '<div class="alert alert-danger">Could not reach server, please try again later. </div>'
              + data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
            );
          });

        event.preventDefault();
    });
});



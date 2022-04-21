$(document).ready(function () {
    $("#signup-form").submit(function (event) {
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        var formData = {
            firstName: $("#firstName").val(),
            lastName: $("#lastName").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            confirmPassword: $("#confirmPassword").val(),
            telephone: $("#telephone").val()
        };

        $.ajax({
                type: "POST",
                url: "signupFormProcessAd.php",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                if (!data.success) {
                    if (data.errors.firstName) {
                        $("#firstName-group input").addClass("is-invalid");
                        $("#firstName-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.firstName + "</small></div>"
                        );
                    }

                    if (data.errors.lastName) {
                        $("#lastName-group input").addClass("is-invalid");
                        $("#lastName-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.lastName + "</small></div>"
                        );
                    }

                    if (data.errors.email) {
                        $("#email-group input").addClass("is-invalid");
                        $("#email-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.email + "</small></div>"
                        );
                    }

                    if (data.errors.password) {
                        var $window = $(window);
                        var windowsize = $window.width();
                        $(".password-group input").addClass("is-invalid");
                        if (windowsize > 750) {
                            $("#password-group-id").append(
                                '<div class="text-danger erroraka"> <small>' + data.errors.password + "</small></div>"
                            );
                        } else {
                            $("#confirmPassword-group-id").append(
                                '<div class="text-danger erroraka"> <small>' + data.errors.password + "</small></div>"
                            );
                        }
                    }

                    if (data.errors.telephone) {
                        $("#telephone-group input").addClass("is-invalid");
                        $("#telephone-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.telephone + "</small></div>"
                        );
                    }
                } else {
                    // clean the form
                    $('#signup-form')[0].reset();
                    $("#modal-signup-success").modal("show");
                }
            })
            .fail(function (data, textStatus, errorThrown) {
                $("#signup-form").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later. </div>' +
                    data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
                );

            });

        event.preventDefault();

    });
});

function showHidePassw() {
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmPassword");
    if (password.type === "password") {
        password.type = 'text';
        confirmPassword.type = 'text';
    } else {
        password.type = 'password';
        confirmPassword.type = 'password';
    }
}
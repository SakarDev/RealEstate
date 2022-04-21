$(document).ready(function () {

    //on change of the city select box update (town and street) select boxes
    $('#city').on('change', function () {
        //update the town select box 
        var cityID = $(this).val();
        if (cityID) {
            $.ajax({
                type: 'POST',
                url: 'addPropertyUpdateTown.php',
                data: 'city_id=' + cityID
            }).done(function (data) {
                $('#town').html(data);
            });
        } else {
            $('#town').html('<option value="">Select city first</option>');
        }

        //update the street select box 
        if (cityID) {
            $.ajax({
                type: 'POST',
                url: 'addPropertyUpdateStreet.php',
                data: 'city_id=' + cityID
            }).done(function (data) {
                $('#street').html(data);
            });
        } else {
            $('#street').html('<option value="">Select city first</option>');
        }
    });


    //when user wants to publish the property
    $("#addProperty-form").submit(function (event) {
        event.preventDefault();

        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();
        $(".beErroraka").remove();

        $.ajax({
                type: "POST",
                url: "addPropertyFormProcess.php",
                data: new FormData($("#addProperty-form")[0]),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                if (!data.success) {
                    if (data.errors.property_title) {
                        $("#property_title-group input").addClass("is-invalid");
                        $("#property_title-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.property_title + "</small></div>"
                        );
                    }

                    if (data.errors.property_title) {
                        $("#property_type-group input").addClass("is-invalid");
                        $("#property_type-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.property_type + "</small></div>"
                        );
                    }

                    if (data.errors.transaction_type) {
                        $("#transaction_type-group input").addClass("is-invalid");
                        $("#transaction_type-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.transaction_type + "</small></div>"
                        );
                    }

                    if (data.errors.city) {
                        $("#city-group input").addClass("is-invalid");
                        $("#city-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.city + "</small></div>"
                        );
                    }

                    if (data.errors.town) {
                        $("#town-group input").addClass("is-invalid");
                        $("#town-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.town + "</small></div>"
                        );
                    }

                    if (data.errors.street) {
                        $("#street-group input").addClass("is-invalid");
                        $("#street-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.street + "</small></div>"
                        );
                    }

                    if (data.errors.price) {
                        $("#price-group input").addClass("is-invalid");
                        $("#price-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.price + "</small></div>"
                        );
                    }

                    if (data.errors.no_bedrooms) {
                        $("#no_bedrooms-group input").addClass("is-invalid");
                        $("#no_bedrooms-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.no_bedrooms + "</small></div>"
                        );
                    }

                    if (data.errors.no_bathrooms) {
                        $("#no_bathrooms-group input").addClass("is-invalid");
                        $("#no_bathrooms-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.no_bathrooms + "</small></div>"
                        );
                    }

                    if (data.errors.no_garages) {
                        $("#no_garages-group input").addClass("is-invalid");
                        $("#no_garages-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.no_garages + "</small></div>"
                        );
                    }

                    if (data.errors.no_floors) {
                        $("#no_floors-group input").addClass("is-invalid");
                        $("#no_floors-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.no_floors + "</small></div>"
                        );
                    }

                    if (data.errors.area) {
                        $("#area-group input").addClass("is-invalid");
                        $("#area-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.area + "</small></div>"
                        );
                    }

                    if (data.errors.telephone) {
                        $("#telephone-group input").addClass("is-invalid");
                        $("#telephone-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.telephone + "</small></div>"
                        );
                    }

                    if (data.errors.property_image) {
                        $("#property_image-group input").addClass("is-invalid");
                        $("#property_image-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.property_image + "</small></div>"
                        );
                    }

                    if (data.errors.description) {
                        $("#description-group input").addClass("is-invalid");
                        $("#description-group").append(
                            '<div class="text-danger erroraka"> <small>' + data.errors.description + "</small></div>"
                        );
                    }

                } else {

                    // clean the form
                    $('#addProperty-form')[0].reset();
                    // show successfully added property modal
                    $("#success_addPropertyType .modal-header").append(
                        '<h5 class="modal-title beErroraka" id="exampleModalLabel">' + "Succcesful" + '</h5>'
                    );
                    $("#success_addPropertyType .modal-body").append(
                        '<p class="beErroraka">' + "Property published successfuly." + '</p>'
                    );
                    $("#success_addPropertyType").modal("show");

                }
            })
            .fail(function (data, textStatus, errorThrown) {
                $("#addProperty-form").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later. </div>' +
                    data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
                );
            });

        event.preventDefault();

    });
});

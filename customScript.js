$(document).ready(function () {

    // handle the navigation background on scroll
    window.addEventListener('scroll', function () {
        let nav = document.querySelector('nav');
        if (!$(nav).hasClass('opened-withClick')) {
            windowPos = window.scrollY > 0;
            let nav = document.querySelector('nav');
            nav.classList.toggle('scrolling-active', windowPos);
        }
    });

    // handle the navigation background on scroll
    if (window.scrollY == 0 && $(window).width() < 768) {
        document.querySelector('#humbergur-btn').addEventListener('click', function () {
            let nav = document.querySelector('nav');
            if (!$(nav).hasClass('opened-withClick')) {
                nav.classList.add('opened-withClick');
            } else {
                nav.classList.remove('opened-withClick');
            }
        });
    }


    //handle social icons style which are at the left side of the screen 
    $('.social-icons li').click(function () {
        $(this).toggleClass("shadow");
        $(this).toggleClass("fill-color");
    });


    //load all posts when for the first time the page loads
    $.ajax({
        type: "GET",
        url: "indexFetch.php",
        data: {
            getAllData: 1
        }
    }).done(function (data) {
        // append the cards to rows div
        $('.rows').append(data);
    })
    .fail(function (data, textStatus, errorThrown) {
        $(".rows").html(
            '<div class="alert alert-danger">Could not reach server, please try again later. </div>' +
            data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
        );
    });


    //------------------------------------------------search-START------------------------------------------------

    //handle the property search button
    searchHandler();
    $(window).resize(function () {
        searchHandler();
    });

    function searchHandler() {
        if ($(window).width() < 768) {
            // add attributes to the search button for the small screen size that it's target is to open is modal_search
            $('#search-bg button').attr('data-bs-toggle', 'modal');
            $('#search-bg button').attr('data-bs-target', '#modal_search');
            $('#search-bg button').attr('type', '');
        } else {
            // when screen size gets bigger remove modal attributes because we don't need modal
            $('#search-bg button').attr('data-bs-toggle', '');
            $('#search-bg button').attr('data-bs-target', '');
            $('#search-bg button').attr('type', 'submit');
        }
    }

    //update the street select box in the search based on city select box
    $('#city').on('change', function () {
        var cityID = $(this).val();
        if (cityID) {
            $.ajax({
                type: 'POST',
                url: 'indexUpdateStreet.php',
                data: 'city_id=' + cityID
            }).done(function (data) {
                $('#street').html(data);
            });
        }
    });
    //update the street_modal select box in the search based on city select box
    $('#city_modal').on('change', function () {
        var cityID = $(this).val();
        if (cityID) {
            $.ajax({
                type: 'POST',
                url: 'indexUpdateStreet.php',
                data: {
                    city_id: cityID,
                    isModal: 1
                }
            }).done(function (data) {
                $('#street_modal').html(data);
            });
        }
    });


    // retreive the searched data
    $("#search-form").submit(function (event) {
        // retreive the searched data
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();

        var formData = {
            transaction_type: $("#transaction_type").val(),
            property_type: $("#property_type").val(),
            city: $("#city").val(),
            street: $("#street").val(),
            getSearchedData: 1
        };

        $.ajax({
                type: "POST",
                url: "indexFetch.php",
                data: formData
            }).done(function (data) {
                $('.rows').html(data);
            })
            .fail(function (data, textStatus, errorThrown) {
                $("#search-form").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later. </div>' +
                    data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
                );
            });

        event.preventDefault();
    });

    // retreive the searched data
    $("#searchModal-form").submit(function (event) {
        // retreive the searched data
        $(".form-group input").removeClass("is-invalid");
        $(".erroraka").remove();

        var formData = {
            transaction_type: $("#transaction_type_modal").val(),
            property_type: $("#property_type_modal").val(),
            city: $("#city_modal").val(),
            street: $("#street_modal").val(),
            getSearchedData: 1
        };

        $.ajax({
                type: "POST",
                url: "indexFetch.php",
                data: formData
            }).done(function (data) {
                $('.rows').html(data);
                $('#searchModal-form')[0].reset();
                $('#modal_search').modal('hide');
            })
            .fail(function (data, textStatus, errorThrown) {
                $("#search-form").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later. </div>' +
                    data + 'textStatus: ' + textStatus + '<br> errorThrown: ' + errorThrown
                );
            });

        event.preventDefault();
    });

    //------------------------------------------------search-END------------------------------------------------


});
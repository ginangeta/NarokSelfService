(function ($) {
    "use strict";
    // preloader
    var loader = function () {
        setTimeout(function () {
            if ($('.preloader').length > 0) {
                $('.preloader').removeClass('show');
            }
        }, 1);
    };
    loader();
    // sticky
    $(window).scroll(function () {
        if ($(this).scrollTop() > 110) {
            $('header').addClass('fixed-top');
        } else {
            $('header').removeClass('fixed-top');
        }
    });
    // navigation-active-link
    $('nav ul li:first-child').addClass('active');
    // smooth-scrolling
    var scrollLink = $('nav ul li a, .slider-btn .btn');
    scrollLink.click(function (e) {
        e.preventDefault();
        $('body,html').animate({
            scrollTop: $(this.hash).offset().top - 110
        }, 500);
    });
    // active-link-switching
    $(window).scroll(function () {
        var scrollbarLocation = $(this).scrollTop();
        scrollLink.each(function () {
            var sectionOffset = $(this.hash).offset().top - 111;
            if (sectionOffset <= scrollbarLocation) {
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
            }
        })
    });
    // slicknav
    $('nav > ul').slicknav({
        label: '',
        prependTo: '.mobile-menu',
        closeOnClick: true
    });
    // offcanvas
    $('.offcanvas-bars').on('click', function () {
        $('.offcanvas, .offcanvas-overlay').addClass('show');
        return false;
    });
    $('.offcanvas-times, .offcanvas-overlay').on('click', function () {
        $('.offcanvas, .offcanvas-overlay').removeClass('show');
        return false;
    });
    // data-background
    $('[data-background]').each(function () {
        $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')')
    });


    /*___________________________________
        Index Navigation Code
    ___________________________________*/

    // selecting a service
    $('body').on('click', '.all-service-option', function () {
        var service = $(this).attr("class");
        $('#all-service-option').removeClass('right-neg-100');
        $('#all-service-option').siblings().addClass('right-neg-100');
        $('.landing-page-container').addClass('margin-neg-400-left');
        $('.aside-footer').addClass('right-neg-100');
        $('.sub-streams').children('aside').addClass('right-neg-100');
        $('.aside-summary').children('aside').addClass('right-neg-100');
    });

    $('body').on('click', '.the-service', function () {
        var service = $(this).parent().attr("class");
        serviceNav(service);
    });

    $('body').on('click', '.sub-streams-services li', function () {
        var subservice = $(this).attr("class");
        $("." + subservice).children("the-border-menu").addClass('selected');
        serviceNav(subservice);
    });

    $('body').on('click', '.service-option-select-picker', function () {
        var subservice = $(this).find('button').find('.filter-option-inner-inner').find('span').attr("class");
        serviceNav(subservice);
    });

    function serviceNav(service) {
        $('#' + service).removeClass('right-neg-100');
        $('#' + service).siblings().addClass('right-neg-100');
        $('.landing-page-container').addClass('margin-neg-400-left');
        $('.aside-footer').removeClass('right-neg-100');
        $('.sub-streams').children('aside').addClass('right-neg-100');
        $('.aside-summary').children('aside').addClass('right-neg-100');
    }


    // aside code
    $('body').on('click', '.close-aside', function () {
        $(this).parent().parent().parent().addClass('right-neg-100');
        $('.landing-page-container').removeClass('margin-neg-400-left');
        $('.aside-footer').addClass('right-neg-100');
    });

    $('body').on('click', '.close-sub-aside', function () {
        $(this).parent().parent().parent().addClass('right-neg-100');
        $('.aside-footer-confirm').addClass('right-neg-100');
        $('.aside-footer-to-confirm').addClass('right-neg-100');
        $('.aside-footer').removeClass('right-neg-100');
    });

    $('body').on('click', '.close-confirm-aside', function () {
        $(this).parent().parent().parent().addClass('right-neg-100');
        $('.aside-footer-confirm').addClass('right-neg-100');
        $('.aside-footer-to-confirm').removeClass('right-neg-100');

    });

    // selecting a daily parking
    $('body').on('click', '.sub-streams li', function () {
        var subservice = $(this).attr("class");
        $('#' + subservice).removeClass('right-neg-100');
        $('.landing-page-container').addClass('margin-neg-400-left');
        $('.aside-footer').addClass('right-neg-100');
        $('.aside-footer-confirm').addClass('right-neg-100');
        $('.aside-footer-to-confirm').removeClass('right-neg-100');

    });


    // Confirm Bill Details
    $('body').on('click', '.the-aside-inputs .btn-process', function () {
        var confirmservice = $(this).parent().attr("class");
        $('#' + confirmservice).removeClass('right-neg-100');
        $('.landing-page-container').addClass('margin-neg-400-left');
        $('.aside-footer').addClass('right-neg-100');
        $('.aside-footer-confirm').removeClass('right-neg-100');
        $('.aside-footer-to-confirm').addClass('right-neg-100');

    });

    // selecting parking details
    $('body').on('click', '.aside-footer-to-confirm .btn-process', function () {
        // var confirmservice = $(this).parent().parent().attr("class");
        // $('#' + confirmservice).removeClass('right-neg-100');
        // $('.landing-page-container').addClass('margin-neg-400-left');
        // $('.aside-footer').addClass('right-neg-100');
        // $('.aside-footer-confirm').removeClass('right-neg-100');
        // $('.aside-footer-to-confirm').addClass('right-neg-100');

    });


    $('body').on('click', '.btn-pay-now', function () {
        // alert("clicked");
        $('.aside-footer-confirm').removeClass('d-none');
    });

    $('body').on('click', '.btn-modal-pay', function () {
        closeOnEscape: false;
        $('#payment-modal .modal-header button').addClass('d-none');
        setTimeout(function () {

        }, 5000);

        $('.timer-loader').removeClass('d-none').siblings().addClass('d-none');
        var timeleft = 49;
        var downloadTimer = setInterval(function () {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                // alert("zero reached");
                $(".timer-loader strong").text("50 s")
                $(".timer-loader").addClass('d-none').siblings().removeClass('d-none');
                $(".timer-loader").addClass('d-none').siblings().children();
                $(".timer-loader strong").siblings().children().html('<i class="mdi mdi-refresh mr-2"></i> Retry');;
            }

            $(".timer-loader strong").text(timeleft + " S");
            timeleft -= 1;
        }, 1000);
    });

    $('body').on('click', '.btn-seasonal-add-car', function () {
        var plate = $('#numberPlate').val();
        var container = $('.cars-container');
        if (plate == null || plate == "") {} else {
            container.append(`<span class="font-12 cars-add">
                         <span class="number-plate" id="">` + plate + `</span>
                        <i class="remove-car font-14 ti-close ml-2" title="Remove Car"></i>
                        </span>`);
            $('#numberPlate').val('');
        }

    });

    $('body').on('click', '.remove-car', function () {
        $(this).parent().remove();
    });

    /*___________________________________
        Index Navigation Code
    ___________________________________*/


    /*___________________________________
        Trade Modal Navigation Code
    ___________________________________*/

    $('#trade-license-application .slider-container').each(function (key, value) {
        if (key == 0) {
            $('.modal-nav').append(`<button type="button" class="modal-dots active"></button>`);
        } else {
            $('.modal-nav').append(`<button type="button" class="modal-dots"></button>`);
        }
    });

    $('#trade-license-application .slider-container .modal-nav:first-child').addClass('active');

    $('#trade-license-application .slider-container .modal-dots').on('click', function () {
        var DotIndex = $(this).index();
        $('#trade-license-application .slider-container').eq(DotIndex).removeClass('d-none').siblings().addClass('d-none');
        $('#trade-license-application .slider-container').eq(DotIndex).find('.modal-dots').eq(DotIndex).addClass('active').siblings().removeClass("active");

    });

    $('body').on('click', '.btn-next', function () {
        var Slider = $(this).parent().parent().parent().parent();
        var theParentIndex = Slider.index();
        var theLastIndex = $(".slider-container:last-child").index();
        $(Slider).next().find('.modal-dots').each(function () {
            var valueIndex = $(this).index();
            if (valueIndex == theParentIndex + 1) {
                $(this).addClass('active').siblings().removeClass('active');
                return false;
            }
        });
        if (theParentIndex != theLastIndex) {
            $(Slider).addClass('d-none').next().removeClass('d-none');
        }
    });

    $('body').on('click', '.btn-previous', function () {
        var Slider = $(this).parent().parent().parent().parent();
        var theParentIndex = Slider.index();
        var theFirstIndex = $(".slider-container:first-child").index()
        $(Slider).prev().find('.modal-dots').each(function () {
            var valueIndex = $(this).index();
            if (valueIndex == theParentIndex - 1) {
                $(this).addClass('active').siblings().removeClass('active');
                return false;
            }
        });

        if (theParentIndex != theFirstIndex) {
            $(Slider).addClass('d-none').prev().removeClass('d-none');
        }
    });
    /*___________________________________
        Trade Modal Navigation Code
    ___________________________________*/


    // slider-carousel
    $('.slider-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    // magnificPopup
    $('.popup-video').magnificPopup({
        type: 'iframe'
    });
    // wow
    new WOW().init();
    // magnificPopup
    $('.popup-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    // Isotope
    $('.portfolio-filter li:first-child').addClass('active');
    // init Isotope
    var $grid = $('.portfolio-list').imagesLoaded(function () {
        // init Isotope after all images have loaded
        $grid.isotope({
            // options...
            itemSelector: '.col-lg-4',
            percentPosition: true,
            masonry: {
                // use element for option
                columnWidth: '.col-lg-4'
            }
        });
        // filter items on button click
        $('.portfolio-filter').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
            $('li').removeClass('active');
            $(this).addClass('active');
        });
    });
    // parallax
    $('.cta').parallax("50%", 0.4);
    // counterUp
    $('.single-counter span').counterUp({
        delay: 10,
        time: 1000
    });
    // testimonials-carousel
    $('.testimonials-carousel').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    // scrollUp
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 300, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationSpeed: 200, // Animation speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
        scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
        scrollText: '<i class="far fa-chevron-up"></i>', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required.
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
    });

    // snazzy-maps
    // // When the window has finished loading create our google map below
    // google.maps.event.addDomListener(window, 'load', init);

    // function init() {
    //     // Basic options for a simple Google Map
    //     // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    //     var mapOptions = {
    //         // How zoomed in you want the map to start at (always required)
    //         zoom: 11,

    //         // The latitude and longitude to center the map (always required)
    //         center: new google.maps.LatLng(40.6700, -73.9400), // New York

    //         // How you would like to style the map. 
    //         // This is where you would paste any style found on Snazzy Maps.
    //         styles: [{
    //             "featureType": "water",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#e9e9e9"
    //             }, {
    //                 "lightness": 17
    //             }]
    //         }, {
    //             "featureType": "landscape",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#f5f5f5"
    //             }, {
    //                 "lightness": 20
    //             }]
    //         }, {
    //             "featureType": "road.highway",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "color": "#ffffff"
    //             }, {
    //                 "lightness": 17
    //             }]
    //         }, {
    //             "featureType": "road.highway",
    //             "elementType": "geometry.stroke",
    //             "stylers": [{
    //                 "color": "#ffffff"
    //             }, {
    //                 "lightness": 29
    //             }, {
    //                 "weight": 0.2
    //             }]
    //         }, {
    //             "featureType": "road.arterial",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#ffffff"
    //             }, {
    //                 "lightness": 18
    //             }]
    //         }, {
    //             "featureType": "road.local",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#ffffff"
    //             }, {
    //                 "lightness": 16
    //             }]
    //         }, {
    //             "featureType": "poi",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#f5f5f5"
    //             }, {
    //                 "lightness": 21
    //             }]
    //         }, {
    //             "featureType": "poi.park",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#dedede"
    //             }, {
    //                 "lightness": 21
    //             }]
    //         }, {
    //             "elementType": "labels.text.stroke",
    //             "stylers": [{
    //                 "visibility": "on"
    //             }, {
    //                 "color": "#ffffff"
    //             }, {
    //                 "lightness": 16
    //             }]
    //         }, {
    //             "elementType": "labels.text.fill",
    //             "stylers": [{
    //                 "saturation": 36
    //             }, {
    //                 "color": "#333333"
    //             }, {
    //                 "lightness": 40
    //             }]
    //         }, {
    //             "elementType": "labels.icon",
    //             "stylers": [{
    //                 "visibility": "off"
    //             }]
    //         }, {
    //             "featureType": "transit",
    //             "elementType": "geometry",
    //             "stylers": [{
    //                 "color": "#f2f2f2"
    //             }, {
    //                 "lightness": 19
    //             }]
    //         }, {
    //             "featureType": "administrative",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "color": "#fefefe"
    //             }, {
    //                 "lightness": 20
    //             }]
    //         }, {
    //             "featureType": "administrative",
    //             "elementType": "geometry.stroke",
    //             "stylers": [{
    //                 "color": "#fefefe"
    //             }, {
    //                 "lightness": 17
    //             }, {
    //                 "weight": 1.2
    //             }]
    //         }]
    //     };

    //     // Get the HTML DOM element that will contain your map 
    //     // We are using a div with id="map" seen below in the <body>
    //     var mapElement = document.getElementById('map');

    //     // Create the Google Map using our element and options defined above
    //     var map = new google.maps.Map(mapElement, mapOptions);

    //     // Let's also add a marker while we're at it
    //     var marker = new google.maps.Marker({
    //         position: new google.maps.LatLng(40.6700, -73.9400),
    //         map: map,
    //         title: 'Snazzy!'
    //     });
    // };

    //select picker
    $('select').selectpicker();
}(jQuery));

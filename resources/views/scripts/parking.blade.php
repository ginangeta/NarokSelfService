{{-- Daily Parking --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".daily_parking").on('click', function() {
            $('#daily_parking .slider').removeClass('d-none')
            $.ajax({
                url: "<?php echo url('daily-parking'); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#daily_parking .slider').addClass('d-none')

                    // console.log(response);

                    $('#zone').removeClass('d-none');
                    $('#car_type').removeClass('d-none');
                    $('#zone').empty();
                    $('#car_type').empty();
                    $('#zone').selectpicker('refresh');
                    $('#car_type').selectpicker('refresh');

                    // console.log(response.data);

                    $.each(response.zones, function(i, item) {
                        $('#zone').append($('<option>', {
                            value: item.zone_type_id,
                            text: item.description
                        }));
                        // console.log(item);

                    });

                    $.each(response.vehicle_categories, function(i, item) {
                        if (item.is_daily !== false) {
                            $('#car_type').append($('<option>', {
                                value: item.id,
                                text: item.description
                            }));
                        }
                        // console.log(item);

                    });

                    $('#zone').selectpicker('refresh');
                    $('#car_type').selectpicker('refresh');
                }
            });
        });

        $("#number-plate, #car_type, #zone").on("change paste keyup", function() {
            var daily_vehicle_category_code = $("select[name=daily_vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var zone_code = $("select[name=zone_code]").val();

            var duration_code = 1;

            if (daily_vehicle_category_code == "" || zone_code == "" || registration_number == "") {
                return;
            }


            $.ajax({
                url: "<?php echo url('get-parking-charges'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    duration_code: duration_code,
                    daily_vehicle_category_code: daily_vehicle_category_code,
                    zone_code: zone_code,
                    registration_number: registration_number
                },

                success: function(data) {
                    // console.log(data);
                    if (data.status_code === 200) {
                        document.getElementById('pay-price').innerHTML = data.response_data
                            .balance;
                        $('#price').removeClass('d-none');
                    }
                }
            });
        });

        $(".btn-confirm-daily-details").click(function(e) {
            e.preventDefault();

            var daily_vehicle_category_code = $("select[name=daily_vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var phone_number = $("input[name=phone_number]").val();
            var zone_code = $("select[name=zone_code]").val();
            var duration_code = 1;

            if (daily_vehicle_category_code == "" || zone_code == "" || registration_number == "" ||
                phone_number == "") {
                document.getElementById('parking_errors').innerHTML =
                    "Kindly supply all information before proceeding.";
                $('#parking_errors').removeClass('d-none');
            } else {
                $('.btn-confirm-daily-details').text('Checking details...');
                $('.daily-parking-confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('get-parking-charges'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        duration_code: duration_code,
                        daily_vehicle_category_code: daily_vehicle_category_code,
                        zone_code: zone_code,
                        registration_number: registration_number,
                        phone_number: phone_number
                    },

                    success: function(data) {
                        // console.log(data)

                        $('.daily-parking-confirm .lds-ellipsis').addClass('d-none');
                        $('.btn-confirm-daily-details').text('CHECK STATUS');

                        if (data == "") {
                            document.getElementById('errors').innerHTML =
                                'We are having trouble retrieving your parking charges. Please try again later.';
                            $('#errors').removeClass('d-none');
                            $('.btn-confirm-daily-details').removeClass('d-none');
                            $('.daily-parking-confirm .lds-ellipsis').addClass('d-none');
                            return;
                        }

                        if (data.status_code == 200) {
                            var parking_zone = $("#zone option:selected").text();
                            var vehicle_type = $("#car_type option:selected").text();
                            var number_plate = $(
                                "input[name=offstreet_registration_number]").val();
                            var phone_number = $("#mpesa-phone").val();

                            document.getElementById("parking_zone").innerHTML =
                                parking_zone;
                            document.getElementById("vehicle_type").innerHTML =
                                vehicle_type;
                            document.getElementById("number_plate").innerHTML =
                                number_plate;
                            document.getElementById("daily_parking_amount").value = data
                                .response_data
                                .balance;
                            $('#daily_parking_pay .btn-text').html('PAY KES ' + data
                                .response_data
                                .balance);
                            document.getElementById("charges_cost").innerHTML = "KES " +
                                data
                                .response_data
                                .total_cost;
                            document.getElementById("charges_paid").innerHTML = "KES " +
                                data
                                .response_data
                                .total_paid;
                            document.getElementById("charges").innerHTML = "KES " + data
                                .response_data.balance;

                            var confirmservice = $('.btn-confirm-daily-details').parent()
                                .parent().attr("class");
                            $('#' + confirmservice).removeClass('right-neg-100');
                            $('.landing-page-container').addClass('margin-neg-400-left');
                            $('.aside-footer').addClass('right-neg-100');
                            $('#' + confirmservice + ' .aside-footer-confirm').removeClass(
                                'right-neg-100');
                            $('.aside-footer-to-confirm').addClass(
                                'right-neg-100');

                        } else {
                            document.getElementById('errors').innerHTML = data.message;
                            $('#errors').removeClass('d-none');
                        }
                    }
                });
            }
        });

        $('#payment-modal .modal-header button').on('click', function() {
            $('#daily_parking_pay').find('.btn-txt').removeClass('d-none');
            $('#daily_parking_pay').find('.btn-ellipsis').addClass('d-none');
        });

        $("#daily_parking_pay").click(function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var daily_vehicle_category_code = $("select[name=daily_vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var zone_code = $("select[name=zone_code]").val();
            var phone_number = $("input[name=phone]").val();
            var amount = $("input[name=amount]").val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(phone_number);

            if (regex.test(phone_number) == false) {
                document.getElementById('errors').innerHTML = 'Please enter a valid Safaricom number';
                $('#errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal-header').text("Daily Parking Payment");
            $('#payment-modal .modal-title-sub').text('Daily Parking');
            $('#payment-modal .payment-plate').text(registration_number);
            $('#payment-modal .payment-zone').text(" at " + $("#parking_zone").html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');
        });

    });
</script>
{{-- Daily Parking --}}

{{-- Seasonal Parking --}}
<script type="text/javascript">
    $(document).ready(function() {
        var seasonalBillNo;

        $(".seasonal_parking").on('click', function() {
            $('#seasonal_parking .slider').removeClass('d-none')
            $.ajax({
                url: "<?php echo url('seasonal-parking'); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#seasonal_parking .slider').addClass('d-none')

                    // console.log(response);

                    $('#seasonal_parking_duration').removeClass('d-none');
                    $('#seasonal_vehicle_type').removeClass('d-none');
                    $('#seasonal_parking_duration').empty();
                    $('#seasonal_vehicle_type').empty();
                    $('#seasonal_parking_duration').selectpicker('refresh');
                    $('#seasonal_vehicle_type').selectpicker('refresh');

                    // console.log(response.data);

                    $.each(response.durations, function(i, item) {
                        if (item.description !== 'Daily') {
                            $('#seasonal_parking_duration').append($('<option>', {
                                value: item.id,
                                text: item.description
                            }));
                            // console.log(item);
                        }
                    });

                    $.each(response.vehicle_categories, function(i, item) {
                        $('#seasonal_vehicle_type').append($('<option>', {
                            value: item.id,
                            text: item.description
                        }));
                        // console.log(item);
                    });

                    if (response.vehicles === null || response.vehicles === 0) {
                        $('.seasonal-parking-confirm').addClass('d-none');

                    } else {
                        $('.cars-container').empty();

                        $.each(response.vehicles.response_data.parking_entries, function(i,
                            item) {
                            // console.log(item);
                            var plate = item.number_plate;
                            var plate_id = item.id;
                            var container = $('.cars-container');
                            if (plate != null || plate != "") {
                                container.append(`<span class="font-12 cars-add">
                         <span class="number-plate" id="` + plate_id + `">` + plate + `</span>
                        <i class="remove-car font-14 ti-close ml-2" title="Remove Car"></i>
                        </span>`);
                            }
                            // console.log(item);
                        });
                    }


                    $('#seasonal_parking_duration').selectpicker('refresh');
                    $('#seasonal_vehicle_type').selectpicker('refresh');
                }
            });
        });

        $("#seasonal_vehicle_type,#seasonal_parking_duration").on("change paste keyup", function() {
            var seasonal_vehicle_category_code = $("select[name=seasonal_vehicle_category_code]").val();
            var duration_code = $("select[name=seasonal_duration_code]").val();

            if (seasonal_vehicle_category_code == "" || duration_code == "") {
                return;
            }

            $.ajax({

                url: "<?php echo url('get-parking-charges'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    seasonal_vehicle_category_code: seasonal_vehicle_category_code,
                    duration_code: duration_code
                },

                success: function(data) {
                    // console.log(data);
                    if (data.status_code == 200) {
                        // console.log(data);
                        document.getElementById('seasonal-pay-price').innerHTML = data
                            .response_data
                            .charges[0].amount.toLocaleString();
                        $('#seasonal-price').removeClass('d-none');
                        $('#seasonal-rates').addClass('d-none');
                    } else {
                        $('#seasonal-rates').removeClass('d-none');
                        $('#seasonal-price').addClass('d-none');
                    }

                }
            });
        });

        $("#add_vehicle").click(function(e) {

            e.preventDefault();

            var seasonal_registration_no = $("input[name=seasonal_registration_no]").val();

            var seasonal_duration_code = $("select[name=seasonal_duration_code]").val();

            var seasonal_vehicle_category_code = $("select[name=seasonal_vehicle_category_code] ")
                .val();

            var phone_number = "";

            var duration = $("select[name=seasonal_duration_code] option:selected").text();

            var vehicle_type = $("select[name=seasonal_vehicle_category_code] option:selected").text();

            var amount = $('#seasonal-pay-price').text();


            if (seasonal_registration_no == "") {
                $('#seasonal_registration_no').addClass('border-danger');
                return;
            }

            if (seasonal_vehicle_category_code == "") {
                $('#seasonal_vehicle_type').addClass('border-danger');
                return;
            }
            if (seasonal_duration_code == "") {
                $('#seasonal_parking_duration').addClass('border-danger');
                return;
            }

            $('#seasonal_parking .slider').removeClass('d-none');
            $.ajax({

                url: "<?php echo url('add-seasonal-vehicle'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    seasonal_registration_no: seasonal_registration_no,
                    seasonal_duration_code: seasonal_duration_code,
                    seasonal_vehicle_category_code: seasonal_vehicle_category_code,
                    phone_number: phone_number,
                    amount: amount,
                    vehicle_type: vehicle_type,
                    duration: duration
                },

                success: function(data) {
                    // console.log(data);
                    $('#seasonal_parking .slider').addClass('d-none');

                    if (data == "") {
                        document.getElementById('errors').innerHTML =
                            'Your session has expired. Please log in again to continue.';
                        $('#errors').removeClass('d-none');
                    }

                    if (data.newVehicle.status_code == 200) {
                        // console.log(data);
                        $('.cars-container').empty();
                        var container = $('.cars-container');
                        var seasonalVehicles = data.newVehicleDetails.response_data
                            .parking_entries;
                        // console.log(seasonalVehicles);

                        $.each(seasonalVehicles, function(i,
                            item) {
                            // console.log(item);

                            var plate = item.number_plate;
                            var plate_id = item.id;
                            if (plate != null || plate != "") {
                                container.append(`<span class="font-12 cars-add">
                         <span class="number-plate" id="` + plate_id + `">` + plate + `</span>
                        <i class="remove-car font-14 ti-close ml-2" title="Remove Car"></i>
                        </span>`);
                            }
                        });
                        // window.location = "seasonal-parking";


                    } else {
                        document.getElementById('errors').innerHTML = data.newVehicle
                            .message;
                        $('#errors').removeClass('d-none');

                    }


                }
            });
        });

        $('.cars-container').on('click', '.remove-car', function() {
            $('#remove-vehicle-modal').modal('show');

            var title = "lamba;";
            var title = $(this).siblings().text();
            var code = $(this).siblings().attr('id');
            $('#p-code').text(code);
            $('#record-name').text(title);

            // console.log(title);
            // console.log(code);
        });

        $("#remove-entry").click(function(e) {
            e.preventDefault();

            $('#seasonal_parking .slider').removeClass('d-none');
            var parking_code = $('#p-code').text();

            $('#remove-vehicle-modal').modal('hide');
            // console.log(parking_code);
            $.ajax({

                url: "<?php echo url('remove-seasonal-vehicle'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    parking_code: parking_code
                },

                success: function(data) {
                    // console.log(data);

                    $('#seasonal_parking .slider').addClass('d-none');

                    if (data.removedVehicle.status_code == 200) {
                        // console.log(data);
                        $('.cars-container').empty();
                        var container = $('.cars-container');
                        var seasonalVehicles = data.removedVehicleDetails.response_data
                            .parking_entries;
                        // console.log(seasonalVehicles);

                        $.each(seasonalVehicles, function(i,
                            item) {
                            // console.log(item);

                            var plate = item.number_plate;
                            var plate_id = item.id;
                            if (plate != null || plate != "") {
                                container.append(`<span class="font-12 cars-add">
                         <span class="number-plate" id="` + plate_id + `">` + plate + `</span>
                        <i class="remove-car font-14 ti-close ml-2" title="Remove Car"></i>
                        </span>`);
                            }
                        });
                        // window.location = "seasonal-parking";
                    } else {
                        document.getElementById('errors').innerHTML = data.removedVehicle
                            .message;
                        $('#errors').removeClass('d-none');

                    }
                }
            });
        });

        $(".btn-confirm-seasonal-details").click(function(e) {
            e.preventDefault();

            $('.btn-confirm-seasonal-details').text('Checking details...');
            $('.seasonal-parking-confirm .lds-ellipsis').removeClass('d-none');

            $.ajax({
                url: "<?php echo url('seasonal-parking'); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('.seasonal-parking-confirm .lds-ellipsis').addClass('d-none');
                    $('.btn-confirm-seasonal-details').text('CHECK STATUS');

                    data = data.vehicles;

                    // console.log(data);

                    if (data == "") {
                        document.getElementById('seasonal_parking_errors').innerHTML =
                            'We are having trouble retrieving your parking charges. Please try again later.';
                        $('#seasonal_parking_errors').removeClass('d-none');
                        $('.btn-confirm-seasonal-details').removeClass('d-none');
                        $('.seasonal-parking-confirm .lds-ellipsis').addClass(
                            'd-none');
                        return;
                    }

                    if (data.status_code == 200) {

                        // console.log(data)
                        $('.seasonal-parking-container').empty();
                        var container = $('.seasonal-parking-container');

                        var seasonalData = data.response_data;

                        $('#seasonal_penalties').html('KES 0');
                        $('#seasonal_charges').html("KES " + seasonalData.balance);
                        $('#seasonal_paid').html("KES " + seasonalData.total_paid);
                        $('#seasonal_total').html("KES " + seasonalData.total_cost);
                        $('#seasonal_vehicle_count').html("Vehicles (" + seasonalData
                            .entries_count + ")");

                        $('#seasonal_parking_pay .btn-text').html("PAY KES " + seasonalData
                            .total_cost);

                        var seasonalVehicles = seasonalData.parking_entries;
                        $.each(seasonalVehicles, function(i,
                            item) {
                            // console.log(item);

                            var plate = item.number_plate;
                            var plate_id = item.id;
                            if (plate != null || plate != "") {
                                container.append(
                                    `<i style="font-weight: 500;font-size: 14px;text-align: end;line-height: 16px; padding-bottom: 5px;">` +
                                    item.number_plate +
                                    `</i> (` +
                                    item.vehicle_category + `),
                                    <div class="d-flex mb-0 justify-content-between">
                                        <span class="m-0">Duration</span>
                                        <strong>` + item.duration + `</strong>
                                    </div>
                                    <div class="d-flex mb-0 justify-content-between">
                                        <span class="m-0">Expiry date</span>
                                        <strong>` + item.expiry_date + `</strong>
                                    </div>`);
                            }
                        });

                        var confirmservice = $('.btn-confirm-seasonal-details')
                            .parent()
                            .parent().attr("class");
                        $('#' + confirmservice).removeClass('right-neg-100');
                        $('.landing-page-container').addClass(
                            'margin-neg-400-left');
                        $('.aside-footer').addClass('right-neg-100');
                        $('#' + confirmservice + ' .aside-footer-confirm')
                            .removeClass(
                                'right-neg-100');
                        $('.aside-footer-to-confirm').addClass(
                            'right-neg-100');

                    } else {
                        document.getElementById('seasonal_parking_errors').innerHTML = data
                            .message;
                        $('#seasonal_parking_errors').removeClass('d-none');
                    }
                }
            });

        });

        $("#seasonal_parking_pay").click(function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $('#seasonal-phone-number').val();
            var charges = $('#seasonal_total').text();

            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(charges);

            if (regex.test(phone_number) == false) {
                document.getElementById('errors').innerHTML = 'Please enter a valid Safaricom number';
                $('#errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal').modal('show');
            $('#payment-modal-header').text('Seasonal Parking Payment');
            $('#payment-modal .modal-title-sub').text('Seasonal Parking');
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal .payment-amount').text(charges);


            $.each($('.seasonal-parking-container i'), function(i,
                item) {
                // console.log(item);

                var plates = $(item).html();

                var container = $('#payment-modal .payment-plate');
                if (plates != null || plates != "") {
                    container.append(plates + " ");
                }
            });
        });

        $('btn-print-seasonal-bill').on('click', function(e) {
            e.preventDefault();


        });
    });
</script>
{{-- Seasonal Parking --}}

{{-- Offstreet Parking --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".offstreet-parking-confirm").click(function(e) {
            e.preventDefault();

            $('.btn-offstreet-confirm').text('Checking details...');
            $('.offstreet-parking-confirm .lds-ellipsis').removeClass('d-none');

            var car = $("input[name=offstreet_registration_number]").val();

            if (car == "") {
                $('#offstreet_parking_errors').html(
                    "Kindly supply all information before proceeding.");
                $('#offstreet_parking_errors').removeClass('d-none');
                return;
            }

            $.ajax({

                url: "<?php echo url('get-offstreet-charge'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    car: car,

                },

                success: function(data) {
                    console.log(data);
                    $('.offstreet-parking-confirm .lds-ellipsis').addClass('d-none');
                    $('.btn-offstreet-confirm').text('CHECK STATUS');
                    if (data == "") {
                        document.getElementById('offstreet_parking_errors').innerHTML =
                            "We're having trouble retrieving your offstreet parking charges. Please try again later.";
                        $('#offstreet_parking_errors').removeClass('d-none');
                    }
                    if (data.status_code == 200) {
                        // var parking_zone = $("#zone option:selected").text();
                        // var vehicle_type = $("#car_type option:selected").text();
                        var number_plate = $("input[name=offstreet_registration_number]")
                            .val();
                        var phone_number = $("#mpesa-phone").val();

                        // document.getElementById("parking_zone").innerHTML = parking_zone;
                        // document.getElementById("vehicle_type").innerHTML = vehicle_type;
                        document.getElementById("offstreet-plates").innerHTML =
                            number_plate;
                        document.getElementById("offstreet-charges").value = data
                            .response_data
                            .balance;
                        document.getElementById("offstreet-paid").innerHTML = "KES " + data
                            .response_data.total_paid;
                        document.getElementById("offstreet-total").innerHTML = 'KES ' + data
                            .response_data.total_cost.toLocaleString();

                        var confirmservice = $('.btn-confirm-seasonal-details')
                            .parent()
                            .parent().attr("class");
                        $('#' + confirmservice).removeClass('right-neg-100');
                        $('.landing-page-container').addClass(
                            'margin-neg-400-left');
                        $('.aside-footer').addClass('right-neg-100');
                        $('#' + confirmservice + ' .aside-footer-confirm')
                            .removeClass(
                                'right-neg-100');
                        $('.aside-footer-to-confirm').addClass(
                            'right-neg-100');
                    } else {
                        document.getElementById('offstreet_parking_errors').innerHTML = data
                            .message;
                        $('#offstreet_parking_errors').removeClass('d-none');
                    }

                }
            });
        });

        $("#offstreet_parking_pay").click(function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $('#offstreet-phone-number').val();
            var charges = $('#offstreet_total').text();

            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(charges);

            if (regex.test(phone_number) == false) {
                document.getElementById('offstreet-footer-errors').innerHTML =
                    'Please enter a valid Safaricom number';
                $('#offstreet-footer-errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal').modal('show');
            $('#payment-modal-header').text('Offstreet Parking Payment');
            $('#payment-modal .modal-title-sub').text('Offstreet Parking');
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal .payment-amount').text(charges);
            $('#payment-modal .payment-plate').text($("#offstreet-plates").text());

        });
    });
</script>
{{-- Offstreet Parking --}}

{{-- Penalties Parking --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".penalty-parking-confirm").click(function(e) {
            e.preventDefault();

            $('.btn-penalty-confirm').text('Checking details...');
            $('.penalty-parking-confirm .lds-ellipsis').removeClass('d-none');

            var car = $("input[name=penalty_registration_number]").val();

            if (car == "") {
                $('#penalty_parking_errors').html(
                    "Kindly supply all information before proceeding.");
                $('#penalty_parking_errors').removeClass('d-none');
                return;
            }

            $.ajax({

                url: "<?php echo url('get-parking-penalties'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    registration_number: car,

                },

                success: function(data) {
                    console.log(data);
                    $('.penalty-parking-confirm .lds-ellipsis').addClass('d-none');
                    $('.btn-penalty-confirm').text('CHECK STATUS');
                    if (data == "") {
                        document.getElementById('penalty_parking_errors').innerHTML =
                            "We're having trouble retrieving your penalty parking charges. Please try again later.";
                        $('#penalty_parking_errors').removeClass('d-none');
                    }
                    if (data.status_code == 200) {
                        var number_plate = $("input[name=penalty_registration_number]")
                            .val();
                        var phone_number = $("#mpesa-phone").val();
                        document.getElementById("penalty-plates").innerHTML =
                            number_plate;

                        var container = $('.penalties-parking-container');
                        $.each(data.response_data.charges, function(i, item) {
                            container.append(`<div class="d-flex mb-0 justify-content-between">
                                        <span class="m-0">` + item.description + `</span>
                                        <strong>KES ` + item.amount + `</strong>
                                 </div>`);


                        });

                        document.getElementById("penalties_parking_amount").innerHTML = data
                            .response_data.total_cost;

                        document.getElementById("penalty-total").innerHTML = 'KES ' + data
                            .response_data.total_cost.toLocaleString();

                        $('#penalties_parking_pay .btn-text').text('PAY KES ' + data
                            .response_data.total_cost.toLocaleString());

                        var confirmservice = $('.btn-penalties-confirm')
                            .parent()
                            .parent().attr("class");
                        $('#' + confirmservice).removeClass('right-neg-100');
                        $('.landing-page-container').addClass(
                            'margin-neg-400-left');
                        $('.aside-footer').addClass('right-neg-100');
                        $('#' + confirmservice + ' .aside-footer-confirm')
                            .removeClass(
                                'right-neg-100');
                        $('.aside-footer-to-confirm').addClass(
                            'right-neg-100');
                    } else {
                        document.getElementById('penalty_parking_errors').innerHTML = data
                            .message;
                        $('#penalty_parking_errors').removeClass('d-none');
                    }

                }
            });
        });

        $("#penalties_parking_pay").click(function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $('#penalties-phone-number').val();
            var charges = $('#penalties_total').text();

            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(charges);

            if (regex.test(phone_number) == false) {
                document.getElementById('penalties-footer-errors').innerHTML =
                    'Please enter a valid Safaricom number';
                $('#penalties-footer-errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal').modal('show');
            $('#payment-modal-header').text('Penalties Parking Payment');
            $('#payment-modal .modal-title-sub').text('Penalties Parking');
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal .payment-amount').text(charges);
            $('#payment-modal .payment-plate').text($("#penalty-plates").html());

        });


    });
</script>
{{-- Penalties Parking --}}

{{-- Parking Payments --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment-modal .modal-footer .btn-process').on('click', function() {
            var paymentType = $('#payment-modal-header').text();
            console.log(paymentType);
            var recheck_count = 1;

            if (paymentType === "Daily Parking Payment") {
                var daily_vehicle_category_code = $("select[name=daily_vehicle_category_code]").val();
                var registration_number = $("input[name=registration_number]").val();
                var zone_code = $("select[name=zone_code]").val();
                var phone_number = $("input[name=phone]").val();
                var amount = $("input[name=amount]").val();
                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
                console.log(daily_vehicle_category_code);
                console.log(registration_number);
                console.log(phone_number);
                console.log(zone_code);
                console.log(amount);

                $('#daily_parking_pay').find('.btn-txt').removeClass('d-none');
                $('#daily_parking_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-onstreet-parking-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        daily_vehicle_category_code: daily_vehicle_category_code,
                        zone_code: zone_code,
                        registration_number: registration_number,
                        phone_number: phone_number,
                        amount: amount
                    },
                    success: function(res) {
                        console.log(res);
                        if (res == "") {
                            document.getElementById('errors').innerHTML =
                                'We are having trouble initiating payment. Please try again later.';
                            $('#errors').removeClass('d-none');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');
                            return;
                        }
                        if (res.status_code == 200) {
                            var pay_id = res.response_data.transaction_reference;
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById('errors').innerHTML = res.message;
                            $('#errors').removeClass('d-none');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');
                        }


                    },

                });
            } else if (paymentType === "Seasonal Parking Payment") {

                var phone_number = $('#payment-modal .payment-number').text();
                $('#seasonal_parking_pay').find('.btn-txt').removeClass('d-none');
                $('#seasonal_parking_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-seasonal-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone_number: phone_number
                    },

                    success: function(data) {
                        console.log(data);

                        if (data.status_code == 200) {
                            document.getElementById('seasonal_total').innerHTML = charges;
                            var pay_id = data.response_data.transaction_reference;
                            // var pay_id = 'PKX2020041175519';
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById('seasonal-footer-errors').innerHTML =
                                data.message;
                            $('#seasonal-footer-errors').removeClass('d-none');

                        }
                    }
                });

            } else if (paymentType === "Offstreet Parking Payment") {

                var phone_number = $('#payment-modal .payment-number').text();
                $('#offstreet_parking_pay').find('.btn-txt').removeClass('d-none');
                $('#offstreet_parking_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-offstreet-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone_number: phone_number
                    },

                    success: function(data) {
                        console.log(data);

                        if (data.status_code == 200) {
                            document.getElementById('offstreet_total').innerHTML = charges;
                            var pay_id = data.response_data.transaction_reference;
                            // var pay_id = 'PKX2020041175519';
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById('offstreet-footer-errors').innerHTML =
                                data.message;
                            $('#offstreet-footer-errors').removeClass('d-none');

                        }
                    }
                });

            } else if (paymentType === "Penalties Parking Payment") {

                var phone_number = $('#payment-modal .payment-number').text();
                $('#penalties_parking_pay').find('.btn-txt').removeClass('d-none');
                $('#penalties_parking_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-penalties-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone_number: phone_number
                    },

                    success: function(data) {
                        console.log(data);

                        if (data.status_code == 200) {
                            document.getElementById('penalties_total').innerHTML = charges;
                            var pay_id = data.response_data.transaction_reference;
                            // var pay_id = 'PKX2020041175519';
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById('penalties-footer-errors').innerHTML =
                                data.message;
                            $('#penalties-footer-errors').removeClass('d-none');

                        }
                    }
                });

            }
        });

        $('#payment-cancelled-modal .btn-retry').on('click', function() {
            $('#payment-cancelled-modal').modal('hide');
            $('#payment-modal').modal('show');
        });

        function checkagain(pay_id, recheck_count) {

            if (recheck_count == 12) {
                $('#bill_pay').text(pay_id);
                var amount = $("input[name=amount]").val();
                // var amount = 1;
                $('#pay_amount').text(amount.toLocaleString());
                $('#payment-modal').modal('hide');
                $('#payment-cancelled-modal').modal('show');
                $('.payment-account').text(pay_id);

            } else {
                recheck_count++;
                setTimeout(function() {
                    $.ajax({
                        url: "get-receipt/" + pay_id,
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            if (data == "") {
                                document.getElementById('errors').innerHTML =
                                    'We are having trouble retrieving your receipt. Please try again later.';
                                $('#errors').removeClass('d-none');
                                return;
                            }
                            if (data.status != 200) {
                                checkagain(pay_id, recheck_count);

                            } else {
                                console.log(data)
                                $('receipt-number').text('PAY');
                                $('#payment-received-modal').modal('show');

                                var a = document.getElementById('receipt-link');
                                a.href = "print-receipt/" + pay_id;

                                // window.location = 'print-receipt/' +pay_id;



                            }
                        },
                    });
                }, 3000);

            }
        }
    });
</script>
{{-- Parking Payments --}}

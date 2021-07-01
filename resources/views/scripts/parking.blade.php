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
            var vehicle_category_code = $("select[name=vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var zone_code = $("select[name=zone_code]").val();

            var duration_code = 1;

            if (vehicle_category_code == "" || zone_code == "" || registration_number == "") {
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
                    vehicle_category_code: vehicle_category_code,
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

            var vehicle_category_code = $("select[name=vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var phone_number = $("input[name=phone_number]").val();
            var zone_code = $("select[name=zone_code]").val();
            var duration_code = 1;

            if (vehicle_category_code == "" || zone_code == "" || registration_number == "" ||
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
                        vehicle_category_code: vehicle_category_code,
                        zone_code: zone_code,
                        registration_number: registration_number,
                        phone_number: phone_number
                    },

                    success: function(data) {
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
                            var number_plate = $("#number-plate").val();
                            var phone_number = $("#mpesa-phone").val();

                            // console.log(data)

                            document.getElementById("parking_zone").innerHTML =
                                parking_zone;
                            document.getElementById("vehicle_type").innerHTML =
                                vehicle_type;
                            document.getElementById("number_plate").innerHTML =
                                number_plate;
                            document.getElementById("daily_parking_amount").value = data
                                .response_data
                                .balance;
                            $('#daily_parking_pay .btn-text ').html('PAY KES ' + data
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


        var recheck_count = 1;
        $("#daily_parking_pay").click(function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var vehicle_category_code = $("select[name=vehicle_category_code]").val();
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

            $('#payment-modal .payment-plate').text(registration_number);
            $('#payment-modal .payment-zone').text($("#parking_zone").html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');
        });

        $('#payment-modal .modal-footer .btn-process').on('click', function() {
            var vehicle_category_code = $("select[name=vehicle_category_code]").val();
            var registration_number = $("input[name=registration_number]").val();
            var zone_code = $("select[name=zone_code]").val();
            var phone_number = $("input[name=phone]").val();
            // var amount = $("input[name=amount]").val();
            var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(phone_number);
            console.log(amount);

            $.ajax({
                url: "<?php echo url('initiate-onstreet-parking-payment'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    vehicle_category_code: vehicle_category_code,
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
        });

        $('#payment-cancelled-modal .btn-retry').on('click', function() {
            $('#payment-cancelled-modal').modal('hide');
            $('#payment-modal').modal('show');
        });


        function checkagain(pay_id, recheck_count) {

            if (recheck_count == 12) {
                $('#bill_pay').text(pay_id);
                var amount = $("input[name=amount]").val();
                $('#pay_amount').text(amount.toLocaleString());

                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
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
                                $(this).find('.btn-txt').removeClass('d-none');
                                $(this).find('.btn-ellipsis').addClass('d-none');
                                return;
                            }
                            if (data.status != 200) {
                                checkagain(pay_id, recheck_count);

                            } else {
                                console.log(data)
                                $(this).find('.btn-ellipsis').addClass('d-none');
                                $(this).find('.btn-txt').text('PAY');
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

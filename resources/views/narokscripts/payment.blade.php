{{-- Payments --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment-modal .modal-footer .btn-process').on('click', function() {
            var paymentType = $('#payment-modal-header').text();
            $('#payment-modal .modal-header .close').addClass('d-none');
            // console.log(paymentType);
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
                // console.log(daily_vehicle_category_code);
                // console.log(registration_number);
                // console.log(phone_number);
                // console.log(zone_code);
                // console.log(amount);

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
                        // console.log(res);
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
                        // console.log(data);

                        if (data.status_code == 200) {
                            // document.getElementById('seasonal_total').innerHTML = charges;
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
                        // console.log(data);

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
                var number_plate = $('#penalty-plates').html();
                $('#penalties_parking_pay').find('.btn-txt').removeClass('d-none');
                $('#penalties_parking_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-penalty-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phone_number: phone_number,
                        number_plate: number_plate
                    },

                    success: function(data) {
                        // console.log(data);

                        if (data.status_code == 200) {
                            // $('#penalty-total') = charges;
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

            } else if (paymentType === "Renew Trade License Payment") {
                var paymentCode = $('#bill_number').html();
                var Amount = $('#renew_permit_amount').val();
                var accNo = $('#bill_number').html();
                var phoneNumber = $("input[name=renew-phone-number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#renew_permit_pay').find('.btn-txt').removeClass('d-none');
                $('#renew_permit_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/bill-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phoneNumber: phoneNumber,
                        paymentCode: paymentCode,
                        Amount: Amount,
                        accNo: accNo
                    },
                    success: function(data) {
                        if (data == null) {
                            document.getElementById('trade-errors').innerHTML =
                                "We're having trouble initiating payment. Please try again later.";
                            $('#trade-errors').removeClass('d-none');
                            $('.btn-txt').text('PAY');
                            $('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.success.success === true) {
                            //console.log(data.success.data);

                            var pay_id = data.success.data;
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById("trade-errors").innerHTML = data.success
                                .message;

                            $("#trade-errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });
            } else if (paymentType === "Register Trade License Payment") {
                var paymentCode = $('#new_bill_number').html();
                var Amount = $('#register_permit_amount').val();
                var accNo = $('#new_bill_number').html();
                var phoneNumber = $("input[name=register-phone-number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#renew_permit_pay').find('.btn-txt').removeClass('d-none');
                $('#renew_permit_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/bill-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        phoneNumber: phoneNumber,
                        paymentCode: paymentCode,
                        Amount: Amount,
                        accNo: accNo
                    },
                    success: function(data) {
                        if (data == null) {
                            document.getElementById('reg_trade_errors').innerHTML =
                                "We're having trouble initiating payment. Please try again later.";
                            $('#reg_trade_errors').removeClass('d-none');
                            $('.btn-txt').text('PAY');
                            $('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.success.success === true) {
                            //console.log(data.success.data);

                            var pay_id = data.success.data;
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById("reg_trade_errors").innerHTML = data
                                .success
                                .message;

                            $("#reg_trade_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });

            } else if (paymentType === "Narok County Bills Payment") {
                var paymentCode = $('#billDetailsHiddenNumber').html();
                var Amount = $("input[name=bill_details_pay_now_amount]").val();
                var bill_id = $('.billDetailsHiddenbillId').html();
                var phoneNumber = $("input[name=bill_details_phone]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#bill_details_pay_now').find('.btn-txt').removeClass('d-none');
                $('#bill_details_pay_now').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('initiate-bill-payment'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        bill_number: paymentCode,
                        phone_number: phoneNumber,
                        bill_id: bill_id,
                        amount: Amount
                    },
                    success: function(data) {
                        if (data == null || data == "") {
                            $("billing_details_errors").html(
                                "We're having trouble initiating payment. Please try again later."
                            );
                            $('#billing_details_errors').removeClass('d-none');
                            $('.btn-txt').text('PAY');
                            $('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.status == 200) {
                            //console.log(data.success.data);
                            var pay_id = bill_number;
                            checkagain(pay_id, recheck_count);

                        } else {
                            $("billing_details_errors").html(data.message);
                            $("#billing_details_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });

            } else if (paymentType === "Renew Food Handler License Payment") {
                var paymentCode = $('#renew_handler_bill_number').html();
                var Amount = $("input[name=renew_handler_permit_amount]").val();
                var bill_id = $('#renew_handler_bill_number').html();
                var phoneNumber = $("input[name=renew-handler-phone-number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#bill_details_pay_now').find('.btn-txt').removeClass('d-none');
                $('#bill_details_pay_now').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/pay-food-hygiene-bill'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paymentCode: paymentCode,
                        phoneNumber: phoneNumber,
                        accNo: bill_id,
                        Amount: Amount
                    },
                    success: function(data) {
                        if (data == null || data == "") {
                            $("#renew_handler_errors").html(
                                "We're having trouble initiating payment. Please try again later."
                            );
                            $('#renew_handler_errors').removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.status == 200) {
                            //console.log(data.success.data);
                            var pay_id = bill_number;
                            checkagain(pay_id, recheck_count);

                        } else {
                            $("renew_handler_errors").html(data.message);
                            $("#renew_handler_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });

            } else if (paymentType === "Register Food Handler License Payment") {
                var paymentCode = $('#renew_handler_bill_number').html();
                var Amount = $("input[name=renew_handler_permit_amount]").val();
                var bill_id = $('#renew_handler_bill_number').html();
                var bill_number = $('#renew_handler_bill_number').html();
                var phoneNumber = $("input[name=renew-handler-phone-number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#bill_details_pay_now').find('.btn-txt').removeClass('d-none');
                $('#bill_details_pay_now').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/pay-food-hygiene-bill'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paymentCode: paymentCode,
                        phoneNumber: phoneNumber,
                        accNo: bill_id,
                        Amount: Amount
                    },
                    success: function(data) {
                        if (data == null || data == "") {
                            $("#renew_handler_errors").html(
                                "We're having trouble initiating payment. Please try again later."
                            );
                            $('#renew_handler_errors').removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.status == 200) {
                            //console.log(data.success.data);
                            var pay_id = bill_number;
                            checkagain(pay_id, recheck_count);

                        } else {
                            $("renew_handler_errors").html(data.message);
                            $("#renew_handler_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });

            } else if (paymentType === "Registration Food Hygiene License Payment") {
                var paymentCode = $('#new_hygiene_bill_number').html();
                var Amount = $("#register_hygiene_permit_amount").val();
                var bill_id = $('#new_hygiene_bill_number').html();
                var bill_number = $('#new_hygiene_bill_number').html();
                var phoneNumber = $("input[name=register-hygiene-phone-number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#register_hygiene_permit_pay').find('.btn-txt').removeClass('d-none');
                $('#register_hygiene_permit_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/pay-food-hygiene-bill'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paymentCode: paymentCode,
                        phoneNumber: phoneNumber,
                        accNo: bill_id,
                        Amount: Amount
                    },
                    success: function(data) {
                        // console.log(data);
                        
                        if (data == null || data == "") {
                            $("#reg_hygiene_errors").html(
                                "We're having trouble initiating payment. Please try again later."
                            );
                            $('#reg_hygiene_errors').removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.status == 200) {
                            // console.log(data.data);
                            var pay_id = bill_number;
                            checkagain(pay_id, recheck_count);

                        } else {
                            $("#reg_hygiene_errors").html(data.message);
                            $("#reg_hygiene_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });

            }else if (paymentType === "Renew Food Hygiene License Payment") {
                var paymentCode = $('#renew_hygiene_bill_number').html();
                var Amount = $("#renew_hygiene_permit_amount").val();
                var bill_id = $('#renew_hygiene_bill_number').html();
                var bill_number = $('#renew_hygiene_bill_number').html();
                var phoneNumber = $("input[name=renew_hygiene_bill_number]").val();

                // console.log(phoneNumber);

                // var amount = 1;
                var regex =
                    /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;

                $('#register_hygiene_permit_pay').find('.btn-txt').removeClass('d-none');
                $('#register_hygiene_permit_pay').find('.btn-ellipsis').addClass('d-none');

                $.ajax({
                    url: "<?php echo url('/pay-food-hygiene-bill'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paymentCode: paymentCode,
                        phoneNumber: phoneNumber,
                        accNo: bill_id,
                        Amount: Amount
                    },
                    success: function(data) {
                        // console.log(data);
                        
                        if (data == null || data == "") {
                            $("#renew_hygiene_errors").html(
                                "We're having trouble initiating payment. Please try again later."
                            );
                            $('#renew_hygiene_errors').removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.status == 200) {
                            // console.log(data.data);
                            var pay_id = bill_number;
                            checkagain(pay_id, recheck_count);

                        } else {
                            $("#renew_hygiene_errors").html(data.message);
                            $("#renew_hygiene_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

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
                $('#payment-modal .modal-header .close').removeClass('d-none');

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
                                $('#payment-modal .modal-header .close').removeClass('d-none');
                                document.getElementById('errors').innerHTML =
                                    'We are having trouble retrieving your receipt. Please try again later.';
                                $('#errors').removeClass('d-none');
                                return;
                            }
                            if (data.status != 200) {
                                checkagain(pay_id, recheck_count);

                            } else {
                                console.log(data);
                                $('#payment-modal .modal-header .close').removeClass('d-none');

                                var ReceiptData = data.data[0];

                                $('.payment-description').text(ReceiptData.receiptDetail[0]
                                    .feeAccountDesc);
                                $('.payment-amount').text("KES " + ReceiptData.receiptInfo
                                    .receiptAmount);
                                $('.receipt-number').text(ReceiptData.receiptInfo
                                    .receiptNo);
                                $('#payment-received-modal').modal('show');
                                $('#payment-modal').modal('hide');

                                var a = "print-receipt/" + pay_id;
                                console.log(a);
                                $('#received-receipt-link').attr("href", a);


                                // window.location = 'print-receipt/' +pay_id;



                            }
                        },
                    });
                }, 3000);

            }
        }
    });
</script>
{{-- Payments --}}

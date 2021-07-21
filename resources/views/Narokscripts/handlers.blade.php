{{-- Apply Handlers --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.apply_handlers_certificate').on('click', function() {
            var slider = $(this).parent().prev('.slider');
            slider.removeClass('d-none');
            $.ajax({
                url: "<?php echo url('apply-food-handler'); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    slider.addClass('d-none');

                    // console.log(response.subcounties.data);

                    //Personal Postal Type
                    $('#handlers-subcounty').empty();
                    $('#handlers-subcounty').selectpicker('refresh');
                    $.each(response.subcounties.data, function(i, item) {
                        $('#handlers-subcounty').append($('<option>', {
                            value: item.subCountyCode,
                            text: item.subCountyName
                        }));

                        // console.log(item);
                    });
                    $('#handlers-subcounty').selectpicker('refresh');

                    $('#food-handlers-application').modal('show');

                }
            });
        });

        $('#handlers-subcounty').on('change', function() {
            $('#handlers-ward').addClass('d-none');
            var subcountyID = $(this).val();
            if (subcountyID) {
                $.ajax({
                    url: "<?php echo url('get-wards/'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        subcountyID: subcountyID
                    },

                    success: function(data) {

                        $('#handlers-ward').removeClass('d-none');

                        //console.log(data.data);
                        $('#handlers-ward').selectpicker('refresh');
                        $('#handlers-ward').empty();

                        $.each(data.data, function(i, item) {
                            //console.log(item);
                            $('#handlers-ward').append($('<option>', {
                                value: item.wardCode,
                                text: item.wardName
                            }));
                        });
                        $('#handlers-ward').selectpicker('refresh');
                    }
                });
            } else {
                $('#handlers-ward').empty();
            }
        });

        $('#handler-license-submit').on('click', function(e) {
            e.preventDefault();

            $('#food-handlers-application .slider').removeClass('d-none');

            var handlersfirstName = $('input[name=handlers-firstName]').val();
            var handlersotherNames = $('input[name=handlers-otherNames]').val();
            var handlersgender = $('select[name=handlers-gender]').val();
            var handlersidType = $('select[name=handlers-idType]').val();
            var handlersidNo = $('input[name=handlers-idNo]').val();
            var handlersmobile = $('input[name=handlers-mobile]').val();

            var handlersaddress = $('input[name=handlers-address]').val();
            var handlersselfEmployed = $('select[name=handlers-selfEmployed]').val();
            var handlerspostalCode = $('input[name=handlers-postalCode]').val();
            var handlerstown = $('input[name=handlers-town]').val();
            var handlerscounty = $('input[name=handlers-county]').val();
            var handlerssubcounty = $('select[name=handlers-subcounty]').val();
            var handlersward = $('select[name=handlers-ward]').val();
            var handlerscorporateId = $('input[name=handlers-corporateId]').val();
            var handlersworkGroupId = $('select[name=handlers-workGroupId]').val();

            $.ajax({
                url: "<?php echo url('register-food-handler'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    firstName: handlersfirstName,
                    otherNames: handlersotherNames,
                    gender: handlersgender,
                    idType: handlersidType,
                    idNo: handlersidNo,
                    mobile: handlersmobile,
                    address: handlersaddress,
                    selfEmployed: handlersselfEmployed,
                    postalCode: handlerspostalCode,
                    town: handlerstown,
                    county: handlerscounty,
                    Subcounty: handlerssubcounty,
                    ward: handlersward,
                    corporateId: handlerscorporateId,
                    workGroupId: handlersworkGroupId,
                },

                success: function(data) {
                    $('#food-handlers-application .slider').addClass('d-none');

                    console.log(data);

                    if (data.success.success === true && data.success.status === 200) {
                        setTimeout(function() {
                            getFoodHandlerBill(data.success.data.idNo);

                        }, 3000);

                        $("#pending-loader .notification-success").removeClass('d-none')
                            .siblings()
                            .addClass('d-none').parent().parent().siblings('.modal-footer')
                            .removeClass(
                                'd-none');
                        $("#pending-loader .notification-success p").html(data.success
                            .message);

                        $('#loader14').addClass('d-none');

                    } else if (data.success.success == false && data.success.status ==
                        200) {
                        setTimeout(function() {
                            getFoodHandlerBill(data.success.data.idNo);

                        }, 3000);

                        $("#pending-loader .notification-registered").removeClass('d-none')
                            .siblings()
                            .addClass('d-none').parent().parent().siblings('.modal-footer')
                            .removeClass(
                                'd-none');
                        $("#pending-loader .notification-registered p").html(data.success
                            .message);
                        $('#loader14').addClass('d-none');

                    } else {
                        // alert("some error");
                        $("#pending-loader .notification-danger").removeClass('d-none')
                            .siblings()
                            .addClass('d-none').parent().parent().siblings('.modal-footer')
                            .removeClass(
                                'd-none');
                        $("#pending-loader .notification-danger p").html(data.success
                            .message);
                        // console.log(data.success.message);
                        $('#loader14').addClass('d-none');
                    }

                    $('#pending-loader').modal('show');
                    $('#food-handlers-application').modal('hide');
                }
            });
        });

        function getFoodHandlerBill(IDNumber) {
            $.ajax({
                url: '<?php echo url('get-foodhandler-bill'); ?>/' + IDNumber,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    var FoodHygieneBill = response;

                    if (FoodHygieneBill.success === true) {
                        res = FoodHygieneBill.data;

                        $('#new_handler_client_name')
                            .html(res.data.customer);
                        $('#new_handler_client_number')
                            .html(res.data.paymentCode);
                        $('#new_handler_bill_number')
                            .html(res.data.billNo);
                        $('#new_handler_client_description')
                            .html(res.data.description);
                        $('#new_handler_fiscal_year')
                            .html(res.data.fiscalYear);

                        $('#register_handler_total')
                            .html('KES ' + res.data.billTotal);
                        $('#register_handler_permit_pay .btn-text')
                            .html('PAY KES ' + res.data.billTotal);
                        $('#register_handler_permit_amount').val(res.data.billTotal);
                        $('#food-handlers-application').modal('hide');

                        $('#register-handler-confirm').removeClass('right-neg-100');
                        $('.landing-page-container').addClass('margin-neg-400-left');
                        $('.aside-footer').addClass('right-neg-100');
                        $('#register-handler-confirm .aside-footer-confirm')
                            .removeClass('right-neg-100');
                        $('.aside-footer-to-confirm').addClass('right-neg-100');
                    } else {
                        console.log("Gina Failed");
                    }
                }
            });
        }

        $('#register_handler_permit_pay').on('click', function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=register-handler-phone-number]").val();
            var amount = $('#register_handler_permit_amount').val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                $('#reg_handler_errors').html('Please enter a valid Safaricom number');
                $('#reg_handler_errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal-header').empty();
            $('#payment-modal .modal-title-sub').empty();
            $('#payment-modal .payment-number').empty();
            $('#payment-modal .payment-amount').empty();
            $('#payment-modal .payment-zone').empty();

            $('#payment-modal-header').text("Registration Food Handler License Payment");
            $('#payment-modal .modal-title-sub').text('Registration Food Handlers License');
            $('#payment-modal .payment-zone').text($('#new_client_name').html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            $(this).find('.btn-txt').removeClass('d-none');
            $(this).find('.btn-ellipsis').addClass('d-none');
        });
    });
</script>
{{-- Apply Handlers --}}

{{-- Renew Handlers --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".renew_handler_confirm").on('click', function(e) {
            e.preventDefault();

            $('#renew_handler_errors').addClass('d-none');
            var idNumber = $("input[name=renew_handler_number]").val();

            if (idNumber == "") {
                $('#renew_handler_errors').html("Kindly supply all information before proceeding.");
                $('#renew_handler_errors').removeClass('d-none');
            } else {
                $('.btn-handler-confirm').text('Checking details...');
                $('.renew_handler_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('rnw-food-handler'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        idNo: idNumber,
                    },

                    success: function(data) {
                        console.log(data)

                        $('.renew_handler_confirm .lds-ellipsis').addClass('d-none');
                        $('.btn-handler-confirm').text('RENEW FOOD HANDLERS');

                        if (data == "") {
                            $('#renew_handler_errors').html(
                                'We are having trouble retrieving your parking charges. Please try again later.'
                            );
                            $('#renew_handler_errors').removeClass('d-none');
                            $('.btn-handler-confirm').removeClass('d-none');
                            $('.renew_handler_confirm .lds-ellipsis').addClass('d-none');
                            return;
                        }

                        if (data.status == 200) {
                            if (data.success === true) {
                                var rnwhandlers = data.data.header;

                                $('#renew_handler_client_name')
                                    .html(rnwhandlers.customer);
                                $('#renew_handler_client_number')
                                    .html(rnwhandlers.paymentCode);
                                $('#renew_handler_bill_number')
                                    .html(rnwhandlers.billNo);
                                $('#renew_handler_client_description')
                                    .html(rnwhandlers.description);
                                $('#renew_handler_fiscal_year')
                                    .html(rnwhandlers.fiscalYear);

                                $('#renew_handler_total')
                                    .html('KES ' + rnwhandlers.billTotal);
                                $('#renew_handler_permit_pay .btn-text')
                                    .html('PAY KES ' + rnwhandlers.billTotal);
                                $('#renew_handler_permit_amount').val(rnwhandlers
                                    .billTotal);

                                var confirmservice = $('#renew-handler-confirm');
                                confirmservice.removeClass('right-neg-100');
                                $('.landing-page-container').addClass(
                                    'margin-neg-400-left');
                                $('.aside-footer').addClass('right-neg-100');
                                $('.aside-footer-confirm').removeClass('right-neg-100');
                                $('.aside-footer-to-confirm').addClass('right-neg-100');
                            } else if (data.success === false) {
                                $('#renew_handler_errors').html(data.message);
                                $('#renew_handler_errors').removeClass('d-none');
                            }

                        } else {
                            $('#renew_handler_errors').html(data.message);
                            $('#renew_handler_errors').removeClass('d-none');
                        }
                    }
                });
            }
        });

        $('#renew_handler_permit_pay').on('click', function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=renew-handler-phone-number]").val();
            var amount = $('#renew_handler_permit_amount').val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                $('#renew_handler_errors').html('Please enter a valid Safaricom number');
                $('#renew_handler_errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal-header').empty();
            $('#payment-modal .modal-title-sub').empty();
            $('#payment-modal .payment-number').empty();
            $('#payment-modal .payment-amount').empty();
            $('#payment-modal .payment-zone').empty();

            $('#payment-modal-header').text("Renew Food Handler License Payment");
            $('#payment-modal .modal-title-sub').text('Renew Food Handlers License');
            $('#payment-modal .payment-zone').text($('#renew_handler_client_name').html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            $(this).find('.btn-txt').removeClass('d-none');
            $(this).find('.btn-ellipsis').addClass('d-none');
        });

        $("#renew_handler_number").on('change paste keyup', function() {
            $("#renew_handler_errors").addClass('d-none');
        });
    });
</script>
{{-- Renew Handlers --}}

{{-- Print Handlers Cert --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-print-handler-confirm").on('click', function(e) {
            e.preventDefault();

            $('#print_handler_errors').addClass('d-none');
            var idNumber = $("input[name=print_handler_number]").val();

            if (idNumber == "") {
                $('#print_handler_errors').html("Kindly supply all information before proceeding.");
                $('#print_handler_errors').removeClass('d-none');
            } else {
                $('.btn-print-handler-confirm').text('Checking details...');
                $('.print_handler_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('print-foodhandler-cert'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        idNo: idNumber,
                    },

                    success: function(data) {
                        console.log(data)

                        $('.print_handler_confirm .lds-ellipsis').addClass('d-none');
                        $('.btn-print-handler-confirm').text('PRINT CERTIFICATE');

                        if (data == "") {
                            $('#print_handler_errors').html(
                                'We are having trouble retrieving your food handlers certificate. Please try again later.'
                            );
                            $('#print_handler_errors').removeClass('d-none');
                            $('.btn-print-handler-confirm').removeClass('d-none');
                            $('.print_handler_confirm .lds-ellipsis').addClass('d-none');
                            return;
                        }

                        if (data.status == 200) {
                            if (data.success === true) {
                                var rnwhandlers = data.data.header;

                            } else if (data.success === false) {
                                $('#print_handler_errors').html(data.message);
                                $('#print_handler_errors').removeClass('d-none');
                            }

                        } else {
                            $('#print_handler_errors').html(data.message);
                            $('#print_handler_errors').removeClass('d-none');
                        }
                    }
                });
            }
        });

        $("#print_handler_number").on('change paste keyup', function() {
            $("#print_handler_errors").addClass('d-none');
        });
    });
</script>
{{-- Print Handlers Cert --}}

{{-- Print Handlers Slip --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-handler-slip-confirm").on('click', function(e) {
            e.preventDefault();

            $('#slip_handler_errors').addClass('d-none');
            var idNumber = $("input[name=slip_handler_number]").val();

            if (idNumber == "") {
                $('#slip_handler_errors').html("Kindly supply all information before proceeding.");
                $('#slip_handler_errors').removeClass('d-none');
            } else {
                $('.btn-handler-slip-confirm').text('Checking details...');
                $('.slip_handler_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('get-otp-indiv'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        idNo: idNumber,
                    },

                    success: function(data) {
                        console.log(data)

                        $('.slip_handler_confirm .lds-ellipsis').addClass('d-none');
                        $('.btn-handler-slip-confirm').text('PRINT RESULT SLIP');

                        if (data == "") {
                            $('#slip_handler_errors').html(
                                'We are having trouble retrieving your food handlers slip. Please try again later.'
                            );
                            $('#slip_handler_errors').removeClass('d-none');
                            $('.btn-handler-slip-confirm').removeClass('d-none');
                            $('.slip_handler_confirm .lds-ellipsis').addClass('d-none');
                            return;
                        }

                        if (data.success === true) {
                            $('#check-otp').removeClass('d-none').siblings()
                                .addClass('d-none');
                            $('#details-confirm').modal('show');

                        } else {
                            $('#slip_handler_errors').html(data.message);
                            $('#slip_handler_errors').removeClass('d-none');
                        }
                    }
                });
            }
        });

        $('#check-otp').click(function(e) {
            e.preventDefault();

            $('#check-otp .btn-text').addClass('d-none');
            $('#check-otp .btn-ellipsis').removeClass('d-none');

            var otp = $('input[name=slip-pin]').val();

            $.ajax({
                url: "confirm-otp-corporate",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    otp: otp
                },

                success: function(data) {

                    if (data == "success") {
                        $('#check-otp .btn-text').text('CHECK FOR CERTIFICATES');
                        $('#check-otp .btn-ellipsis').addClass('d-none');

                        var id = $('input[name=slip_handler_number]').val();
                        //alert(id);

                        setTimeout(function() {
                            window.location = '<?php echo url('get-slip'); ?>/' + id;
                        }, 3000);

                    } else {
                        document.getElementById('pin_errors').innerHTML = data;
                        $('#pin_errors').removeClass('d-none');
                        $('#check-otp .btn-ellipsis').addClass('d-none');
                        $('#check-otp .btn-text').text('CHECK FOR CERTIFICATES');
                    }
                }
            });
        });

        $("#slip_handler_number").on('change paste keyup', function() {
            $("#slip_handler_errors").addClass('d-none');
        });
    });
</script>
{{-- Print Handlers Slip --}}

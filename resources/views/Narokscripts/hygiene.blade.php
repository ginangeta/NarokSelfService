{{-- Apply Hygiene --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".apply_hygiene_confirm").on('click', function(e) {
            e.preventDefault();

            $('#apply_hygiene_errors').addClass('d-none');
            var businessID = $("input[name=apply_hygiene_number]").val();

            if (businessID == "") {
                $('#apply_hygiene_errors').html("Kindly supply all information before proceeding.");
                $('#apply_hygiene_errors').removeClass('d-none');
            } else {
                $('.btn-apply-hygiene-confirm').text('Checking details...');
                $('.apply_hygiene_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('pull-business-details'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        businessID: businessID,
                    },

                    success: function(data) {
                        // console.log(data)

                        if (data === null || data === "") {
                            $('#apply_hygiene_errors').html(
                                'We are having trouble retrieving your business details. Please try again later.'
                            );
                            $('#apply_hygiene_errors').removeClass('d-none');
                            $('.btn-apply-hygiene-confirm').removeClass('d-none');
                            $('.apply_hygiene_confirm .lds-ellipsis').addClass('d-none');
                            return;

                        } else {

                            if (data.success === false) {

                                $('#apply_hygiene_errors').html(data.message);
                                $('#apply_hygiene_errors').removeClass('d-none');
                                $('.btn-apply-hygiene-confirm').removeClass('d-none');
                                $('.apply_hygiene_confirm .lds-ellipsis').addClass(
                                    'd-none');

                            } else {
                                BusinessInformation = data.getSBPDetails.data[0];

                                var businessID = BusinessInformation.businessID;
                                var businessName = BusinessInformation.businessName;
                                var physicalAddress = BusinessInformation.physicalAddress;
                                var contactPersonPostalCode = BusinessInformation
                                    .contactPersonPostalCode;
                                var contactPersonTelephone1 = BusinessInformation
                                    .contactPersonTelephone1;
                                var contactPersonTelephone2 = BusinessInformation
                                    .contactPersonTelephone2;

                                $('input[name=hygiene-businessID]').val(businessID);
                                $('input[name=hygiene-businessName]').val(businessName);
                                $('input[name=hygiene-telephone1]').val(
                                    contactPersonTelephone1);
                                $('input[name=hygiene-telephone2]').val(
                                    contactPersonTelephone2);
                                $('input[name=hygiene-address]').val(physicalAddress);
                                $('input[name=hygiene-postalcode]').val(
                                    contactPersonPostalCode);

                                var Subcounties = data.subcounties.data;

                                $('#hygiene-subcounty').removeClass('d-none');
                                $('#hygiene-subcounty').empty();
                                $('#hygiene-subcounty').selectpicker('refresh');

                                $.each(Subcounties, function(i, item) {
                                    $('#hygiene-subcounty').append($('<option>', {
                                        value: item.subCountyCode,
                                        text: item.subCountyName
                                    }));
                                    // console.log(item);
                                });

                                $('#hygiene-subcounty').selectpicker('refresh');

                                $('#food-hygiene-application').modal('show');

                            }
                        }

                        $('.btn-apply-hygiene-confirm').text('Pull Business Details');
                        $('.apply_hygiene_confirm .lds-ellipsis').addClass('d-none');
                    }
                });
            }
        });

        $('#hygiene-subcounty').on('change', function() {
            $('.ward-ellipsis').removeClass('d-none');
            $('#hygiene-ward').addClass('d-none');
            var subcountyID = $(this).val();
            // alert(subCountyCode);
            //console.log(subCountyCode);
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

                        $('.ward-ellipsis').addClass('d-none');
                        $('#hygiene-ward').removeClass('d-none');

                        //console.log(data.data);
                        $('#hygiene-ward').selectpicker('refresh');
                        $('#hygiene-ward').empty();

                        $('#hygiene-ward').append($('<option>', {
                            value: ' ',
                            text: '-- select ward --'
                        }));

                        $.each(data.data, function(i, item) {
                            //console.log(item);
                            $('#hygiene-ward').append($('<option>', {
                                value: item.wardCode,
                                text: item.wardName
                            }));
                        });
                        $('#hygiene-ward').selectpicker('refresh');
                    }
                });
            } else {
                $('#hygiene-ward').empty();
            }
        });

        $('#hygiene-license-submit').on('click', function(e) {
            e.preventDefault();

            $('#food-hygiene-application .slider').removeClass('d-none');

            var hygiene_businessID = $('input[name=hygiene-businessID]').val();
            var hygiene_businessName = $('input[name=hygiene-businessName]').val();
            var hygiene_telephone1 = $('input[name=hygiene-telephone1]').val();
            var hygiene_telephone2 = $('input[name=hygiene-telephone2]').val();
            var hygiene_address = $('input[name=hygiene-address]').val();
            var hygiene_postalcode = $('input[name=hygiene-postalcode]').val();

            var hygiene_county = $('input[name=hygiene-county]').val();
            var hygiene_subcounty = $('select[name=hygiene-subcounty]').val();
            var hygiene_ward = $('select[name=hygiene-ward]').val();
            var hygiene_town = $('input[name=hygiene-town]').val();

            $.ajax({
                url: "<?php echo url('register-food-hygiene'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    businessName: hygiene_businessName,
                    businessID: hygiene_businessID,
                    telephone1: hygiene_telephone1,
                    telephone2: hygiene_telephone2,
                    address: hygiene_address,
                    postalCode: hygiene_postalcode,
                    county: hygiene_county,
                    subCountyId: hygiene_subcounty,
                    wardId: hygiene_ward,
                    town: hygiene_town
                },
                success: function(data) {
                    $('#food-hygiene-application .slider').addClass('d-none');

                    // console.log(data);
                    if (data.success.success === true) {
                        setTimeout(function() {
                            getFoodHygieneBill(data.success.data.billNo);

                        }, 3000);

                        $("#pending-loader .notification-success").removeClass('d-none')
                            .siblings().addClass('d-none');
                        $("#pending-loader .notification-success p").html(
                            "Generating Invoice ....");

                        $('#loader14').addClass('d-none');

                    } else {
                        // alert("some error");
                        setTimeout(function() {
                            getFoodHygieneBill(data.success.data.businessID);

                        }, 3000);

                        // alert("some error");
                        $("#pending-loader .notification-danger").removeClass('d-none')
                            .siblings().addClass('d-none');
                        $("#pending-loader .notification-danger p").text(data.success
                            .message);
                        $("#pending-loader .notification-danger h2").text("Redirecting");
                        $("#pending-loader img").attr('src',
                            '{{ asset('img/notifications/search.svg') }}');

                        console.log(data.success.data.businessID);

                    }

                    $('#pending-loader').modal('show');
                    $('#food-hygiene-application').modal('hide');
                },
                error: function(data) {
                    $("#pending-loader .notification-warning").removeClass('d-none')
                        .siblings().addClass('d-none').parent().parent().siblings(
                            '.modal-footer').removeClass('d-none');
                    $('#loader14').addClass('d-none');
                }

            });
        });

        function getFoodHygieneBill(BillNumber) {
            $.ajax({
                url: '<?php echo url('get-health-bill'); ?>/' + BillNumber,
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#pending-loader').modal('hide');

                    // console.log(response.getFoodHygieneBill);

                    var FoodHygieneBill = response.getFoodHygieneBill;

                    if (FoodHygieneBill.success === true) {
                        res = FoodHygieneBill.data;

                        $('#new_hygiene_client_name')
                            .html(res.customer);
                        $('#new_hygiene_client_number')
                            .html(res.paymentCode);
                        $('#new_hygiene_bill_number')
                            .html(res.billNo);
                        $('#new_hygiene_client_description')
                            .html(res.description);
                        $('#new_hygiene_fiscal_year')
                            .html(res.fiscalYear);

                        $('#register_hygiene_total')
                            .html('KES ' + res.billTotal);
                        $('#register_hygiene_permit_pay .btn-text')
                            .html('PAY KES ' + res.billTotal);
                        $('#register_hygiene_permit_amount').val(res.billTotal);
                        $('#food-hygiene-application').modal('hide');

                        $('#register-hygiene-confirm').removeClass('right-neg-100');
                        $('.landing-page-container').addClass('margin-neg-400-left');
                        $('.aside-footer').addClass('right-neg-100');
                        $('#register-hygiene-confirm .aside-footer-confirm').removeClass(
                            'right-neg-100').addClass('d-none');
                        $('.aside-footer-to-confirm').addClass('right-neg-100');
                    } else {
                        console.log("Gina Failed");
                    }
                }
            });
        }

        $('.btn-pay-hygiene-now').on('click', function() {
            $('#register-hygiene-confirm .aside-footer-confirm').removeClass('d-none');
        });

        $('.btn-register-hygiene-print').on('click', function() {
            $(this).addClass('py-1');
            $(this).find('.ti-printer').addClass('d-none');
            $(this).find('.bill-ellipsis').removeClass('d-none');

            var phone_number = $('#payment-modal .payment-number').text();
            // console.log(phone_number);


            var codeP = $('#new_hygiene_bill_number').html();

            window.location = '<?php echo url('/print-bill'); ?>/' + codeP;

            $(this).find('.bill-ellipsis').addClass('d-none');
            $(this).find('.ti-printer').removeClass('d-none');
            $(this).removeClass('py-1');
        });

        $('#register_hygiene_permit_pay').on('click', function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=register-hygiene-phone-number]").val();
            var amount = $('#register_hygiene_permit_amount').val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                $('#reg_hygiene_errors').html('Please enter a valid Safaricom number');
                $('#reg_hygiene_errors').removeClass('d-none');
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

            $('#payment-modal-header').text("Registration Food Hygiene License Payment");
            $('#payment-modal .modal-title-sub').text('Registration Food Hygiene License');
            $('#payment-modal .payment-zone').text($('#new_hygiene_client_name').html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            $(this).find('.btn-txt').removeClass('d-none');
            $(this).find('.btn-ellipsis').addClass('d-none');
        });
    });
</script>
{{-- Apply Hygiene --}}

{{-- Renew Hygiene --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".renew_hygiene_confirm").on('click', function(e) {
            e.preventDefault();

            $('#renew_hygiene_errors').addClass('d-none');
            var businessID = $("input[name=renew_hygiene_number]").val();

            if (businessID == "") {
                $('#renew_hygiene_errors').html("Kindly supply all information before proceeding.");
                $('#renew_hygiene_errors').removeClass('d-none');
            } else {
                $('.btn-renew-hygiene-confirm').text('Checking details...');
                $('.renew_hygiene_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('rnw-food-hygiene'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        businessID: businessID,
                    },

                    success: function(data) {
                        // console.log(data)

                        if (data === null || data === "") {
                            $('#renew_hygiene_errors').html(
                                'We are having trouble retrieving your business details. Please try again later.'
                            );
                            $('#renew_hygiene_errors').removeClass('d-none');
                            $('.btn-renew-hygiene-confirm').removeClass('d-none');
                            $('.renew_hygiene_confirm .lds-ellipsis').addClass('d-none');
                            return;

                        } else {

                            if (data.getFoodHygieneBill.success === false) {

                                $('#renew_hygiene_errors').html(data.getFoodHygieneBill
                                    .message);
                                $('#renew_hygiene_errors').removeClass('d-none');
                                $('.btn-renew-hygiene-confirm').removeClass('d-none');
                                $('.renew_hygiene_confirm .lds-ellipsis').addClass(
                                    'd-none');

                            } else {

                                var res = data.getFoodHygieneBill.data;

                                $('#renew_hygiene_client_name')
                                    .html(res.customer);
                                $('#renew_hygiene_client_number')
                                    .html(res.paymentCode);
                                $('#renew_hygiene_bill_number')
                                    .html(res.billNo);
                                $('#renew_hygiene_client_description')
                                    .html(res.description);
                                $('#renew_hygiene_fiscal_year')
                                    .html(res.fiscalYear);

                                $('#renew_hygiene_total')
                                    .html('KES ' + res.billTotal);
                                $('#renew_hygiene_permit_pay .btn-text')
                                    .html('PAY KES ' + res.billTotal);
                                $('#renew_hygiene_permit_amount').val(res.billTotal);
                                $('#food-hygiene-application').modal('hide');

                                $('#renew-hygiene-confirm').removeClass('right-neg-100');
                                $('.landing-page-container').addClass(
                                    'margin-neg-400-left');
                                $('.aside-footer').addClass('right-neg-100');
                                $('#renew-hygiene-confirm .aside-footer-confirm')
                                    .removeClass('right-neg-100').addClass('d-none');
                                $('.aside-footer-to-confirm').addClass('right-neg-100');

                            }
                        }

                        $('.btn-renew-hygiene-confirm').text('Renew Food Hygiene');
                        $('.renew_hygiene_confirm .lds-ellipsis').addClass('d-none');
                    }
                });
            }
        });

        $('.btn-pay-hygiene-now').on('click', function() {
            $('#register-hygiene-confirm .aside-footer-confirm').removeClass('d-none');
        });

        $('.btn-renew-hygiene-print').on('click', function() {
            $(this).addClass('py-1');
            $(this).find('.ti-printer').addClass('d-none');
            $(this).find('.bill-ellipsis').removeClass('d-none');

            var phone_number = $('#payment-modal .payment-number').text();
            // console.log(phone_number);


            var codeP = $('#renew_hygiene_bill_number').html();

            window.location = '<?php echo url('/print-bill'); ?>/' + codeP;

            $(this).find('.bill-ellipsis').addClass('d-none');
            $(this).find('.ti-printer').removeClass('d-none');
            $(this).removeClass('py-1');
        });

        $('#renew_hygiene_permit_pay').on('click', function(e) {
            e.preventDefault();

            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=renew-hygiene-phone-number]").val();
            var amount = $('#renew_hygiene_permit_amount').val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                $('#renew_hygiene_errors').html('Please enter a valid Safaricom number');
                $('#renew_hygiene_errors').removeClass('d-none');
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

            $('#payment-modal-header').text("Renew Food Hygiene License Payment");
            $('#payment-modal .modal-title-sub').text('Renew Food Hygiene License');
            $('#payment-modal .payment-zone').text($('#new_hygiene_client_name').html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            $(this).find('.btn-txt').removeClass('d-none');
            $(this).find('.btn-ellipsis').addClass('d-none');
        });
    });
</script>
{{-- Renew Hygiene --}}

{{-- Print Hygiene Cert --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-print-hygiene-confirm").on('click', function(e) {
            e.preventDefault();

            $('#print_hygiene_errors').addClass('d-none');
            var businessID = $("input[name=print-hygiene-cert]").val();

            if (businessID == "") {
                $('#print_hygiene_errors').html("Kindly supply all information before proceeding.");
                $('#print_hygiene_errors').removeClass('d-none');
            } else {
                $('.print_handler_confirm .lds-ellipsis').removeClass('d-none');

                // window.location = '<?php echo url('/print-food-hygiene-cert'); ?>/' + businessID;
                var win = window.open("<?php echo url('/food-hygiene-document'); ?>/" + businessID, '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
            }
        });

        $("#print-hygiene-cert").on('change paste keyup', function() {
            $("#print_hygiene_errors").addClass('d-none');
        });
    });
</script>
{{-- Print Hygiene Cert --}}

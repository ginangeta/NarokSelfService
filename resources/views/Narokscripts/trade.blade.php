{{-- Renew Trade --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-update-permit').on('click', function() {
            var businessID = $("input[name=businessID]").val();
            $.ajax({
                url: "<?php echo url('update-business'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    businessID: businessID,
                },

                success: function(data) {
                    // console.log(data);

                    BusinessInformation = data.business.data;
                    if (data.success != true) {
                        var floor = BusinessInformation.floor;
                        var building = BusinessInformation.building;
                        var activityCode = BusinessInformation.activityCode;
                        var businessID = BusinessInformation.businessID;
                        var plotNumber = BusinessInformation.plotNumber;
                        var houseNumber = BusinessInformation.houseNumber;
                        var businessName = BusinessInformation.businessName;
                        var activityCode = BusinessInformation.activityCode;
                        var physicalAddress = BusinessInformation.physicalAddress;
                        var idDocumentNumber = BusinessInformation.idDocumentNumber;
                        var contactPersonName = BusinessInformation.contactPersonName;
                        var businessActivityDescription = BusinessInformation
                            .businessActivityDescription;
                        var contactPersonTelephone1 = BusinessInformation
                            .contactPersonTelephone1;

                        $('input[name=businessID]').val(businessID);
                        $('input[name=businessName]').val(businessName);
                        $('input[name=ActivityCode]').val(activityCode);
                        $('input[name=codeDescription]').val(businessActivityDescription);
                        $('input[name=contactPersonName]').val(contactPersonName);
                        $('input[name=ContactPersonTelephone1]').val(
                            contactPersonTelephone1);
                        $('input[name=idDocumentNumber]').val(idDocumentNumber);
                        $('input[name=physicalAddress]').val(physicalAddress);
                        $('input[name=building]').val(building);
                        $('input[name=floor]').val(floor);
                        $('input[name=houseNumber]').val(houseNumber);
                        $('input[name=plotNumber]').val(plotNumber);

                        var Subcounties = data.subcounties.data;

                        $('#Subcounty').removeClass('d-none');
                        $('#Subcounty').empty();
                        $('#Subcounty').selectpicker('refresh');

                        $.each(Subcounties, function(i, item) {
                            $('#Subcounty').append($('<option>', {
                                value: item.subCountyCode,
                                text: item.subCountyName
                            }));
                            // console.log(item);
                        });

                        $('#Subcounty').selectpicker('refresh');

                        $('#trade-license-submit').addClass('update-trade-license');

                        $('#trade-license-application').modal('show');
                    }
                }
            });
        });

        $('#Subcounty').on('change', function() {
            $('.ward-ellipsis').removeClass('d-none');
            $('#ward').addClass('d-none');
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
                        $('#ward').removeClass('d-none');

                        //console.log(data.data);
                        $('#ward').selectpicker('refresh');
                        $('#ward').empty();

                        $('#ward').append($('<option>', {
                            value: ' ',
                            text: '-- select ward --'
                        }));

                        $.each(data.data, function(i, item) {
                            //console.log(item);
                            $('#ward').append($('<option>', {
                                value: item.wardCode,
                                text: item.wardName
                            }));
                        });
                        $('#ward').selectpicker('refresh');
                    }
                });
            } else {
                $('#ward').empty();
            }
        });

        $('#trade-license-submit').on('click', function(e) {
            e.preventDefault();

            $('#trade-license-application .slider').removeClass('d-none');

            var businessID = $('input[name=businessID]').val();
            var businessName = $('input[name=businessName]').val();
            var period = $('input[name=period]').val();
            var contactPersonName = $('input[name=contactPersonName]').val();
            var physicalAddress = $('input[name=physicalAddress]').val();
            var building = $('input[name=building]').val();
            var floor = $('input[name=floor]').val();
            var houseNumber = $('input[name=houseNumber]').val();
            var plotNumber = $('input[name=plotNumber]').val();
            var zoneCode = $('select[name=subCountyCode]').val();
            var buildingType = $('select[name=buildingType]').val();
            var wardCode = $('select[name=wardCode]').val();

            var classList = document.getElementById('trade-license-submit').className.split(/\s+/);

            for (var i = 0; i < classList.length; i++) {
                if (classList[i] === 'update-trade-license') {
                    $.ajax({
                        url: "<?php echo url('renew-business'); ?>",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            businessID: businessID,
                            businessName: businessName,
                            period: period,
                            contactPersonName: contactPersonName,
                            physicalAddress: physicalAddress,
                            building: building,
                            floor: floor,
                            houseNumber: houseNumber,
                            plotNumber: plotNumber,
                            zoneCode: zoneCode,
                            buildingType: buildingType,
                            wardCode: wardCode,
                        },

                        success: function(data) {
                            $('#trade-license-application .slider').addClass('d-none');

                            if (data.TradeLicense.status === 200) {
                                res = data.TradeLicense.data.header[0];

                                $('#client_name').html(res.payerName);
                                $('#client_number').html(res.clientNo);
                                $('#bill_number').html(res.billNo);
                                $('#client_description').html(data.TradeLicense.data
                                    .details[0].feeAccountDesc);
                                $('#fiscal_year').html(res.financialYear);
                                $('#created_date').html(data.TradeLicense.data.details[0]
                                    .dateCreated);

                                $('#renew_total').html('KES ' + res.billAmount);
                                $('#renew_permit_pay .btn-text').html('PAY KES ' + res
                                    .billAmount);
                                $('#renew_permit_amount').val(res.billAmount);

                                $('#trade-license-application').modal('hide');


                                $('#renew-trade-confirm').removeClass('right-neg-100');
                                $('.landing-page-container').addClass(
                                    'margin-neg-400-left');
                                $('.aside-footer').addClass('right-neg-100');
                                $('#renew-trade-confirm' + ' .aside-footer-confirm')
                                    .removeClass('right-neg-100');
                                $('.aside-footer-to-confirm').addClass('right-neg-100');
                            }

                        }
                    });

                }
            }

        });

        $('#renew_permit_pay').on('click', function(e) {
            e.preventDefault();
            $(this).find('.btn-txt').addClass('d-none');
            $(this).find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=renew-phone-number]").val();
            var amount = $("#renew_permit_amount").val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            console.log(phone_number);

            if (regex.test(phone_number) == false) {
                document.getElementById('trade-errors').innerHTML =
                    'Please enter a valid Safaricom number';
                $('#errors').removeClass('d-none');
                $(this).find('.btn-txt').text('PAY');
                $(this).find('.btn-txt').removeClass('d-none');
                $(this).find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal-header').text("Renew Trade License Payment");
            $('#payment-modal .modal-title-sub').text('Renew Trade License');
            $('#payment-modal .payment-plate').text($('input[name=businessID]').val());
            $('#payment-modal .payment-zone').text(" for " + $('input[name=businessName]').val());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

        });
    });
</script>
{{-- Renew Trade --}}

{{-- Trade Payments --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#payment-modal .modal-footer .btn-process').on('click', function() {
            var paymentType = $('#payment-modal-header').text();
            console.log(paymentType);
            var recheck_count = 1;

            if (paymentType === "Renew Trade License Payment") {
                var paymentCode = $('#bill_number').html();
                var Amount = $('#renew_permit_amount').val();
                var accNo = $('#bill_number').html();
                var phoneNumber = $("input[name=renew-phone-number]").val();

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
                            document.getElementById('pay_errors').innerHTML =
                                "We're having trouble initiating payment. Please try again later.";
                            $('#pay_errors').removeClass('d-none');
                            $('.btn-txt').text('PAY');
                            $('.btn-txt').removeClass('d-none');
                            return;
                        }
                        if (data.success.success === true) {
                            //console.log(data.success.data);

                            var pay_id = data.success.data;
                            checkagain(pay_id, recheck_count);
                        } else {
                            document.getElementById("pay_errors").innerHTML = data.success
                                .message;

                            $("#pay_errors").removeClass('d-none');
                            $(this).find('.btn-txt').text('PAY');
                            $(this).find('.btn-txt').removeClass('d-none');
                            $(this).find('.btn-ellipsis').addClass('d-none');

                        }
                    }

                });
            } else if (paymentType === "Seasonal Parking Payment") {


            } else if (paymentType === "Offstreet Parking Payment") {



            } else if (paymentType === "Penalties Parking Payment") {

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
{{-- Trade Payments --}}

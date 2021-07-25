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
                    if (typeof data === 'string') {
                        window.open(data, "_self");
                    }
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

                        $('#trade-license-renewal').modal('show');
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

            $('#trade-license-renewal .slider').removeClass('d-none');

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
                            $('#trade-license-renewal .slider').addClass('d-none');

                            if (data.TradeLicense.status === 200) {
                                res = data.TradeLicense.data.header[0];

                                $('#client_name').html(res.payerName);
                                $('#client_number').html(res.clientNo);
                                $('#bill_number').html(res.billNo);
                                $('#client_description').html(data.TradeLicense.data
                                    .details[0].feeAccountDesc);
                                $('#fiscal_year').html(res.financialYear);
                                $('#created_date').html(moment(
                                    data.TradeLicense.data.details[0]
                                    .dateCreated).zone(-0).format(
                                    'ddd, DD MMMM YYYY h:mm:ss A'));

                                $('#renew_total').html('KES ' + res
                                    .billAmount);
                                $('#renew_permit_pay .btn-text')
                                    .html('PAY KES ' + res
                                        .billAmount);
                                $('#renew_permit_amount').val(
                                    res.billAmount);

                                $('#trade-license-renewal').modal('hide');


                                $('#renew-trade-confirm').removeClass(
                                    'right-neg-100');
                                $(
                                    '.landing-page-container').addClass(
                                    'margin-neg-400-left');
                                $('.aside-footer')
                                    .addClass('right-neg-100');
                                $(
                                        '#renew-trade-confirm' +
                                        ' .aside-footer-confirm')
                                    .removeClass('right-neg-100');
                                $(
                                    '.aside-footer-to-confirm').addClass(
                                    'right-neg-100');
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
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                document.getElementById('trade-errors').innerHTML =
                    'Please enter a valid Safaricom number';
                $('#errors').removeClass('d-none');
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

            $('#payment-modal-header').text("Renew Trade License Payment");
            $('#payment-modal .modal-title-sub').text('Renew Trade License');
            $('#payment-modal .payment-plate').text($('input[name=businessID]').val());
            $('#payment-modal .payment-zone').text(" for " + $('input[name=businessName]')
                .val());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            $(this).find('.btn-txt').removeClass('d-none');
            $(this).find('.btn-ellipsis').addClass('d-none');

        });
    });
</script>
{{-- Renew Trade --}}

{{-- Register Trade --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.register_business').on('click', function() {
            var slider = $(this).parent().prev('.slider');
            slider.removeClass('d-none');
            $.ajax({
                url: "<?php echo url('register-business'); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    slider.addClass('d-none');

                    if (typeof response === 'string') {
                        window.open(response, "_self");
                    } else {

                        // console.log(response);

                        // Postal Code
                        $('#postalCode').empty();
                        $('#postalCode').selectpicker('refresh');
                        $.each(response.postalcodes, function(i, item) {
                            $('#postalCode').append($('<option>', {
                                value: item.code,
                                text: item.town
                            }));

                            // console.log(item);
                        });
                        $('#postalCode').selectpicker('refresh');

                        //Document Type
                        $('#idTypeCode').empty();
                        $('#idTypeCode').selectpicker('refresh');
                        $.each(response.documents, function(i, item) {
                            $('#idTypeCode').append($('<option>', {
                                value: item.doumentname,
                                text: item.doumentname
                            }));

                            // console.log(item);
                        });
                        $('#idTypeCode').selectpicker('refresh');

                        //Personal Postal Type
                        $('#contactPersonPostalCode').empty();
                        $('#contactPersonPostalCode').selectpicker('refresh');
                        $.each(response.postalcodes, function(i, item) {
                            $('#contactPersonPostalCode').append($('<option>', {
                                value: item.code,
                                text: item.town
                            }));

                            // console.log(item);
                        });
                        $('#contactPersonPostalCode').selectpicker('refresh');

                        //Personal Postal Type
                        $('#NewSubcounty').empty();
                        $('#NewSubcounty').selectpicker('refresh');
                        $.each(response.subcounties, function(i, item) {
                            $('#NewSubcounty').append($('<option>', {
                                value: item.subCountyCode,
                                text: item.subCountyName
                            }));

                            // console.log(item);
                        });
                        $('#NewSubcounty').selectpicker('refresh');

                        //Business Activity
                        $('#businessActivity').empty();
                        $('#businessActivity').selectpicker('refresh');
                        $.each(response.business_activities, function(i, item) {
                            $('#businessActivity').append($('<option>', {
                                value: item.brimsCode,
                                text: item.businessActivityName
                            }));

                            // console.log(item);
                        });
                        $('#businessActivity').selectpicker('refresh');

                        $('#trade-license-application').modal('show');
                    }
                }
            });
        });

        $('#NewSubcounty').on('change', function() {
            $('#Newward').find('.ward-ellipsis').removeClass('d-none');
            $('#Newward').addClass('d-none');
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

                        $('#Newward').find('.ward-ellipsis').addClass('d-none');
                        $('#Newward').removeClass('d-none');

                        //console.log(data.data);
                        $('#Newward').selectpicker('refresh');
                        $('#Newward').empty();

                        $('#Newward').append($('<option>', {
                            value: ' ',
                            text: '-- select ward --'
                        }));

                        $.each(data.data, function(i, item) {
                            //console.log(item);
                            $('#Newward').append($('<option>', {
                                value: item.wardCode,
                                text: item.wardName
                            }));
                        });
                        $('#Newward').selectpicker('refresh');
                    }
                });
            } else {
                $('#Newward').empty();
            }
        });

        $('#postalCode').on('change', function() {
            $('#town').addClass('d-none');
            var postalID = $(this).val();
            // console.log(postalID);
            if (postalID) {
                $.ajax({
                    url: 'get-postal-name/' + postalID,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        $('#town').removeClass('d-none')
                        // console.log(data);

                        $('#town').val(data.town);

                    }
                });
            } else {
                $('#town').empty();
            }
        });

        $('#newbuildingType').on('change', function() {
            var type = $(this).val();
            // console.log(subcountyID);
            if (type === 1) {
                $('#newfloor').removeClass('d-none');

            } else {
                $('#newfloor').addClass('d-none');
                $('#newfloor').val("0");
            }

        });

        $('#contactPersonPostalCode').on('change', function() {
            $('#contactPersonTown').addClass('d-none');
            var postalID = $(this).val();
            // console.log(postalID);
            if (postalID) {
                $.ajax({
                    url: 'get-postal-name/' + postalID,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        $('#contactPersonTown').removeClass('d-none');
                        // console.log(data);

                        $('#contactPersonTown').val(data.town);

                    }
                });
            } else {
                $('#contactPersonTown').empty();
            }
        });

        $('#businessActivity').on('change', function() {
            $('#newactivityCode').addClass('d-none');
            var brims_code = $(this).val();
            //alert(brims_code);
            if (brims_code) {
                $.ajax({
                    url: 'get-activity-detail/' + brims_code,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        // console.log(data);
                        $('#newactivityCode').removeClass('d-none');
                        $('#newactivityCode').empty();
                        $('#newactivityCode').selectpicker('refresh');

                        $('#newactivityCode').append($('<option>', {
                            value: ' ',
                            text: '-- select activity description --'
                        }));
                        $.each(data.data, function(i, item) {
                            //console.log(item);
                            $('#newactivityCode').append($('<option>', {
                                value: item.brimsCode,
                                text: '(' + item.brimsCode + ') ' + item
                                    .businessActivityDescription
                            }));
                        });
                        $('#newactivityCode').selectpicker('refresh');

                    }
                });
            } else {
                // console.log(data);
                $('#newactivityCode').empty();
            }
        });

        $('#newactivityCode').on('change', function() {
            var brims_code = $(this).val();
            // console.log(brims_code);
            if (brims_code) {
                $.ajax({
                    url: 'get-sbp-charges/' + brims_code,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(data) {
                        //console.log(data);
                        $('#sbp_charges').empty();

                        $.each(data, function(i, item) {
                            // console.log(item.type);
                            $('#sbp_charges').append($(
                                '<p>' + item.type + ' : ' +
                                '<b>KES ' + parseInt(item.amount)
                                .toLocaleString() + '</b>' +
                                '</p>'));
                        });
                        $('#sbp_charges').removeClass('d-none');
                    }
                });
            } else {
                $('#newactivityCode').empty();
            }
        });

        $('#trade-license-application .btn-next').hover(function() {
            var isValid = 0;
            $('#trade-license-application .form-control').each(function() {
                if ($(this).val() == "") {
                    isValid++;
                }
            });
            if (isValid > 0) {
                $('#fourth_errors').text('Kindly Fill all fields before proceeding');
                $('#fourth_errors').removeClass('d-none');
            }
        })

    });

    $('#trade-license-submit-application').on('click', function(e) {
        e.preventDefault();

        $('#trade-license-application .slider').removeClass('d-none');

        var RegBusinessName = $('input[name=RegBusinessName]').val();
        var ceriOfIncorporation = $('input[name=ceriOfIncorporation]').val();
        var KRAPin = $('input[name=KRAPin]').val();
        var VatNumber = $('input[name=VatNumber]').val();
        var pobox = $('input[name=pobox]').val();
        var postalCode = $('select[name=postalCode]').val();
        var postalTown = $('input[name=postalTown]').val();

        var telephone1 = $('input[name=telephone1]').val();
        var telephone2 = $('input[name=telephone2]').val();
        var faxNumber = $('input[name=faxNumber]').val();
        var newemail = $('input[name=newemail]').val();
        var newphysicalAddress = $('input[name=newphysicalAddress]').val();
        var newplotNumber = $('input[name=newplotNumber]').val();
        var newbuildingName = $('input[name=newbuildingName]').val();
        var newbuildingType = $('select[name=newbuildingType]').val();
        var newfloor = $('input[name=newfloor]').val();
        var newhouseNumber = $('input[name=newhouseNumber]').val();

        var contactPersonDesignation = $('input[name=contactPersonDesignation]').val();
        var ContactPersonName = $('input[name=ContactPersonName]').val();
        var idTypeCode = $('select[name=idTypeCode]').val();
        var idDocumentNumberNew = $('input[name=idDocumentNumberNew]').val();
        var contactPersonFaxNumber = $('input[name=contactPersonFaxNumber]').val();
        var contactPersonTelephone1 = $('input[name=contactPersonTelephone1]').val();
        var contactPersonTelephone2 = $('input[name=contactPersonTelephone2]').val();
        var contactPersonPOBox = $('input[name=contactPersonPOBox]').val();
        var updatedBy = $('input[name=updatedBy]').val();
        var operationalStatus = $('input[name=operationalStatus]').val();
        var contactPersonPostalCode = $('select[name=contactPersonPostalCode]').val();
        var contactPersonTown = $('input[name=contactPersonTown]').val();

        var businessActivityDescription = $('input[name=businessActivityDescription]').val();
        var otherBusinessClassificationDetails = $('input[name=otherBusinessClassificationDetails]')
            .val();
        var premisesArea = $('input[name=premisesArea]').val();
        var NewSubcounty = $('select[name=NewSubcounty]').val();
        var NewwardCode = $('select[name=NewwardCode]').val();
        var businessActivity = $('select[name=businessActivity]').val();
        var newactivityCode = $('select[name=newactivityCode]').val();
        var relativeSize = $('select[name=relativeSize]').val();
        var NewPeriod = $('select[name=NewPeriod]').val();
        var numberOfEmployees = $('input[name=numberOfEmployees]').val();

        $.ajax({
            url: "<?php echo url('register-trade-license'); ?>",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                RegBusinessName: RegBusinessName,
                telephone1: telephone1,
                telephone2: telephone2,
                faxNumber: faxNumber,
                email: newemail,
                newphysicalAddress: newphysicalAddress,
                newplotNumber: newplotNumber,
                contactPersonDesignation: contactPersonDesignation,
                contactPersonPOBox: contactPersonPOBox,
                contactPersonPostalCode: contactPersonPostalCode,
                contactPersonTown: contactPersonTown,
                contactPersonTelephone1: contactPersonTelephone1,
                contactPersonTelephone2: contactPersonTelephone2,
                contactPersonFaxNumber: contactPersonFaxNumber,
                businessActivityDescription: businessActivityDescription,
                otherBusinessClassificationDetails: otherBusinessClassificationDetails,
                premisesArea: premisesArea,
                numberOfEmployees: numberOfEmployees,
                newactivityCode: newactivityCode,
                NewSubcounty: NewSubcounty,
                NewwardCode: NewwardCode,
                relativeSize: relativeSize,
                newbuildingName: newbuildingName,
                newfloor: newfloor,
                newhouseNumber: newhouseNumber,
                ceriOfIncorporation: ceriOfIncorporation,
                KRAPin: KRAPin,
                VatNumber: VatNumber,
                pobox: pobox,
                postalCode: postalCode,
                idTypeCode: idTypeCode,
                postalTown: postalTown,
                idDocumentNumber: idDocumentNumberNew,
                updatedBy: updatedBy,
                operationalStatus: operationalStatus,
            },

            success: function(data) {
                $('#trade-license-application .slider').addClass('d-none');

                // console.log(data.TradeLicense);
                var TradeLicense = data.TradeLicense;

                if (TradeLicense.status === 200) {
                    res = TradeLicense.data.header[0];

                    $('#new_client_name').html(res.payerName);
                    $('#new_client_number').html(res.clientNo);
                    $('#new_bill_number').html(res.billNo);
                    $('#new_client_description').html(TradeLicense.data
                        .details[0].feeAccountDesc);
                    $('#new_fiscal_year').html(res.financialYear);
                    $('#new_created_date').html(moment(
                        TradeLicense.data.details[0]
                        .dateCreated).zone(-0).format(
                        'ddd, DD MMMM YYYY h:mm:ss A'));

                    $('#register_total').html('KES ' + res
                        .billAmount);
                    $('#register_permit_pay .btn-text')
                        .html('PAY KES ' + res
                            .billAmount);
                    $('#register_permit_amount').val(
                        res.billAmount);

                    $('#trade-license-application').modal('hide');


                    $('#register-trade-confirm').removeClass(
                        'right-neg-100');
                    $('.landing-page-container').addClass(
                        'margin-neg-400-left');
                    $('.aside-footer')
                        .addClass('right-neg-100');
                    $('#register-trade-confirm .aside-footer-confirm')
                        .removeClass('right-neg-100');
                    $('.aside-footer-to-confirm').addClass(
                        'right-neg-100');
                }

            }
        });

    });

    $('#register_permit_pay').on('click', function(e) {
        e.preventDefault();
        $(this).find('.btn-txt').addClass('d-none');
        $(this).find('.btn-ellipsis').removeClass('d-none');

        var phone_number = $("input[name=register-phone-number]").val();
        var amount = $('#register_permit_amount').val();
        // var amount = 1;
        var regex =
            /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
        // console.log(phone_number);

        if (regex.test(phone_number) == false) {
            document.getElementById('trade-errors').innerHTML =
                'Please enter a valid Safaricom number';
            $('#errors').removeClass('d-none');
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

        $('#payment-modal-header').text("Register Trade License Payment");
        $('#payment-modal .modal-title-sub').text('Register Trade License');
        $('#payment-modal .payment-zone').text($('#new_client_name').html());
        $('#payment-modal .payment-amount').text('KES ' + amount);
        $('#payment-modal .payment-number').text(phone_number);
        $('#payment-modal').modal('show');

        $(this).find('.btn-txt').removeClass('d-none');
        $(this).find('.btn-ellipsis').addClass('d-none');

    });
</script>
{{-- Register Trade --}}

{{-- Print Business Permit --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-print-permit-confirm").on('click', function(e) {
            e.preventDefault();

            $('#print_permit_errors').addClass('d-none');
            var businessID = $("input[name=print-permit]").val();

            if (businessID == "") {
                $('#print_permit_errors').html("Kindly supply all information before proceeding.");
                $('#print_permit_errors').removeClass('d-none');
            } else {
                $('.print_handler_confirm .lds-ellipsis').removeClass('d-none');

                // window.location = '<?php echo url('/print-food-hygiene-cert'); ?>/' + businessID;
                var win = window.open("<?php echo url('/get-permit-document'); ?>/" + businessID, '_blank');
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                } else {
                    //Browser has blocked it
                    alert('Please allow popups for this website');
                }
            }
        });

        $("#print-permit").on('change paste keyup', function() {
            $("#print_permit_errors").addClass('d-none');
        });
    });
</script>
{{-- Print Business Permit --}}

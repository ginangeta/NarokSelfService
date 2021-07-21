{{-- Generate Bill --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".bill-confirm").on('click', function(e) {
            e.preventDefault();
            console.log('Here');

            var bill_number = $("input[name=bill-number]").val();

            if (bill_number == "") {
                document.getElementById('billing_errors').innerHTML =
                    "Kindly supply all information before proceeding.";
                $('#billing_errors').removeClass('d-none');
            } else {
                $('.btn-bill-confirm').text('Checking details...');
                $('.bill-confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('get-bill-details'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        bill_number: bill_number,
                    },

                    success: function(data) {
                        // console.log(data)

                        $('.bill-confirm .lds-ellipsis').addClass('d-none');
                        $('.btn-bill-confirm').text('GET BILL DETAILS');

                        if (data == "") {
                            document.getElementById('errors').innerHTML =
                                'We are having trouble retrieving your parking charges. Please try again later.';
                            $('#billing_errors').removeClass('d-none');
                            $('.btn-bill-confirm').removeClass('d-none');
                            $('.bill-confirm .lds-ellipsis').addClass('d-none');
                            return;
                        }

                        if (data.status == 200) {
                            var header = data.data.header;
                            var details = data.data.details;
                            var paidAmount = parseInt(header.billAmount) - parseInt(header
                                .billBalance);

                            $('.incomeTypeDescription').html(header.incomeTypeDescription);
                            $('.feeAccountDesc').html(details[0].feeAccountDesc);
                            $('.briefDescription').html(details[0].briefDescription);
                            $('.payerName').html(header.payerName);
                            $('.billDetailsNumber').html("Bill No: " + header.billNo);
                            $('.billDetailsHiddenNumber').html(header.billNo);
                            $('.billDetailsHiddenbillId').html(header.billId);

                            $('.bill-details-charges').html("KES " + header.billAmount);
                            $('.bill-details-paid').html("KES " + paidAmount);
                            $('.bill-details-total').html("KES " + header.billBalance);


                            $('#bill_details_pay_now .btn-text').text("PAY KES " + header
                                .billBalance);

                            $('#bill_details_pay_now_amount').val(header
                                .billBalance);

                            var confirmservice = $('#bill-confirm');
                            confirmservice.removeClass('right-neg-100');
                            $('.landing-page-container').addClass('margin-neg-400-left');
                            $('.aside-footer').addClass('right-neg-100');
                            $('.aside-footer-confirm').removeClass('right-neg-100');
                            $('.aside-footer-to-confirm').addClass('right-neg-100');

                        } else {
                            document.getElementById('billing_errors').innerHTML = data
                                .message;
                            $('#billing_errors').removeClass('d-none');
                        }
                    }
                });
            }
        });

        $('#bill_details_pay_now').on('click', function(e) {
            e.preventDefault();

            var ClickedButton = $(this);
            ClickedButton.find('.btn-txt').addClass('d-none');
            ClickedButton.find('.btn-ellipsis').removeClass('d-none');

            var phone_number = $("input[name=bill_details_phone]").val();
            var amount = $("input[name=bill_details_pay_now_amount]").val();
            // var amount = 1;
            var regex =
                /(\+?254|0|^){1}[-. ]?[7]{1}([0-2]{1}[0-9]{1}|[9]{1}[0-9]{1}|[4]{1}[0-9]{1})[0-9]{6}/;
            // console.log(phone_number);

            if (regex.test(phone_number) == false) {
                document.getElementById('errors').innerHTML = 'Please enter a valid Safaricom number';
                $('#errors').removeClass('d-none');
                ClickedButton.find('.btn-txt').text('PAY');
                ClickedButton.find('.btn-txt').removeClass('d-none');
                ClickedButton.find('.btn-ellipsis').addClass('d-none');
                return;
            }

            $('#payment-modal-header').empty();
            $('#payment-modal .modal-title-sub').empty();
            $('#payment-modal .payment-number').empty();
            $('#payment-modal .payment-amount').empty();
            $('#payment-modal .payment-zone').empty();

            $('#payment-modal-header').text("Narok County Bills Payment");
            $('#payment-modal .modal-title-sub').text('Narok County Bills');
            $('#payment-modal .payment-plate').text($(".briefDescription").html());
            $('#payment-modal .payment-amount').text('KES ' + amount);
            $('#payment-modal .payment-number').text(phone_number);
            $('#payment-modal').modal('show');

            ClickedButton.find('.btn-txt').removeClass('d-none');
            ClickedButton.find('.btn-ellipsis').addClass('d-none');
        });

        $('.btn-print-details-bill').on('click', function(e) {
            e.preventDefault();

            $(this).addClass('py-1');
            $(this).find('.ti-printer').addClass('d-none');
            $(this).find('.bill-ellipsis').removeClass('d-none');

            var phone_number = $('#payment-modal .payment-number').text();
            // console.log(phone_number);


            var codeP = $('.billDetailsHiddenNumber').html();

            window.location = '<?php echo url('/print-bill'); ?>/' + codeP;

            $(this).find('.bill-ellipsis').addClass('d-none');
            $(this).find('.ti-printer').removeClass('d-none');
            $(this).removeClass('py-1');



        });
    });
</script>
{{-- Generate Bill --}}

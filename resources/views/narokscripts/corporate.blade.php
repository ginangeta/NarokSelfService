{{-- Corporate --}}
<script type="text/javascript">
    $(document).ready(function() {
        $(".register_corporate_confirm").on('click', function(e) {
            e.preventDefault();

            $('#register_corporate_errors').addClass('d-none');
            var businessID = $("input[name=register_corporate_number]").val();

            if (businessID == "") {
                $('#register_corporate_errors').html(
                    "Kindly supply all information before proceeding.");
                $('#register_corporate_errors').removeClass('d-none');
            } else {
                $('.btn-register-corporate-confirm').text('Checking details...');
                $('.register_corporate_confirm .lds-ellipsis').removeClass('d-none');

                $.ajax({
                    url: "<?php echo url('get-otp-corporate'); ?>",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        businessID: businessID,
                    },

                    success: function(data) {
                        console.log(data)
                        if (typeof data === 'string') {
                            window.open(data, "_self");
                        } else {

                            if (data === null || data === "") {
                                $('#register_corporate_errors').html(
                                    'We are having trouble retrieving your business details. Please try again later.'
                                );
                                $('#register_corporate_errors').removeClass('d-none');
                                $('.btn-register-corporate-confirm').removeClass('d-none');
                                $('.register_corporate_confirm .lds-ellipsis').addClass(
                                    'd-none');
                                return;

                            } else {

                                if (data.success === false) {

                                    $('#register_corporate_errors').html(data.message);
                                    $('#register_corporate_errors').removeClass('d-none');
                                    $('.btn-register-corporate-confirm').removeClass(
                                        'd-none');
                                    $('.register_corporate_confirm .lds-ellipsis').addClass(
                                        'd-none');

                                } else {

                                    $('#check-corporate-otp').removeClass('d-none')
                                        .siblings()
                                        .addClass('d-none');
                                    $('#details-confirm').modal('show');

                                }
                            }

                            $('.btn-register-corporate-confirm').text(
                                'Pull Business Details');
                            $('.register_corporate_confirm .lds-ellipsis').addClass(
                                'd-none');
                        }
                    }
                });
            }
        });

        $('#check-corporate-otp').click(function(e) {
            e.preventDefault();

            $('#check-corporate-otp .btn-text').addClass('d-none');
            $('#check-corporate-otp .btn-ellipsis').removeClass('d-none');

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
                        $('#check-corporate-otp .btn-text').removeClass('d-none');
                        $('#check-corporate-otp .btn-text').text('CHECK FOR CERTIFICATES');
                        $('#check-corporate-otp .btn-ellipsis').addClass('d-none');

                        var id = $('input[name=slip-pin]').val();
                        // alert(id);

                        setTimeout(function() {
                            window.location = '<?php echo url('get-corporate-individuals'); ?>/' + id;
                        }, 3000);

                    } else {
                        document.getElementById('pin_errors').innerHTML = data;
                        $('#pin_errors').removeClass('d-none');
                        $('#check-corporate-otp .btn-text').removeClass('d-none');
                        $('#check-corporate-otp .btn-ellipsis').addClass('d-none');
                        $('#check-corporate-otp .btn-text').text('CHECK FOR CERTIFICATES');
                    }
                }
            });
        });
    });
</script>
{{-- Corporate --}}

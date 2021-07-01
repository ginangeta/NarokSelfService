@extends('frame')
@section('content')
    <!--Page Wrapper starts-->
    <div class="page-wrapper">
        <div class="login-content fluid-container justify-content-between">
            <div class="d-flex justify-content-center registration-header">
                <img src="img/logo-files/county-logo.png" class="login-logo">
                <div class="pl-3">
                    <p class="mb-0">Narok County Government</p>
                    <h2>Self Service <span class="text-danger">Portal</span></h2>
                </div>
            </div>
            <div class="d-flex flex-column login-form-container justify-content-center" style="margin-right: 60px;">
                @if ($errors->any())
                    <p class="alert alert-danger">{{ $errors->first() }}</p>
                @endif
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                <form id="reset_form" method="POST" action="{{ route('password.reset') }}" class=" w-100 filter hero__form v3
                        listing-filter">
                    @csrf
                    <div class="login-form-header mb-4">
                        <h2>Forgot Email/Password</h2>
                        <p class="mb-0">How would you like to reset your password?</p>
                    </div>
                    <div class="radio px-2">
                        <div class="form-group">
                            <input type="radio" id="email" name="forgot-password" checked>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" id="text" name="forgot-password">
                            <label for="text">Text Message (SMS)</label>
                        </div>
                    </div>
                    <p class="explanation">We will text you a verification code to reset your password. Message and data
                        rates may apply.
                    </p>
                    <div class="row">
                        <div class="form-group pb-2 col-12 text-container d-none">
                            <div class="input-container">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phonenumber">
                                <i class="ti-mobile"></i>

                            </div>
                        </div>
                        <div class="form-group pb-2 col-12 email-container">
                            <div class="input-container">
                                <input type="text" class="form-control" placeholder="Email Address" name="emailaddress">
                                <i class="ti-email"></i>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-process btn-block btn-submit">Email Me</button>
                </form>
            </div>

            <a href="{{ route('signin') }}" class="btn-process" style="height: 42px;">Login</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="forgot-password"]').click(function() {
                if ($('#email').is(':checked')) {
                    $('.text-container').addClass('d-none');
                    $('.text-container input').val('');
                    $('.email-container').removeClass('d-none');
                    $('.explanation').text(
                        'We will send you an email with the pass code for recovering your account.');
                    $('.btn-submit').text('Email Me');
                } else if ($('#text').is(':checked')) {
                    $('.text-container').removeClass('d-none');
                    $('.email-container').addClass('d-none');
                    $('.email-container input').val('');
                    $('.btn-submit').text('Text Me');

                }
            });
        });
    </script>
@endsection

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
                <form id="reset_form" method="POST" action="{{ route('password.change') }}" class=" w-100 filter hero__form v3
                       listing-filter">
                    @csrf
                    <div class="login-form-header mb-4">
                        <h2>Password Reset</h2>
                        <p class="mb-0">Kindly change your password before proceeding.</p>
                    </div>
                    <div class="row">
                        <div class="form-group pb-0 col-12 text-container">
                            <div class="input-container mb-0">
                                <input type="text" class="form-control" placeholder="Your Email" name="Reset_email">
                                <i class="ti-email"></i>

                            </div>
                        </div>
                        <div class="form-group pb-0 col-12 text-container">
                            <div class="input-container mb-0">
                                <input type="password" class="form-control" placeholder="Sent Password" name="Sent_password">
                                <i class="ti-import"></i>

                            </div>
                        </div>
                        <div class="form-group pb-2 col-12 email-container">
                            <div class="input-container">
                                <input type="password" class="form-control" placeholder="New Password" name="Reset_password">
                                <i class="ti-link"></i>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-process btn-block btn-submit">Reset Password</button>
                </form>
            </div>

            <a href="{{ route('signin') }}" class="btn-process op-1" style="height: 42px;">Login</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

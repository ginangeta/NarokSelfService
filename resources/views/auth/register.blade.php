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
            <div class="d-flex flex-column login-form-container justify-content-center"
                style="width: 650px; margin-right: 60px;">
                @if ($errors->any())
                    <p class="alert alert-danger">{{ $errors->first() }}</p>
                @endif
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                <form method="POST" class="w-100 filter hero__form v3 listing-filter" id="signup-form"
                    action="{{ route('registration') }}" method="POST">
                    @csrf
                    <div class="login-form-header mb-4">
                        <h2>Create an account</h2>
                        <p class="mb-0">Fill in the form below to create your account.</p>
                    </div>
                    <div class="row">
                        <div class="form-group pb-2 col-12">
                            <div class="">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="full_name" placeholder="Enter your full name"
                                    required>
                                <input type="hidden" class="form-control" name="role" value="CUSTOMER">
                                <input type="hidden" class="form-control" name="roles_List[]" value="CUSTOMER">
                            </div>
                        </div>
                        <div class="form-group pb-2 col-lg-6 col-sm-12">
                            <div class="">
                                <label>Phone Number</label>
                                <input type="phone" class="form-control" name="phone_number"
                                    placeholder="Enter your phone number" required>
                            </div>
                        </div>
                        <div class="form-group pb-2 col-lg-6 col-sm-12">
                            <div class="">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email address"
                                    required>
                            </div>
                        </div>
                        <div class="form-group pb-2 col-lg-6 col-sm-12">
                            <div class="">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter your password" required>
                            </div>
                        </div>
                        <div class="form-group pb-2 col-lg-6 col-sm-12">
                            <div class="">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-process btn-block">Create account</button>
                </form>
            </div>
            <button type="button" href="{{ route('signin') }}" class="btn-process" style="height: 42px;">Login</button>
        </div>
    </div>

@endsection

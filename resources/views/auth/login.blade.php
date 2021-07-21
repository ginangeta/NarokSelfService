@extends('frame')
@section('content')
    <!--Page Wrapper starts-->
    <div class="page-wrapper">
        <div class="login-content align-items-center fluid-container">
            <div class="d-flex flex-column login-form-container">
                @if ($errors->any())
                    <p class="alert alert-danger">{{ $errors->first() }}</p>
                @endif
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                <form id="reset_form" method="POST" action="{{ route('authenticate') }}"
                    class="w-100 filter hero__form v3 listing-filter">
                    @csrf
                    <div class="login-form-header mb-4 d-flex flex-column align-items-center">
                        <img src="{{ asset('img/logo-files/county-logo.png') }}" class="login-logo">
                        <p class="mb-0">Narok County Government</p>
                        <h2>Self Service <span class="text-danger">Portal</span></h2>
                    </div>
                    <div class="form-group pb-2">
                        <div class="input-container">
                            <input type="email" name="user_name" class="form-control" placeholder="Enter your email address"
                                required>
                            <i class="ti-user"></i>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="password" class="form-control" name="password" placeholder="Enter the password"
                                required>
                            <i class="ti-lock"></i>
                        </div>

                    </div>

                    <p class="text-center">Forgot Password? <a href="{{ route('forgot-password') }}"
                            class="text-info">Click Here</a>
                    </p>

                    <button type="submit" class="btn-process btn-block mt-4">Log In</button>

                    <p class="text-center mt-4 mb-0">Dont have an account? <a href="{{ route('signup') }}"
                            class="text-info">Sign
                            Up</a></p>

                </form>

            </div>
        </div>
    </div>
@endsection

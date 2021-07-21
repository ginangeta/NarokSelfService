@extends('frame')
@section('content')

    <div class="landing-page-container position-relative w-100">
        <!-- header -->
        <header class="">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-md-4">
                        <div class="logo-container">
                            <img src="{{ asset('img/logo-files/county-logo.png') }}" class="logo">
                            <div>
                                <small class="text-secondary">Self service portal.</small>
                                <h4 class="text-secondary font-apple text-nowrap">Narok county <span
                                        class="text-primary">Government</span></h4>
                            </div>
                        </div>
                        <a href="index-2.html" class="logo d-none"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <nav>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#skills">Contacts</a></li>
                                <li><a href="#portfolio">FAQs</a></li>
                                <li><a href="#team">Bank branches</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-2 col-md-8 col-sm-12 d-flex justify-content-end">
                        <div class="wrap_icon inner-table-block">
                            @if (is_null(Session::get('resource')))
                                <a href="{{ route('signin') }}" class="btn">Login</a>
                            @else
                                <div class="profile-pic logged-in">
                                    <div class="avatar-char mr-2 text-uppercase" style="height: 50px; width: 50px;">
                                        {{ Session::get('resource')['user_full_name'][0] . Session::get('resource')['user_full_name'][1] }}
                                    </div>
                                    <ul class="dropdown">
                                        <li class="mb-0 pb-0">
                                            <a href="#" class="d-flex justify-content-center align-items-center">
                                                <div class="avatar-char mr-2">
                                                    {{ Session::get('resource')['user_full_name'][0] }}</div>

                                                <div class="listview__content">
                                                    <div class="listview__heading">
                                                        {{ Session::get('resource')['user_full_name'] }}</div>
                                                    <p class="mt-0 pr-0 mb-0 pb-0">{{ Session::get('resource')['email'] }}
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="mx-0 px-0">
                                            <hr class="mb-0 mt-0">
                                        </li>
                                        <li>
                                            <div class="listview__item">
                                                <div class="listview__content">
                                                    <div class="listview__heading">
                                                        <a href="{{ route('logout') }}" class="dark-color"
                                                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                                            title="Close Account">
                                                            <p class="text-nowrap"><span class="ti-lock mr-2"></span>Log
                                                                Out
                                                            </p>
                                                        </a>
                                                        <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                                            style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            @endif
                        </div>
                        <a href="#" class="offcanvas-bars"><i class="far fa-print"></i></a>
                        <div class="offcanvas">
                            <aside id="receipt-service-option">
                                <div class="aside-header">
                                    <div class="header-side">
                                        <h4>Print a receipt</h4>
                                        <i class="mdi mdi-close"></i>
                                    </div>
                                    <p class="mb-0">Make sure all inputs are correct. Bill number should have an hypen</p>
                                    <p class="mt-2">
                                        Example : BP2104-06*****
                                    </p>
                                </div>

                                <!-- the sub menu streams -->
                                <ul class="m-0 p-0">
                                    <!-- the inputs -->
                                    <div class="the-aside-inputs">
                                        {{-- <form class="transaction-info" action="{{ route('get-receipt-details') }}"
                                            method="post" target="_blank"> --}}

                                        <div class="form-group">
                                            <label>Transaction Type</label>
                                            <select class="selectpicker show-tick  w-100 form-control no-btn" id="sel1"
                                                name="type" title="Select transaction type" data-live-search="true"
                                                required>
                                                <option value="parking">Parking</option>
                                                <option value="sbp">Trade License</option>
                                                <option value="land" class="">Land rates</option>
                                                <option value="rents" class="">House or market rents</option>
                                                <option value="health" class="">Food handlers</option>
                                                <option value="bills" class="">County bills</option>
                                                <option></option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Bill Number</label>
                                            <input type="text" id="ReceiptBillNo" placeholder="Enter Bill Number"
                                                class="form-control w-100">
                                        </div>

                                        <div class="btn-receipt-find">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="lds-ellipsis d-none">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                                <button class="btn-process-submit btn-block btn-find-receipt">Find Receipt<i
                                                        class="ti-arrow-right ml-2"></i></button>
                                            </div>
                                        </div>

                                        <div class="bg-error bg-receipt-error d-none">
                                            <p class="mb-0 mt-0">Receipt Not Found.</p>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </ul>
                            </aside>
                        </div>
                        <div class="offcanvas-overlay"></div>
                    </div>
                    <div class="col-lg-12 d-xl-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main -->
        <main class="" data-background="img/slider2.jpg">
            <!-- slider -->
            <section class="owl-carousel slider-carousel" id="home">
                <div class="single-slider">
                    <div class="container">
                        <div class="slider-thumb">
                            <img src="{{ asset('img/me.png') }}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-xl-7 col-lg-9">
                                <div class="slider-text">
                                    <span class="wow animated fadeInDown">Narok County Government</span>
                                    <h2>Self service <strong class="text-primary">Portal.</strong></h2>
                                    <p>Make payments easily and quickly. Create an account and get to enjoy paying for
                                        your services online.</p>
                                    <div class="slider-btn">
                                        @if (is_null(Session::get('resource')))
                                            <a href="{{ route('signup') }}" class="btn">Create account</a>
                                        @else
                                            <a href="#about" class="btn d-none">Create account</a>
                                        @endif
                                        <a class="popup-video all-service-option">
                                            <i class="ti-layout-grid2"></i> County services</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="single-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9">
                                <div class="slider-text">
                                    <span>County short code</span>
                                    <h2>Dial <strong class="text-primary">*846#</strong></h2>
                                    <p>You can access the county services directly from your phone by dialing *846#.
                                        Then you will be allowed to make payments easily and conveniently through MPESA.
                                    </p>
                                    <div class="slider-btn">
                                        <a href="#about" class="btn btn-icon"><i class="ti-mobile"></i> Dial USSD</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-thumb">
                            <img src="{{ asset('img/me.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="single-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-9">
                                <div class="slider-text">
                                    <span></span>
                                    <h2>Android <strong class="text-primary">App.</strong></h2>
                                    <p>You can download the self service app from your android phone and get to enjoy
                                        county services from the palm of your hand.</p>
                                    <div class="slider-btn">
                                        <a href="#about" class="btn btn-download">
                                            <i class="mdi mdi-google-play"></i>
                                            <div>
                                                {{-- <small>Google play</small> --}}
                                                <br>
                                                <strong>Download Android app</strong>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-thumb">
                            <img src="{{ asset('img/slider2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </section>

            <!-- selecting services -->
            <section class="bg-primary">
                <div class="revenue-services container bg-primary">
                    <div class="row scroll">
                        <div class="col-xl-4 col-md-5 col-sm-12">
                            <div class="services-text">
                                <h4>Narok County Services</h4>
                                <p>Select a service, enter your correct details, confirm and pay easily.</p>
                            </div>
                        </div>

                        <!-- the services -->
                        <div class="col-xl-8 col-md-7 col-sm-12 the-services-container">
                            <div class="h-100 d-flex">

                                <!-- revenue main service 1 -->
                                <div class="parking-service-option">
                                    <div class="the-service">
                                        <img src="{{ asset('img/icons/landingpage-services/parking.svg') }}">
                                        <div>
                                            <h4>Parking</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="trade-service-option">
                                    <div class="the-service">
                                        <img src="{{ asset('img/icons/landingpage-services/trade.svg') }}">
                                        <div>
                                            <h4>Trade</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="bill-service-option">
                                    <div class="the-service">
                                        <img src="{{ asset('img/icons/landingpage-services/bill.svg') }}">
                                        <div>
                                            <h4>Bills</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="food-handler-service-option">
                                    <div class="the-service">
                                        <img src="{{ asset('img/icons/Food-handlers/salad.svg') }}">
                                        <div>
                                            <h4>Food Handlers</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="food-hygiene-service-option d-none">
                                    <div class="the-service">
                                        <img src="{{ asset('img/icons/Food-handlers/white-diet.svg') }}">
                                        <div>
                                            <h4>Food Hygiene</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="corporate-service-option d-none">
                                    <div class="the-service border-right-0">
                                        <img src="{{ asset('img/icons/landingpage-services/white-headquarters.svg') }}">
                                        <div>
                                            <h4>Corporate</h4>
                                            <p class="text-nowrap">Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- services aside container -->
    <div class="aside-container">
        <aside class="right-neg-100" id="all-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>All Services</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select a service from below</p>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams-services">
                <li class="parking-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-parking.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Parking</strong>
                    </div>
                </li>

                <li class="trade-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-trade.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Trade License</strong>
                    </div>
                </li>

                <li class="bill-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-bill.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>County Bills</strong>
                    </div>
                </li>

                <li class="food-handler-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-food-handler.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Food Handler</strong>
                    </div>
                </li>

                <li class="food-hygiene-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-food-hygiene.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Food Hygiene</strong>
                    </div>
                </li>

                <li class="corporate-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="{{ asset('img\icons\landingpage-services\black-corporate.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Corporate</strong>
                    </div>
                </li>

            </ul>
        </aside>

        <aside class="right-neg-100" id="parking-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Parking</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="daily_parking">
                    <div>
                        <img src="{{ asset('img/icons/parking/offstreet-parking.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Daily parking</strong>
                        <p>This fee will cover your parking for just a single day</p>
                    </div>
                </li>

                <li class="seasonal_parking">
                    <div>
                        <img src="{{ asset('img/icons/parking/seasonal.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Seasonal Parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="offstreet_parking">
                    <div>
                        <img src="{{ asset('img/icons/parking/off-streetparking.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Off-steet parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="d-none">
                    <div>
                        <img src="{{ asset('img/icons/parking/seasonal.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Reserved parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="penalties_parking">
                    <div>
                        <img src="{{ asset('img/icons/parking/Penalties.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Parking penalties</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

            </ul>
        </aside>

        <aside class="right-neg-100" id="bill-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Bills</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <!-- the inputs -->
            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="billing_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Bill Number</label>
                        <input type="text" placeholder="Enter Bill Number" id="bill-number"
                            class="form-control w-100 text-uppercase" name="bill-number"
                            value="{{ old('bill-number') }}">
                    </div>

                    <div class="bill-confirm" id="billconfirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-bill-confirm">Get Bill
                                Details</button>
                        </div>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Bill Not Found.</p>
                    </div>

                </div>
            </form>

        </aside>

        <aside class="right-neg-100" id="trade-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Trade</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <div class="slider d-none" style="z-index: 10; width: 100%">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="renew_permit">
                    <div>
                        <img src="{{ asset('img\icons\Trade-Licenses\Renew-License.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Renew Trade License</strong>
                        <p>Renew business permit here</p>
                    </div>
                </li>

                <li class="register_business">
                    <div>
                        <img src="{{ asset('img\icons\Trade-Licenses\Trade-License.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Register New Business</strong>
                        <p>Register your business here.</p>
                    </div>
                </li>

                <li class="print_permit">
                    <div>
                        <img src="{{ asset('img\icons\new-icons\line\print.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Print Permit</strong>
                        <p>Print your business permit.</p>
                    </div>
                </li>
            </ul>
        </aside>

        <aside class="right-neg-100" id="food-handler-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Food Handlers</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <div class="slider d-none" style="z-index: 10; width: 100%">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="apply_handlers_certificate">
                    <div>
                        <img src="{{ asset('img\icons\Food-handlers\Food-Handlers.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Apply for food handlers certificate</strong>
                        <p>Apply for food handlers certificate here</p>
                    </div>
                </li>

                <li class="renew_handlers_certificate">
                    <div>
                        <img src="{{ asset('img\icons\Trade-Licenses\Renew-License.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Renew food handlers certificate</strong>
                        <p>Renew food handlers certificate here.</p>
                    </div>
                </li>

                <li class="print_handlers_certificate">
                    <div>
                        <img src="{{ asset('img\icons\new-icons\line\print.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Print Certificate</strong>
                        <p>Print Food Handlers Certificate permit.</p>
                    </div>
                </li>

                <li class="print_handlers_result_slip">
                    <div>
                        <img src="{{ asset('img/icons/landingpage-services/black-bill.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Get Result Slip</strong>
                        <p>Get Food Handlers Result Slip.</p>
                    </div>
                </li>
            </ul>
        </aside>

        <aside class="right-neg-100" id="food-hygiene-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Food Hygiene</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <div class="slider d-none" style="z-index: 10; width: 100%">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="apply_hygiene_certificate">
                    <div>
                        <img src="{{ asset('img\icons\Food-handlers\thick-salad.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Apply for food hygiene certificate</strong>
                        <p>Apply for food hygiene certificate here</p>
                    </div>
                </li>

                <li class="renew_hygiene_certificate">
                    <div>
                        <img src="{{ asset('img\icons\Trade-Licenses\Renew-License.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Renew food hygiene certificate</strong>
                        <p>Renew food hygiene certificate here.</p>
                    </div>
                </li>

                <li class="print_hygiene_certificate">
                    <div>
                        <img src="{{ asset('img\icons\new-icons\line\print.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Print License</strong>
                        <p>Print food Hygiene certificate permit.</p>
                    </div>
                </li>
            </ul>
        </aside>

        <aside class="right-neg-100" id="corporate-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Corporate</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <div class="slider d-none" style="z-index: 10; width: 100%">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="register-corporate">
                    <div>
                        <img src="{{ asset('img\icons\Corporate\headquarters.svg') }}" class="img">
                    </div>
                    <div>
                        <strong>Get Started</strong>
                        <p>Using this option you can register your business, say a hotel business and enable you to generate
                            certificates for your staff memebers.</p>
                    </div>
                </li>
            </ul>
        </aside>

        <div class="aside-footer right-neg-100">
            <div class="form-group">
                <label class="text-secondary">Select a different service</label>
                <select class="selectpicker service-option-select-picker show-tick  w-100 btn-block py-2"
                    title="Select a service" data-live-search="true" data-style="btn-light-secondary">
                    <option selected
                        data-content="<img src='{{ asset('img/icons/parking/car-main.svg') }}' class='img rev-img-option mr-3'> <span class='parking-service-option'></span> Parking">
                    </option>
                    <option
                        data-content="<img src='{{ asset('img/icons/Trade-Licenses/briefcase.svg') }}' class='img rev-img-option mr-3'> <span class='trade-service-option'></span> Trade">
                    </option>
                    <option
                        data-content="<img src='{{ asset('img/icons/Bills/County Bills.svg') }}' class='img rev-img-option mr-3'> <span class='bill-service-option'></span> County Bills">
                    </option>
                    <option
                        data-content="<img src='{{ asset('img/icons/new-icons/nutrition.svg') }}' class='img rev-img-option mr-3'> <span class='food-hygiene-service-option'></span> Food hygiene">
                    </option>
                    <option
                        data-content="<img src='{{ asset('img/icons/new-icons/food-handlers.svg') }}' class='img rev-img-option mr-3'> <span class='food-handler-service-option'></span> Food handlers">
                    </option>
                    <option
                        data-content="<img src='{{ asset('img/icons/Corporate/corporation.svg') }}' class='img rev-img-option mr-3'> <span class='corporate-service-option'></span> Corporate">
                    </option>
                </select>
            </div>
        </div>
    </div>

    <!-- parking services sub revenue streams -->
    <div class="aside-container sub-streams parking-subs">
        <aside class="right-neg-100" id="daily_parking">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Daily Parking</h4>
                </div>
            </div>
            <hr class="mb-0">
            <div class="slider">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the inputs -->
            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="parking_errors">
                </div>
                @csrf
                <div class="the-aside-inputs">
                    <div class="form-group">
                        <label>Parking Zone</label>
                        <select class="selectpicker show-tick  w-100 form-control no-btn" id="zone" title="Select a service"
                            data-live-search="true" name="zone_code" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Vehicle type</label>
                        <select class="selectpicker show-tick  w-100 form-control no-btn" id="car_type"
                            title="Select a service" data-live-search="true" name="daily_vehicle_category_code" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Number plate</label>
                        <input type="text" placeholder="Enter Number plate" id="number-plate"
                            class="form-control w-100 text-uppercase" name="registration_number"
                            value="{{ old('registration_number') }}">
                    </div>

                </div>
            </form>

            <div class="bg-red-light computed-charges d-none" id="price">
                <img src="{{ asset('/img/icons/parking/dollar.svg') }}">
                <div class="">
                    <p>Parking Charges</p>
                    <h5>KES <span id="pay-price"></span></h5>
                </div>

            </div>

            <div class="aside-footer-to-confirm right-neg-100">
                <div class="daily-parking-confirm">
                    <div class="d-flex flex-column align-items-end">
                        <div class="lds-ellipsis d-none">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <button class="btn-process btn-confirm-daily-details">Continue to confirmation<i
                                class="ti-arrow-right ml-2"></i></button>
                    </div>
                </div>
            </div>
        </aside>

        <aside class="right-neg-100" id="seasonal_parking">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Seasonal Parking</h4>
                </div>
            </div>
            <hr class="mb-0">
            <div class="slider">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <!-- the inputs -->
            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="seasonal_parking_errors">
                </div>
                @csrf
                <div class="the-aside-inputs mt-2">
                    <div class="form-group">
                        <label>Parking Duration</label>
                        <select class="selectpicker show-tick  w-100 form-control no-btn" id="seasonal_parking_duration"
                            title="Select a parking duration" data-live-search="true" name="seasonal_duration_code"
                            required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Vehicle types</label>
                        <select class="selectpicker show-tick  w-100 form-control no-btn" id="seasonal_vehicle_type"
                            title="Select vehicle type" data-live-search="true" name="seasonal_vehicle_category_code"
                            required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Number plate</label>
                        <input type="text" placeholder="Enter Number plate" class="form-control w-100"
                            id="seasonal_registration_no" name="seasonal_registration_no"
                            value="{{ old('seasonal_registration_no') }}">
                    </div>

                    <div class="bg-red-light mx-0 computed-charges d-none" id="seasonal-price">
                        <img src="{{ asset('/img/icons/parking/dollar.svg') }}">
                        <div class="">
                            <p>Parking Charges</p>
                            <h5>KES <span id="seasonal-pay-price"></span></h5>
                        </div>
                    </div>

                    <div class="bg-red-light mx-0 computed-charges d-none" id="seasonal-rates">
                        <img src="{{ asset('/img/icons/parking/dollar.svg') }}">
                        <div class="">
                            <p>Parking Rates</p>
                            <h5>KES <span id="seasonal-pay-rates">Rates for that vehicle are not set</span></h5>
                        </div>
                    </div>

                    <button id="add_vehicle" type="button" class="btn-add btn-block btn-seasonal-add-car">Add
                        Vehicle</button>

                    <p id="p-code" class="d-none"></p>
                    <br>

                    <div>
                        <div class="col-12 p-0 cars-container mt-0">
                        </div>
                    </div>
                </div>
            </form>


            <div class="aside-footer-to-confirm right-neg-100">
                <div class="seasonal-parking-confirm">
                    <div class="d-flex flex-column align-items-end">
                        <div class="lds-ellipsis d-none">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <button class="btn-process btn-confirm-seasonal-details">Continue to confirmation<i
                                class="ti-arrow-right ml-2"></i></button>
                    </div>
                </div>
            </div>
        </aside>

        <aside class="right-neg-100" id="offstreet_parking">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Offstreet Parking</h4>
                </div>
            </div>
            <hr>

            <!-- the inputs -->
            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="offstreet_parking_errors">
                </div>
                @csrf
                <div class="the-aside-inputs">
                    <div class="form-group">
                        <label>Number plate</label>
                        <input type="text" placeholder="Enter Number plate" name="offstreet_registration_number"
                            value="{{ old('offstreet_registration_number') }}" class="form-control w-100">
                    </div>

                    <div class="offstreet-parking-confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button class="btn-process btn-block btn-offstreet-confirm">Check Details</button>
                        </div>
                    </div>

                    <div class="bg-error offstreet-error d-none">
                        <p class="mb-0">Vehicle has not checked in the zone.</p>
                    </div>

                </div>
            </form>
        </aside>

        <aside class="right-neg-100" id="penalties_parking">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Parking Penalties</h4>
                </div>
            </div>

            <hr>
            <!-- the inputs -->
            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="penalty_parking_errors">
                </div>
                @csrf
                <div class="the-aside-inputs">
                    <div class="form-group">
                        <label>Number plate</label>
                        <input type="text" placeholder="Enter Number plate" name="penalty_registration_number"
                            value="{{ old('penalty_registration_number') }}" class="form-control w-100">
                    </div>

                    <div class="penalty-parking-confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button class="btn-process btn-block btn-penalties-confirm">Get Vehicle Penalties</button>
                        </div>
                    </div>

                    <div class="bg-error penalties-error d-none">
                        <p class="mb-0">Vehicle has no penalties.</p>
                    </div>

                </div>
            </form>
        </aside>
    </div>

    <!-- bill services sub revenue streams -->
    <div class="aside-container aside-summary bill-subs">
        <aside class="right-neg-100" id="bill-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>BILL INFORMATION</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="incomeTypeDescription"></h5>
                    <h6 class="mb-3 billDetailsNumber">Bill No: PK-2105-140160</h6>
                    <p class="d-none billDetailsHiddenNumber"></p>
                    <p class="d-none billDetailsHiddenbillId"></p>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Description</span>
                            <strong class="payerName"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fee Description</span>
                            <strong class="feeAccountDesc"></strong>
                            <p class="d-none briefDescription"></p>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Charges</span>
                            <strong class="bill-details-charges"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Amount Paid</span>
                            <strong class="bill-details-paid"></strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong class="bill-details-total"></strong>
                        </div>
                    </div>
                </div>

                <div class="row bill-buttons mt-2">
                    <div class="col-10">
                        <button class="btn-process btn-success btn-pay-now w-100">PAY NOW</button>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn-process-outline btn-outline-info w-100 btn-print-details-bill">
                            <span class="ti-printer"></span>
                            <div class="bill-ellipsis d-none"></div>
                        </button>
                    </div>
                </div>

            </div>
            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="billing_details_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-daily-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="billing-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="bill-phone-number" name="bill_details_phone"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="bill-phone-number" name="bill_details_phone"
                                placeholder="Enter your phone number" value="{{ old('bill_details_phone') }}">
                        @endif
                    </div>
                    <input type="hidden" name="bill_details_pay_now_amount" id="bill_details_pay_now_amount">
                    <div class="form-group">
                        <button class="btn-process" id="bill_details_pay_now">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>
    </div>

    <!-- trade services sub revenue streams -->
    <div class="aside-container aside-summary trade-subs">
        <aside class="right-neg-100" id="renew_permit">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>Renew Business Permit</h4>
                    <i class="mdi mdi-close close-sub-aside"></i>
                </div>
            </div>
            <hr>
            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <!-- the inputs -->
                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business Number</label>
                        <input type="text" class="form-control w-100" id="plot" placeholder="Enter Business Number"
                            name="businessID" value="{{ old('businessID') }}">
                    </div>

                    <button class="btn-process btn-block btn-update-permit">Update Business Details <span
                            class="ti-arrow-right mx-2"></span> </button>

                    <div class="bg-error d-none">
                        <p class="mb-0">Permit Not Found.</p>
                    </div>

                </div>
            </ul>
        </aside>

        <aside class="right-neg-100" id="print_permit">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>Print Business Permit</h4>
                    <i class="mdi mdi-close close-sub-aside"></i>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="print_permit_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business Number</label>
                        <input type="text" placeholder="Enter Business Identification Number" id="print-permit"
                            class="form-control w-100 text-uppercase" name="print-permit"
                            value="{{ old('print-permit') }}">
                    </div>

                    <div class="print_permit_confirm" id="print_permit_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-print-permit-confirm">Print Permit</button>
                        </div>
                    </div>
                </div>
            </form>
        </aside>
    </div>

    <!-- food handlers services sub revenue streams -->
    <div class="aside-container sub-streams handlers-subs">
        <aside class="right-neg-100" id="renew_handlers_certificate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Renewal Food Handler</h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="renew_handler_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Id Number</label>
                        <input type="text" placeholder="Enter Identification Number" id="renew_handler_number"
                            class="form-control w-100 text-uppercase" name="renew_handler_number"
                            value="{{ old('renew_handler_number') }}">
                    </div>

                    <div class="renew_handler_confirm" id="renew_handler_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-handler-confirm">Renew Food
                                Handler</button>
                        </div>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Individual not registered. Kindly Proceed on registration on the portal and Food
                            Handler application.</p>
                    </div>

                </div>
            </form>
        </aside>

        <aside class="right-neg-100" id="print_handlers_certificate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Print Food Handler</h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="print_handler_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Id Number</label>
                        <input type="text" placeholder="Enter Identification Number" id="print_handler_number"
                            class="form-control w-100 text-uppercase" name="print_handler_number"
                            value="{{ old('print_handler_number') }}">
                    </div>

                    <div class="print_handler_confirm" id="print_handler_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-print-handler-confirm">Print
                                Certificate</button>
                        </div>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Individual not registered. Kindly Proceed on registration on the portal and Food
                            Handler application.</p>
                    </div>

                </div>
            </form>
        </aside>

        <aside class="right-neg-100" id="print_handlers_result_slip">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Print Food Handler Slip</h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="slip_handler_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Id Number</label>
                        <input type="text" placeholder="Enter Identification Number" id="slip_handler_number"
                            class="form-control w-100 text-uppercase" name="slip_handler_number"
                            value="{{ old('slip_handler_number') }}">
                    </div>

                    <div class="slip_handler_confirm" id="slip_handler_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-handler-slip-confirm">Print Food
                                Handler Slip</button>
                        </div>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Individual not registered. Kindly Proceed on registration on the portal and Food
                            Handler application.</p>
                    </div>

                </div>
            </form>
        </aside>
    </div>

    <!-- food hygiene services sub revenue streams -->
    <div class="aside-container sub-streams hygiene-subs">
        <aside class="right-neg-100" id="apply_hygiene_certificate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Food Hygiene Business Details </h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="apply_hygiene_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business ID</label>
                        <input type="text" placeholder="Enter Business Identification Number" id="apply_hygiene_number"
                            class="form-control w-100 text-uppercase" name="apply_hygiene_number"
                            value="{{ old('apply_hygiene_number') }}">
                    </div>

                    <div class="apply_hygiene_confirm" id="apply_hygiene_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-apply-hygiene-confirm">Pull Business
                                Details</button>
                        </div>
                    </div>

                </div>
            </form>
        </aside>

        <aside class="right-neg-100" id="renew_hygiene_certificate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Food Hygiene Business Details </h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="renew_hygiene_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business ID</label>
                        <input type="text" placeholder="Enter Business Identification Number" id="renew_hygiene_number"
                            class="form-control w-100 text-uppercase" name="renew_hygiene_number"
                            value="{{ old('renew_hygiene_number') }}">
                    </div>

                    <div class="renew_hygiene_confirm" id="renew_hygiene_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-renew-hygiene-confirm">Renew Food
                                Hygiene</button>
                        </div>
                    </div>

                </div>
            </form>
        </aside>

        <aside class="right-neg-100" id="print_hygiene_certificate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Food Hygiene Certificate</h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="print_hygiene_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business Or Corporate ID</label>
                        <input type="text" placeholder="Enter Identification Number" id="print-hygiene-cert"
                            class="form-control w-100 text-uppercase" name="print-hygiene-cert"
                            value="{{ old('print-hygiene-cert') }}">
                    </div>

                    <div class="print_hygiene_confirm" id="print_hygiene_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-print-hygiene-confirm">Print Food
                                Handler Slip</button>
                        </div>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Individual not registered. Kindly Proceed on registration on the portal and Food
                            Handler application.</p>
                    </div>

                </div>
            </form>
        </aside>
    </div>

    <!-- corporate services sub revenue streams -->
    <div class="aside-container sub-streams corporate-subs">
        <aside class="right-neg-100" id="register-corporate">
            <div class="aside-header">
                <div class="header-side-sub">
                    <div data-icon="#" aria-hidden="true" class="fs1 close-sub-aside"></div>
                    <h4>Get Business Details</h4>
                </div>
            </div>
            <hr>
            <div class="slider d-none">
                <div class="line"></div>
                <div class="subline inc"></div>
                <div class="subline dec"></div>
            </div>

            <form class="transaction-form">
                <div class="alert alert-danger d-none" id="register_corporate_errors">
                </div>

                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Business ID</label>
                        <input type="text" placeholder="Enter Business Identification Number" id="register_corporate_number"
                            class="form-control w-100 text-uppercase" name="register_corporate_number"
                            value="{{ old('register_corporate_number') }}">
                    </div>

                    <div class="register_corporate_confirm" id="register_corporate_confirm">
                        <div class="d-flex flex-column align-items-end">
                            <div class="lds-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                            <button type="button" class="btn-process btn-block btn-register-corporate-confirm">Check
                                Credentials</button>
                        </div>
                    </div>

                </div>
            </form>
        </aside>

    </div>

    <!-- confirmation services sub revenue streams -->
    <div class="aside-container aside-summary parking-subs">
        <aside class="right-neg-100" id="daily-parking-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Daily Parking</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Zone</span>
                            <strong id="parking_zone"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Car Type</span>
                            <strong id="vehicle_type"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Plate Number</span>
                            <strong id="number_plate"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Penalties</span>
                            <strong id=""></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Charges</span>
                            <strong id="charges_cost"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Amount Paid</span>
                            <strong id="charges_paid">KES 0.00</strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="charges">KES 0.00</strong>
                        </div>
                    </div>

                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-daily-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="daily-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="phone-number" name="phone"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="phone-number" name="phone"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="daily_parking_amount">
                    <div class="form-group">
                        <button class="btn-process" id="daily_parking_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="right-neg-100" id="seasonal-parking-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Seasonal Parking</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex flex-column">
                            <span class="m-0" id="seasonal_vehicle_count">Vehicles (4)</span>
                        </div>
                        <div class="seasonal-parking-container">
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Penalties</span>
                            <strong id="seasonal_penalties"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Charges</span>
                            <strong id="seasonal_charges"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Amount Paid</span>
                            <strong id="seasonal_paid"></strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="seasonal_total"></strong>
                        </div>
                    </div>

                </div>

                <div class="row bill-buttons mt-2">
                    <div class="col-10">
                        <button class="btn-process btn-success btn-pay-now w-100">PAY NOW</button>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn-process-outline btn-outline-info w-100 btn-print-seasonal-bill">
                            <span class="ti-printer"></span>
                            <div class="bill-ellipsis d-none"></div>
                        </button>
                    </div>
                    <div class="col-12 seasonal-number-input d-none">
                        <form>
                            <div>
                                <p id="seasonal-bill-footer-errors" class="alert alert-danger d-none"></p>
                            </div>

                            <div class="row mt-2">
                                <label class="col-12 mb-0 mt-2">Phone Number</label>
                                <div class="form-group col-8 mx-0 pr-0">
                                    @if (Session::has('resource'))
                                        <input type="text" class="form-control w-100" id="seasonal-bill-phone-number"
                                            name="seasonal-bill-phone-number"
                                            value="{{ Session::get('resource')['phone_number'] }}">
                                    @else
                                        <input type="text" class="form-control w-100" id="seasonal-bill-phone-number"
                                            name="seasonal-bill-phone-number" placeholder="Enter your phone number"
                                            value="{{ old('seasonal-bill-phone-number') }}">
                                    @endif
                                </div>
                                <div class="form-group col-4 mx-0 pl-0 d-flex">
                                    <button type="button" class="btn-process" id="seasonal_bill_parking_bill">
                                        <div class="btn-txt animated">
                                            <span class="btn-text text-uppercase font-12">Print</span>
                                        </div>
                                        <div class="btn-ellipsis d-none">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="aside-footer-confirm ml-2 right-neg-100 d-none">
                <form>
                    <div>
                        <p id="seasonal-footer-errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-seasonal-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="seasonal-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="seasonal-phone-number" name="phone"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="seasonal-phone-number" name="phone"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="seasonal_parking_amount">
                    <div class="form-group">
                        <button type="button" class="btn-process" id="seasonal_parking_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="right-neg-100" id="offstreet-parking-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Offstreet Parking</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Plate Number</span>
                            <strong id="offstreet-plates"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Penalties</span>
                            <strong id="">KES 0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Charges</span>
                            <strong id="offstreet-charges"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Amount Paid</span>
                            <strong id="offstreet-paid"></strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="offstreet-total">KES 0.00</strong>
                        </div>
                    </div>

                </div>
            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="penalties-footer-errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-penalties-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="offstreet-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="offstreet-phone-number" name="phone"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="offstreet-phone-number" name="phone"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="offstreet_parking_amount">
                    <div class="form-group">
                        <button type="button" class="btn-process" id="offstreet_parking_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="form-group mt-2">
                    <label>Mpesa No.</label>
                    <input type="text" placeholder="Enter Mpesa Number" class="form-control w-100">
                </div>
                <div class="form-group">
                    <button class="btn-process" data-toggle="modal" data-target="#payment-modal">PAY KES 50.00<i
                            class="ti-arrow-right ml-2"></i></button>
                </div>
            </div>
        </aside>

        <aside class="right-neg-100" id="penalty-parking-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>

            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Parking Penalties</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Car Type</span>
                            <strong>Private Car</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Plate Number</span>
                            <strong id="penalty-plates"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Penalties</span>
                        </div>
                        <div class="penalties-parking-container"></div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="penalty-total"></strong>
                        </div>
                    </div>

                </div>
            </div>
            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="penalties-footer-errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-penalties-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="penalities-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="penalties-phone-number" name="phone"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="penalties-phone-number" name="phone"
                                placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="penalties_parking_amount">
                    <div class="form-group">
                        <button type="button" class="btn-process" id="penalties_parking_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>
    </div>

    <div class="aside-container aside-summary trading-subs">

        <aside class="right-neg-100" id="renew-trade-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Renew Trade License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Number</span>
                            <strong id="client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="fiscal_year"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="created_date"></strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="renew_total"></strong>
                        </div>
                    </div>

                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="trade-errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-renew-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="renew-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="renew-phone-number" name="renew-phone-number"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="renew-phone-number" name="renew-phone-number"
                                placeholder="Enter your phone number" value="{{ old('renew-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="renew_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="renew_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="right-neg-100" id="register-trade-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Register Trade License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="new_client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Number</span>
                            <strong id="new_client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="new_bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="new_client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="new_fiscal_year"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="new_created_date"></strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="register_total"></strong>
                        </div>
                    </div>

                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="reg_trade_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-register-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="register-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="register-phone-number"
                                name="register-phone-number" value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="register-phone-number"
                                name="register-phone-number" placeholder="Enter your phone number"
                                value="{{ old('register-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="register_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="register_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

    </div>

    <div class="aside-container aside-summary confirm-handlers-subs">

        <aside class="right-neg-100" id="register-handler-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Register Food Handlers License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="new_handler_client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Payment Code</span>
                            <strong id="new_handler_client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="new_handler_bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="new_handler_client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="new_handler_fiscal_year"></strong>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="new_handler_created_date"></strong>
                        </div> --}}

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="register_handler_total"></strong>
                        </div>
                    </div>

                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="reg_handler_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-register_handler-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="register_handler-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="register-handler-phone-number"
                                name="register-handler-phone-number"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="register-handler-phone-number"
                                name="register-handler-phone-number" placeholder="Enter your phone number"
                                value="{{ old('register-handler-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="register_handler_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="register_handler_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="right-neg-100" id="renew-handler-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Renew Food Hygiene License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="renew_handler_client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Payment Code</span>
                            <strong id="renew_handler_client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="renew_handler_bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="renew_handler_client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="renew_handler_fiscal_year"></strong>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="new_handler_created_date"></strong>
                        </div> --}}

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="renew_handler_total"></strong>
                        </div>
                    </div>

                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="renew_handler_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-renew-handler-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="renew_handler-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="renew-handler-phone-number"
                                name="renew-handler-phone-number" value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="renew-handler-phone-number"
                                name="renew-handler-phone-number" placeholder="Enter your phone number"
                                value="{{ old('renew-handler-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="renew_handler_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="renew_handler_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

    </div>

    <div class="aside-container aside-summary confirm-hygiene-subs">

        <aside class="right-neg-100" id="register-hygiene-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Register Food Hygiene License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="new_hygiene_client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Payment Code</span>
                            <strong id="new_hygiene_client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="new_hygiene_bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="new_hygiene_client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="new_hygiene_fiscal_year"></strong>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="new_hygiene_created_date"></strong>
                        </div> --}}

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="register_hygiene_total"></strong>
                        </div>
                    </div>

                </div>

                <div class="row bill-buttons mt-2">
                    <div class="col-10">
                        <button class="btn-process btn-success btn-pay-hygiene-now w-100">PAY NOW</button>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn-process-outline btn-outline-info w-100 btn-register-hygiene-print">
                            <span class="ti-printer"></span>
                            <div class="bill-ellipsis d-none"></div>
                        </button>
                    </div>
                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="reg_hygiene_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-register_hygiene-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="register_hygiene-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="register-hygiene-phone-number"
                                name="register-hygiene-phone-number"
                                value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="register-hygiene-phone-number"
                                name="register-hygiene-phone-number" placeholder="Enter your phone number"
                                value="{{ old('register-hygiene-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="register_hygiene_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="register_hygiene_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

        <aside class="right-neg-100" id="renew-hygiene-confirm">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>TRANSACTION SUMMARY</h4>
                    <span class="close-confirm-aside">EDIT</span>
                </div>
            </div>
            <hr>
            <!-- the inputs -->
            <div class="the-aside-inputs">
                <div class="transactions-details-container bg-confirm">
                    <h5 class="mb-3">Renew Food Hygiene License</h5>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Client Name</span>
                            <strong id="renew_hygiene_client_name"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Payment Code</span>
                            <strong id="renew_hygiene_client_number"></strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Bill Number</span>
                            <strong id="renew_hygiene_bill_number"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Description</span>
                            <strong id="renew_hygiene_client_description"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Fiscal Year</span>
                            <strong id="renew_hygiene_fiscal_year"></strong>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <span class="m-0">Created date</span>
                            <strong id="new_hygiene_created_date"></strong>
                        </div> --}}

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong id="renew_hygiene_total"></strong>
                        </div>
                    </div>

                </div>

                <div class="row bill-buttons mt-2">
                    <div class="col-10">
                        <button class="btn-process btn-success btn-pay-hygiene-now w-100">PAY NOW</button>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn-process-outline btn-outline-info w-100 btn-renew-hygiene-print">
                            <span class="ti-printer"></span>
                            <div class="bill-ellipsis d-none"></div>
                        </button>
                    </div>
                </div>

            </div>

            <div class="aside-footer-confirm right-neg-100">
                <form>
                    <div>
                        <p id="renew_hygiene_errors" class="alert alert-danger d-none"></p>
                    </div>
                    <div class="col-sm-12 pl-0 d-none" id="print-renew-hygiene-receipt">
                        <p><b>You can now proceed to print your receipt</b></p>
                        <a href="" target="_blank" id="renew_hygiene-receipt-link"
                            class="btn btn-secondary text-white font-14 w-100  center mx-0 ">
                            <div class="btn-txt animated print-receipt">
                                <span class="btn-text text-uppercase font-12 ">Print receipt</span>

                            </div>
                        </a>
                    </div>
                    <div class="form-group mt-2">
                        <label>Mpesa No.</label>
                        @if (Session::has('resource'))
                            <input type="text" class="form-control w-100" id="renew-hygiene-phone-number"
                                name="renew-hygiene-phone-number" value="{{ Session::get('resource')['phone_number'] }}">
                        @else
                            <input type="text" class="form-control w-100" id="renew-hygiene-phone-number"
                                name="renew-hygiene-phone-number" placeholder="Enter your phone number"
                                value="{{ old('renew-hygiene-phone-number') }}">
                        @endif
                    </div>
                    <input type="hidden" name="amount" id="renew_hygiene_permit_amount">
                    <div class="form-group">
                        <button class="btn-process" id="renew_hygiene_permit_pay">
                            <div class="btn-txt animated">
                                <span class="btn-text text-uppercase font-12"></span>
                                <i class="ti-arrow-right ml-2"></i>
                            </div>
                            <div class="btn-ellipsis d-none">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </aside>

    </div>

    @include('narokmodals.modals')

@endsection

@section('scripts')
    <script type="text/javascript">
        $('.btn-receipt-find').on('click', function(e) {
            e.preventDefault();

            $('.btn-find-receipt').text('Checking details...');
            $('.btn-find-receipt .lds-ellipsis').removeClass('d-none');

            var ReceiptBillNo = $('#ReceiptBillNo').val();
            var ReceiptTransType = $('#sel1').val();

            // console.log('ReceiptTransType: ' + ReceiptTransType);
            // console.log('ReceiptBillNo: ' + ReceiptBillNo);

            $.ajax({
                url: "<?php echo url('get-receipt-details'); ?>",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ReceiptBillNo: ReceiptBillNo,
                    ReceiptTransType: ReceiptTransType,
                },

                success: function(data) {
                    $('.btn-find-receipt .lds-ellipsis').addClass('d-none');
                    $('.btn-find-receipt').text('PRINT RECEIPT');

                    if (data.receipt != null) {
                        // console.log(data.receipt);

                        $('.bg-receipt-error').removeClass('d-none');
                        $('.bg-receipt-error p').html(data.receipt.message);

                    } else if (data.data !== null || data.data !== "") {
                        var billNo = data.data.billNo;
                        // console.log(billNo);
                        if (data.status === 200) {
                            let url =
                                "print-receipt/:BillNo";
                            url = url.replace(':BillNo', billNo);
                            var win = window.open(url, '_blank');
                            if (win) {
                                //Browser has allowed it to be opened
                                win.focus();
                            } else {
                                //Browser has blocked it
                                alert('Please allow popups for this website');
                            }

                        } else {
                            $('.bg-receipt-error').removeClass('d-none');
                        }
                    } else {
                        $('.bg-receipt-error').removeClass('d-none');
                    }
                }
            });


        });

        $('#ReceiptBillNo').on("change paste keyup", function() {
            $('.bg-receipt-error').addClass('d-none');
        });
    </script>

    {{-- Parking --}}
    @include('narokscripts.parking')
    {{-- Parking --}}

    {{-- Trade --}}
    @include('narokscripts.trade')
    {{-- Trade --}}

    {{-- Billing --}}
    @include('narokscripts.billing')
    {{-- Billing --}}

    {{-- Food Handlers --}}
    @include('narokscripts.handlers')
    {{-- Food Handlers --}}

    {{-- Food Hygiene --}}
    @include('narokscripts.hygiene')
    {{-- Food Hygiene --}}

    {{-- Corporate --}}
    @include('narokscripts.corporate')
    {{-- Corporate --}}

    {{-- Payments --}}
    @include('narokscripts.payment')
    {{-- Payments --}}


@endsection

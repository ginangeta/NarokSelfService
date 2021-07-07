@extends('frame')
@section('content')

    <div class="landing-page-container position-relative w-100">
        <!-- header -->
        <header class="">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-md-4">
                        <div class="logo-container">
                            <img src="img/logo-files/county-logo.png" class="logo">
                            <div>
                                <small class="text-secondary">Self service portal.</small>
                                <h4 class="text-secondary font-apple text-nowrap">Narok county <span
                                        class="text-primary">Government</span></h4>
                            </div>
                        </div>
                        <a href="index-2.html" class="logo d-none"><img src="img/logo.png" alt=""></a>
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
                                        <i class="mdi mdi-close close-aside"></i>
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

                                        <div class="">
                                            <button class="btn-process-submit btn-block btn-receipt-find">Print
                                                Receipt</button>
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
                            <img src="img/me.png" alt="">
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
                            <img src="img/me.png" alt="">
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
                            <img src="img/slider2.png" alt="">
                        </div>
                    </div>
                </div>
            </section>

            <!-- selecting services -->
            <section class="bg-primary">
                <div class="revenue-services container bg-primary">
                    <div class="row">
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
                                        <img src="img/icons/landingpage-services/parking.svg">
                                        <div>
                                            <h4>Parking</h4>
                                            <p>Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="trade-service-option">
                                    <div class="the-service">
                                        <img src="img/icons/landingpage-services/trade.svg">
                                        <div>
                                            <h4>Trade</h4>
                                            <p>Pay now <i class="ti-arrow-right"></i></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- revenue main service 2 -->
                                <div class="bill-service-option">
                                    <div class="the-service border-right-0">
                                        <img src="img/icons/landingpage-services/bill.svg">
                                        <div>
                                            <h4>Bills</h4>
                                            <p>Pay now <i class="ti-arrow-right"></i></p>
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
                        <img src="img\icons\landingpage-services\black-parking.svg" class="img">
                    </div>
                    <div>
                        <strong>Parking</strong>
                    </div>
                </li>

                <li class="trade-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="img\icons\landingpage-services\black-trade.svg" class="img">
                    </div>
                    <div>
                        <strong>Trade License</strong>
                    </div>
                </li>

                <li class="bill-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="img\icons\landingpage-services\black-bill.svg" class="img">
                    </div>
                    <div>
                        <strong>County Bills</strong>
                    </div>
                </li>

                <li class="food-handler-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="img\icons\landingpage-services\black-food-handler.svg" class="img">
                    </div>
                    <div>
                        <strong>Food Handler</strong>
                    </div>
                </li>

                <li class="food-hygiene-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="img\icons\landingpage-services\black-food-hygiene.svg" class="img">
                    </div>
                    <div>
                        <strong>Food Hygiene</strong>
                    </div>
                </li>

                <li class="corporate-service-option">
                    <div class="the-border-menu"></div>
                    <div>
                        <img src="img\icons\landingpage-services\black-corporate.svg" class="img">
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
                        <img src="img/icons/parking/offstreet-parking.svg" class="img">
                    </div>
                    <div>
                        <strong>Daily parking</strong>
                        <p>This fee will cover your parking for just a single day</p>
                    </div>
                </li>

                <li class="seasonal_parking">
                    <div>
                        <img src="img/icons/parking/seasonal.svg" class="img">
                    </div>
                    <div>
                        <strong>Seasonal Parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="offstreet_parking">
                    <div>
                        <img src="img/icons/parking/off-streetparking.svg" class="img">
                    </div>
                    <div>
                        <strong>Off-steet parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="d-none">
                    <div>
                        <img src="img/icons/parking/seasonal.svg" class="img">
                    </div>
                    <div>
                        <strong>Reserved parking</strong>
                        <p>Pay for parking up to a specified duration.</p>
                    </div>
                </li>

                <li class="penalties_parking">
                    <div>
                        <img src="img/icons/parking/Penalties.svg" class="img">
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

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <!-- the inputs -->
                <div class="the-aside-inputs">

                    <div class="form-group">
                        <label>Bill Number</label>
                        <input type="text" placeholder="Enter Bill Number" class="form-control w-100">
                    </div>

                    <div class="bill-confirm">
                        <button class="btn-process btn-block btn-bill-confirm">Get Bill Details</button>
                    </div>

                    <div class="bg-error d-none">
                        <p class="mb-0">Bill Not Found.</p>
                    </div>

                </div>
            </ul>
        </aside>

        <aside class="right-neg-100" id="trade-service-option">
            <div class="aside-header">
                <div class="header-side">
                    <h4>Trade</h4>
                    <i class="mdi mdi-close close-aside"></i>
                </div>
                <p>Select an option from the list below</p>
            </div>

            <!-- the sub menu streams -->
            <ul class="sub-streams">
                <li class="renew_permit">
                    <div>
                        <img src="img\icons\Trade-Licenses\Renew-License.svg" class="img">
                    </div>
                    <div>
                        <strong>Renew Trade License</strong>
                        <p>Renew business permit here</p>
                    </div>
                </li>

                <li class="register_business" data-toggle="modal" data-target="#trade-license-application">
                    <div>
                        <img src="img\icons\Trade-Licenses\Trade-License.svg" class="img">
                    </div>
                    <div>
                        <strong>Register New Business</strong>
                        <p>Register your business here.</p>
                    </div>
                </li>

                <li class="print_permit" data-toggle="modal" data-target="#trade-license-application">
                    <div>
                        <img src="img\icons\new-icons\line\print.svg" class="img">
                    </div>
                    <div>
                        <strong>Print Permit</strong>
                        <p>Print your business permit.</p>
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
                        data-content="<img src='img/icons/parking/car-main.svg' class='img rev-img-option mr-3'> <span class='parking-service-option'></span> Parking">
                    </option>
                    <option
                        data-content="<img src='img/icons/Trade-Licenses/briefcase.svg' class='img rev-img-option mr-3'> <span class='trade-service-option'></span> Trade">
                    </option>
                    <option
                        data-content="<img src='img/icons/Bills/County Bills.svg' class='img rev-img-option mr-3'> <span class='bill-service-option'></span> County Bills">
                    </option>
                    <option
                        data-content="<img src='img\icons\new-icons\nutrition.svg' class='img rev-img-option mr-3'> <span class='food-handler-service-option'></span> Food hygiene">
                    </option>
                    <option
                        data-content="<img src='img\icons\new-icons\food-handlers.svg' class='img rev-img-option mr-3'> <span class='food-hygiene-service-option'></span> Food handlers">
                    </option>
                    <option
                        data-content="<img src='img\icons\new-icons\food-handlers.svg' class='img rev-img-option mr-3'> <span class='corporate-service-option'></span> Corporate">
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
                <img src="/img/icons/parking/dollar.svg">
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
                        <img src="/img/icons/parking/dollar.svg">
                        <div class="">
                            <p>Parking Charges</p>
                            <h5>KES <span id="seasonal-pay-price"></span></h5>
                        </div>
                    </div>

                    <div class="bg-red-light mx-0 computed-charges d-none" id="seasonal-rates">
                        <img src="/img/icons/parking/dollar.svg">
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
                    <h5 class="">Parking</h5>
                    <h6 class="mb-3">Bill No: PK-2105-140160</h6>
                    <p class="">Below are the transaction details you provided plus the computed prices for your
                        transaction.</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Car Type</span>
                            <strong>Private Car</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Plate Number</span>
                            <strong class="">KBG 125P</strong>
                        </div>
                        <hr class="dashed">
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Penalties</span>
                            <strong>KES 2000.00</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Parking Charges</span>
                            <strong>KES 50.00</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="m-0">Amount Paid</span>
                            <strong>KES 0.00</strong>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong class="bill-total">TOTAL</strong>
                            <strong>KES 2050.00</strong>
                        </div>
                    </div>
                </div>

                <div class="row bill-buttons mt-2">
                    <div class="col-10">
                        <button class="btn-process btn-success btn-pay-now w-100">PAY NOW</button>
                    </div>
                    <div class="col-2 pl-0">
                        <button class="btn-process-outline btn-outline-info w-100"><span class="ti-printer"></span></button>
                    </div>
                </div>
            </div>
            <div class="aside-footer-confirm right-neg-100">
                <div class="form-group bill-mpesa d-none mt-2">
                    <label>Mpesa No.</label>
                    <input type="text" placeholder="Enter Mpesa Number" class="form-control w-100">
                </div>
                <div class="form-group">
                    <button class="btn-process" data-toggle="modal" data-target="#payment-modal">PAY KES 50.00<i
                            class="ti-arrow-right ml-2"></i></button>
                </div>
            </div>
        </aside>
    </div>

    <!-- trade services sub revenue streams -->
    <div class="aside-container aside-summary trade-subs">
        <aside class="right-neg-100" id="print_permit">
            <div class="aside-header">
                <div class="header-side-sub">
                    <h4>Print Business Permit</h4>
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
                        <input type="text" placeholder="Enter Business Number" class="form-control w-100">
                    </div>

                    <button class="btn-process btn-block btn-print-permit">Print Permit <span
                            class="far fa-print mx-2"></span> </button>

                    <div class="bg-error d-none">
                        <p class="mb-0">Permit Not Found.</p>
                    </div>

                </div>
            </ul>
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
                        <a href="" target="_blank" id="receipt-link"
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
                        <button class="btn-process-outline btn-outline-info w-100 btn-print-seasonal-bill"><span
                                class="ti-printer"></span></button>
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
                        <a href="" target="_blank" id="receipt-link"
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
                        <a href="" target="_blank" id="receipt-link"
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
                        <a href="" target="_blank" id="receipt-link"
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

    <!-- payment modal -->
    <div class="modal fade" id="payment-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="badge badge-pill badge-success text-uppercase">Make payment</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title text-capitalize" id="payment-modal-header">
                        Daily Parking Payment
                    </h4>
                    <p><span class="modal-title-sub">Daily parking</span> for <strong class="payment-plate"></strong>
                        <strong class="payment-zone"></strong>
                    </p>
                    <br>

                    <p class="mb-3">A payment request of <strong class="payment-amount"></strong> will be sent to
                        your
                        phone number
                        <strong>(<span class="payment-number"></span>)</strong> soon after you <strong>click</strong> the
                        pay
                        button below.
                        Make sure you have enough money in yor mpesa.
                    </p>

                    <p>
                        Once the payment request is sent to your phone, you will have <strong>50 seconds</strong> to
                        complete the payment by entering your <strong>Mpesa pin</strong> on your phone.
                    </p>
                    <p><strong>Click Pay</strong> below when ready to continue.</p>

                    <br>

                    <div class="form-group mb-0">
                        <div class="checkbox checkbox--inline">
                            <input type="checkbox" id="customCheck5">
                            <label class="checkbox__label" for="customCheck5">Add this vehicle to your
                                assets</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-process  text-capitalize btn-modal-pay">
                        <span class=" animated fade-In"><i class="mdi mdi-login mr-2"></i> Pay</span>
                        <!-- loader -->
                        <div class="timer-loader d-none animated fade-In">
                            <i class="mdi mdi-timer-outline mr-2"></i><strong>50 S</strong>
                        </div>
                        <!-- loader -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- payment received modal -->
    <div class="modal fade" id="payment-received-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body payment-modal">
                    <img src="img\icons\received.svg" class="received-img">
                    <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                        Payment Received
                    </h4>
                    <hr>

                    <p>
                        <strong class="payment-amount"></strong> as your Parking fee for <strong
                            class="payment-plate"></strong>. Your
                        <strong>receipt</strong> number is <strong class="receipt-number">TRJKJK123</strong>.
                    </p>

                    <p>Thankyou for using our service. Have yourself a nice day.</p>

                    <div class="row bill-buttons mt-5">
                        <div class="col-10">
                            <a id="receipt-link" class="btn-process btn-success btn-pay-now w-100"><span
                                    class="ti-printer mr-2"></span>
                                Print Receipt</a>
                        </div>
                        <div class="col-2 pl-0">
                            <button class="btn-process-outline btn-outline-info w-100" data-dismiss="modal">close</button>
                        </div>
                    </div>

                    <p class="mt-3">Narok County Government Parking</p>

                </div>

            </div>
        </div>
    </div>

    <!-- payment received modal -->
    <div class="modal fade" id="payment-cancelled-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body payment-modal">
                    <img src="img\icons\cancelled.svg" class="received-img">
                    <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                        Payment not received
                    </h4>
                    <hr>

                    <p>
                        Your payment was not received, you may have taken too long before entering your PIN.
                        <strong>Press retry</strong>
                        below or pay directly through mpesa by using the <strong> paybill number 272525</strong> and the
                        account your
                        account name is <strong class="payment-account">76768DHJJH</strong>
                    </p>

                    <div class="row bill-buttons mt-5">
                        <div class="col-10">
                            <button class="btn-process-outline-black btn-success btn-pay-now btn-retry w-100"><span
                                    class="ti-reload mr-2"></span> Retry</button>
                        </div>
                        <div class="col-2 pl-0">
                            <button class="btn-process-outline btn-outline-info w-100" data-dismiss="modal">close</button>
                        </div>
                    </div>

                    <p class="mt-3">Narok County Government Parking</p>

                </div>

            </div>
        </div>
    </div>

    <!-- payment received modal -->
    <div class="modal fade" id="remove-vehicle-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body payment-modal">
                    <h4 class="modal-title text-capitalize" id="exampleModalLongTitle">
                        remove car
                    </h4>
                    <hr>

                    <img src="{{ asset('img/icons/warning.svg') }}" class="received-img"
                        style="height: 130px; margin-bottom: 2rem;">
                    <h5>
                        <p id="record-name" class=""></p>
                    </h5>
                    <p class="d-none" id="p-code">
                    <p>
                        Are you sure you want to delete this car from the list of vehicles payable by this
                        transaction?
                    </p>

                    <div class="row mt-5">
                        <div class="col-10">
                            <button id="remove-entry"
                                class="btn-process-outline-black btn-success btn-pay-now btn-retry w-100">
                                <span class="ti-trash mr-2"></span> Remove from list
                            </button>
                        </div>
                        <div class="col-2 pl-0">
                            <button class="btn-process-outline btn-outline-info w-100" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                    <p class="mt-3">Narok County Government Parking</p>

                </div>

            </div>
        </div>
    </div>

    <!-- payment received modal -->
    <div class="modal fade" id="trade-license-application" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="header-side">
                        <h4>Narok Trade License Registration</h4>
                        <p>Fill in and remember to double check your details at each stage</p>
                    </div>

                    <i class="mdi mdi-close" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="slider-container wow animated slideInLeft">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Business information</h5>
                                    <p>Please fill all the required(*) fields.</p>
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Business Name<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Business Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Certificate of incorporation<strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Certificate of incorporation">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>KRA Pin Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter KRA Pin Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>VAT Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter VAT Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>P.O Box<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter P.O Box">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <select class="form-control">
                                                        <option>Select postal code</option>
                                                        <option>00200</option>
                                                        <option>00100</option>
                                                        <option>00205</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal town<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter Postal town">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 modal-nav">
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span>STEP 1</span>
                                    <div class="modal-footer-buttons">
                                        <button type="button" class="btn-process btn-next btn-success">Next
                                            <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-container d-none wow animated slideInLeft">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Additional business information</h5>
                                    <p>Please fill all the required(*) fields.</p>
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Business Name<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Business Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Certificate of incorporation<strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Certificate of incorporation">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>KRA Pin Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter KRA Pin Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>VAT Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter VAT Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>P.O Box<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter P.O Box">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <select class="form-control">
                                                        <option>Select postal code</option>
                                                        <option>00200</option>
                                                        <option>00100</option>
                                                        <option>00205</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal town<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter Postal town">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 modal-nav">
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span>STEP 2</span>
                                    <div class="modal-footer-buttons">
                                        <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                            <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                            PREVIOUS
                                        </button>
                                        <button type="button" class="btn-process btn-next btn-success">NEXT
                                            <i data-icon="$" class="fs1" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-container d-none wow animated slideInLeft">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Last Business information</h5>
                                    <p>Please fill all the required(*) fields.</p>
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Business Name<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Business Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Certificate of incorporation<strong
                                                    class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter Certificate of incorporation">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>KRA Pin Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter KRA Pin Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>VAT Number<strong class="text-danger">*</strong></label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter VAT Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>P.O Box<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter P.O Box">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <select class="form-control">
                                                        <option>Select postal code</option>
                                                        <option>00200</option>
                                                        <option>00100</option>
                                                        <option>00205</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="form-group">
                                                    <label>Postal town<strong class="text-danger">*</strong></label>
                                                    <input type="text" class="form-control form-control-lg"
                                                        placeholder="Enter Postal town">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 modal-nav">
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span>STEP 3</span>
                                    <div class="modal-footer-buttons">
                                        <button type="button" class="btn-process-outline btn-previous btn-outline-info">
                                            <i data-icon="#" class="fs1" aria-hidden="true"></i>
                                            PREVIOUS
                                        </button>
                                        <button type="button" class="btn-process btn-submit btn-success">Submit
                                            <i class="mdi mdi-check-all"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $('.btn-receipt-find').on('click', function(e) {
            e.preventDefault();

            var ReceiptBillNo = $('#ReceiptBillNo').val();
            var ReceiptTransType = $('#sel1').val();

            console.log('ReceiptTransType: ' + ReceiptTransType);
            console.log('ReceiptBillNo: ' + ReceiptBillNo);

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
                    var billNo = data.data.billNo;
                    console.log(billNo);
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
                }
            });


        });

        $('#ReceiptBillNo').on("change paste keyup", function() {
            $('.bg-receipt-error').addClass('d-none');
        });
    </script>


    {{-- Daily Parking --}}
    @include('scripts.parking')
    {{-- Daily Parking --}}


@endsection

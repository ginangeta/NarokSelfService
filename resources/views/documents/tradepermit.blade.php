<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title class="">NRK Trade License</title>
    <link
        href="https://fonts.googleapis.com/css?family=Aldrich|Fira+Sans:200,300,400,500,700,800,900|Norican&display=swap&subset=cyrillic"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700|Open+Sans:300,400,600,700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">


    <style>
        .print-btn {
            display: flex;
            z-index: 1000000000;
            position: fixed;
            background: #215939;
            color: white;
            top: 30px;
            right: 30px;
            border-radius: 50%;
            padding: 1rem;
            margin: 0px;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 1px 0px 20px 4px rgb(136 136 136 / 65%);
            cursor: pointer;
            transition: 0.4s;
        }

        .print-btn img {
            height: 35px;
        }

        @charset "utf-8";

        :root {
            --blue: #007bff;
            --indigo: #6610f2;
            --purple: #6f42c1;
            --pink: #e83e8c;
            --red: #dc3545;
            --orange: #fd7e14;
            --yellow: #ffc107;
            --green: #28a745;
            --teal: #20c997;
            --cyan: #17a2b8;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary: #007bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --breakpoint-xs: 0;
            --breakpoint-sm: 576px;
            --breakpoint-md: 768px;
            --breakpoint-lg: 992px;
            --breakpoint-xl: 1200px;
            --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }

        .w-100 {
            width: 100% !important;
        }

        .title-header {
            display: flex;
            text-transform: capitalize;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .uppercase {
            text-transform: uppercase !important;
        }

        .red {
            color: red !important;
        }

        .py-0 {
            padding-top: 0px;
            padding-bottom: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        hr {
            border-top: 1px solid black !important;
        }



        .validations-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 120px;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-size: 1rem;
            font-weight: bold;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 14px;

        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 992px) .container {
            max-width: 960px;
        }

        .text-right {
            text-align: right !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .float-right {
            float: right !important;
        }

        .dropdown,
        .dropleft,
        .dropright,
        .dropup {
            position: relative;
        }

        p {
            margin-bottom: 7.5px;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .mb-5 {}

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .mt-2,
        .my-2 {
            margin-top: .5rem !important;
        }

        .logo {
            height: 212px;
        }

        .mx-2,
        .mr-2 {
            margin-right: .5rem !important;
        }

        .mb-0,
        .my-0 {
            margin-bottom: 0 !important;
        }

        .pl-0 {
            padding-left: 0px !important;
        }

        .pr-0 {
            padding-right: 0px !important;
        }

        .col-10 {
            flex: 0 0 75%;
            max-width: 75% !important;
        }

        .col-2 {
            width: 25% !important;
            flex: 0 0 25%;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .id-container {
            padding-left: 0px;
            border: 1px solid black;
            background: transparent;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .text-left {
            text-align: left !important;
        }

        .p-2 {
            padding: .5rem !important;
        }

        .h-100 {
            height: 100% !important;
        }

        .align-content-center {
            -ms-flex-line-pack: center !important;
            align-content: center !important;
        }

        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .flex-column {
            -ms-flex-direction: column !important;
            flex-direction: column !important;
        }

        .table-bordered {
            border: 1px solid black;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        table {
            border-collapse: collapse;
        }

        .table td {
            padding: 7.5px;
        }

        .table {
            width: 100%;
            margin-bottom: 0px;
            color: #212529;
        }

        @media (min-width: 768px) .container {
            max-width: 720px;
        }

        table {
            border-collapse: collapse;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid black;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
            border: 1px solid black;
        }

        .table td {
            padding: 7.5px;
        }

        .mt-4,
        .my-4 {
            margin-top: 1.5rem !important;
        }

        .col-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .h3,
        h3 {
            font-size: 1.75rem;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
        }

        .h3,
        h3 {
            font-size: 1.75rem;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .position-absolute {
            position: absolute !important;
        }

        .position-relative {
            position: relative !important;
        }

        .d-none {
            display: none !important;
        }

        @media (min-width: 768px) .container {
            max-width: 720px;
        }

        .font-14 {
            font-size: 14px !important;
        }


        /*	my styles*/

        /* CSS Document */
        body {

            font-size: 14px;
        }

        html,
        body {
            width: 250mm;
            height: 353mm;
        }

        .content-container {
            background: transparent
                /* background-attachment: fixed; */
                background-size: cover;
            background-repeat: no-repeat;
        }

        .serial {
            /*
            font-family: 'Aldrich', sans-serif !important;
            font-family: Impact, Haettenschweiler, "Franklin Gothic Bold", "Arial Black", "sans-serif";
        */

        }

        .title-font {
            /*
            font-family: "Flamante SemiSlab Medium", "Flamante SemiSlab Bold" !important;
            font-weight: bold;
            font-family: "night train 315" !important;
            font-family: ClementFivecleme !important;
        */
        }

        .validations-container tr td:first-child {
            color: #00582f;
            font-family: 'Open Sans', sans-serif;
        }

        .green {
            color: #00582f;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: rgb(204, 204, 204);
        }

        page {
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            /*    background: repeating-linear-gradient( 45deg, #039840, #039840 10px, #067332 10px, #067332 20px );*/
            background: url("{{ asset('document_image/bg-image.png') }}");
            background-position: bottom;
            background-size: cover;

        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="B4"] {
            width: 250mm;
            height: 353mm;
        }

        page[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;
        }

        .theqr {
            width: 81px;
        }

        .libre-bold {
            /*    font-family: 'Libre Baskerville', serif;*/
            font-weight: bold;
        }

        .libre-reg {
            font-family: 'Libre Baskerville', serif;
            font-weight: 300;
        }

        .a4-size {
            width: 595px;
            height: 842px;
            background: url("img/Group 31.jpg");
            /* background-attachment: fixed; */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .qr-container {
            width: 105px;
            height: 105px;
            border: 1px solid black;
        }

        .new-qr-container {
            border: 1px solid black;
            padding-bottom: 21px !important;
        }

        p {
            margin-bottom: 7.5px;
        }

        h4 {
            font-size: 15px;
            font-weight: bold;
        }

        header h3 {
            font-size: 27px;
            /*    font-weight: bold;*/
            text-transform: uppercase;
            white-space: nowrap;
        }

        header h5 {
            font-size: 20px;
            font-weight: bold;
            font-family: 'Libre Baskerville', serif;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .duration {
            padding: 7.5px;
            border: 1px solid black;
        }

        .table td {
            padding: 7.5px;
        }

        .issue-date {
            border: 1px solid black;
            border-right: 0px;
        }

        ol {
            list-style-type: lower-alpha;
        }

        .green {
            /*
            display: block;
            height: 8px;
            color: green;
            width: 100%;
            background: #00421B;
            border-bottom: 2px solid #FFDE00;
            margin-bottom: 5px;
        */
        }

        .note {
            font-size: 12px;
        }

        .stamp-qr .the-stamp {
            width: 174px;
            transform: rotate(28deg);
            opacity: 100%;
            left: 0px;
            margin-left: -8px;
        }

        .nbk {
            float: right;
            height: 52px;
            position: absolute;
            right: 15px;
            bottom: 20px;
        }

        .r4-rem {
            margin-right: 4rem;
        }


        .exep {
            color: #dc3545;
        }

        .danger-line {
            background: repeating-linear-gradient(45deg, #ff0101, #ff0101 10px, #dc3545 10px, #dc3545 20px);
            width: 100%;
            height: 3px;
            display: block;
        }

        .libre-it {
            font-family: 'Libre Baskerville', serif;
            font-style: italic;
            font-size: 14px;
            text-transform: capitalize;
        }

        .locence-no,
        .activity-code-bg {
            background: transparent !important;
            border: 1px solid black;
            border-left: none;
        }

        .footer-container {
            position: absolute;
            bottom: 15px;
            font-size: 8px;
            position: absolute;
            bottom: 15px;
            font-size: 8px;
            padding-top: 15px !important;
        }

        .the-seal {
            width: 119px;
            transform: rotate(15deg);
            position: absolute;
            z-index: 2000;
            top: -111px;
            right: -306px;
        }

        .neg2t {
            margin-top: -2%;
        }

        .serial-init {
            /*    font-family: "Flamante SemiSlab Medium", "Flamante SemiSlab Bold" !important;*/
        }

        .serial {
            font-family: Roman !important;
            font-family: ClementFivecleme !important;
            font-weight: bold;
        }

        .font-22 {
            font-size: 22px;
        }

        .stamp-qr {
            display: flex;
            justify-content: space-between;
            margin-top: 12px;
            align-items: baseline;

        }

        .activity-code-bg {
            /*		background: #ff01014a !important;*/
        }

        .the-seal-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            position: relative;
        }

        .font-12 {
            font-size: 12px !important;
        }

        @media print {

            body,
            page {
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none;
                font-size: 18px;
            }

            .print-btn {
                display: none !important
            }

            .stamp {
                opacity: 0.6 !important;
            }

            .content-container {
                width: 100%;
                width: 250mm;
                height: 353mm;
                height: 353mm;
            }


            html,
            body {
                width: 250mm !important;
                height: 353mm !important;
                background: white;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0px !important;
                padding: 0px !important;
            }

            page[size="B4"] {
                width: 250mm !important;
                height: 353mm !important;
                /*    padding: 30mm 30mm 30mm 30mm;*/
                display: flex;
                justify-content: center;
                align-items: center;
                align-content: center;
                height: 100% !important;
                margin: 0px !important;
                /*
            height: 100vh !important;
            width: 100vw !important;
        */
            }


            ol {
                list-style-type: lower-alpha;
            }

            .table-bordered td,
            .table-bordered th {
                border: 1px solid black !important;
            }

            .table-striped tbody tr {
                background: transparent !important;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, .05) !important;
            }

            .title-font {
                font-size: 24px;
            }

            .font-22 {
                font-size: 24px !important;
            }

            .opacity-0 {
                opacity: 0 !important;
            }

            .stamp {
                position: fixed;
                bottom: 82px;
                left: 246px;
                height: 188px;
                transform: rotate(45deg);
                opacity: 0;
            }

            @page {
                /*
            width: 250mm;
            height: 353mm;
        */
                /*   margin: 30mm 30mm 30mm 30mm;*/
            }

            /*	my styles*/

    </style>
</head>

<body>
    <page size="A4" class="p-2 container w-100 h-100">
        <section class="content-container h-100 w-100 position-relative p-2">
            <header>
                <section class="container p-0 m-0">
                    <div class="row">
                        <!--logo container-->
                        <div class="col-12 d-flex title-header green position-absolute"
                            style="justify-content: space-around; align-items: flex-start; text-align: left;">

                            <img src="{{ config('global.narok-assets') }}narok-county.png" class="r4-rem logo">
                            <div class="title" style="margin-top: 2rem;">
                                <h1 class="uppercase">NAROK COUNTY GOVERNMENT</h1>
                                <h3 class="uppercase">SINGLE BUSINESS PERMIT</h3>
                            </div>
                        </div>
                        <div class="col-8">

                        </div>

                        <hr class="mb-0">
                        <!--control number and issue date container-->
                        <div class="col-12 validations-container">
                            <div class="d-flex mt-2 col-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Effective Date</td>
                                        <td>{{ date('jS F Y', strtotime($permit->data[0]->startDate)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Expiry Date</td>
                                        <td>{{ date('jS F Y', strtotime($permit->data[0]->certExpiry)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>Yearly</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </header>

            @if ($permit->data[0]->certType == 'Permanent')
                <!-- /* show if it is provisional */ -->
                <h1
                    style="text-transform: uppercase;font-size: 137px;position: absolute;transform: rotate(45deg);top: 40%;opacity: 23%;font-weight: 700;color: green;">
                    Approved</h1>
                <!-- /* show if it is provisional */ -->
            @else
                <!-- /* show if it is provisional */ -->
                <h1
                    style="text-transform: uppercase;font-size: 137px;position: absolute;transform: rotate(45deg);top: 40%;opacity: 28%;font-weight: 700;color: red;">
                    Provisional</h1>
                <!-- /* show if it is provisional */ -->
            @endif

            <section class="container p-3 m-0">
                <div class="row">
                    <div class="col-12 ">
                        <p class="text-left"><span class="libre-bold green"><span> Narok County Government grants this
                                    business permit to</span></P>
                    </div>
                    <div class="col-10 pr-0">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <!--the name to the busibness-->
                                <tr>
                                    <td>
                                        <p class="p-0 m-0 green">Applicant/Business/Commercial Name</p>
                                        <p class="text-uppercase libre-bold m-0 p-0 title-font">
                                            {{ $permit->data[0]->businessName }}</p>
                                    </td>
                                </tr>

                                <!--the KRA pin-->
                                <tr>
                                    <td><span class="green">KRA Pin: </span><span
                                            class="libre-bold">{{ $permit->data[0]->pinNumber }}</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 mb-1 pl-0">
                        <div
                            class="locence-no max-height d-flex h-100 justify-content-center align-items-center align-content-center p-2 flex-column">
                            <p class="serial-init green">Business ID</p>
                            <p> <span class="serial-init font-22"><span class="d-none">BID</span> <span
                                        class="serial title-font">{{ $permit->data[0]->businessID }}</span></span< /p>
                        </div>
                    </div>
                    <div class="col-10 mt-4 pr-0">
                        <table class="table table-bordered ">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <p class="text-uppercase p-0 m-0 green">To engage in the
                                            activity/Business/Profession or Occupation of</p>
                                        <p class="libre-bold m-0 p-0 serial m-0">
                                            {{ $permit->data[0]->businessActivityName }} </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="title-font ">{{ $permit->data[0]->businessActivityDescription }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 mt-4 pl-0">
                        <div
                            class="activity-code-bg max-height d-flex h-100 justify-content-center align-items-center align-content-center p-2 flex-column">
                            <p class="serial-init green">Activity Code</p>
                            <p> <span class="serial-init font-22"><span
                                        class="title-font">{{ $permit->data[0]->activityCode }}</span></span< /p>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <table class="table table-bordered ">
                            <tbody>
                                <tr>
                                    <td class="text-uppercase green">Having paid a business permit fee of</td>
                                    <td class="title-font"> Ksh {{ number_format($permit->data[0]->feeCharge, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="other-num serial-init" colspan="2"><span class="green">Amount in words
                                        </span>***
                                        {{ ucwords(NumConvert::word((int) $permit->data[0]->feeCharge)) }} shillings
                                        only ***</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="col-12 mt-4">
                        <table class="table table-bordered">
                            <tbody>

                                <tr>
                                    <td colspan="3" class="green">Business under this permit shall be conducted at the
                                        address as indicated below</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><span class="green">P.O. Box : </span><span
                                            class="libre-bold">{{ $permit->data[0]->poBox }}
                                            {{ $permit->data[0]->contactPersonTown }}</span></td>
                                    <td>Plot No. : <span
                                            class="libre-bold title-font">{{ $permit->data[0]->plotNumber }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span class="green">Road Street : </span><span
                                            class="title-font">{{ $permit->data[0]->physicalAddress }}</span></td>
                                </tr>
                                <tr>
                                    <td><span class="green">Building : </span><span
                                            class="libre-bold">{{ $permit->data[0]->building }} </span></td>
                                    <td><span class="green">Floor : </span><span
                                            class="libre-bold">{{ $permit->data[0]->floor }} </span></td>
                                    <td><span class="green">Door/Stall No. : </span><span
                                            class="libre-bold">{{ $permit->data[0]->houseNumber }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row m-0">
                            <div class="col-6 p-0">
                                <div>
                                    <div class="p-2 issue-date">
                                        <span class="d-none">License Covers For:</span>
                                        <hr class="py-0 my-0 d-none">
                                        <p class="d-none">Fire License</p>
                                        <hr class="py-0 my-0 d-none">
                                        <p class="d-none">Food Hygiene License</p>
                                        <hr class="py-0 my-0 d-none">
                                        <p class="d-none">Advertisement License</p>
                                    </div>
                                </div>

                                <div>

                                    @if ($permit->data[0]->certType == 'Permanent')
                                        <!-- /* show for approved permits */ -->
                                        <div class="p-2 issue-date" style="border-top: 0px !important;">
                                            <span class="green d-none">Issuing officer: </span><span
                                                class="d-none">Moses Minchil</span>
                                            <br>
                                            <span class="green d-none">Designation: </span><span class="d-none">Director
                                                Revenue</span>
                                            <span class="green ">On behalf of the Finance Department</span>
                                        </div>

                                        <!-- /* show for approved permits */ -->


                                    @else
                                        <!-- /* show if it is provisional */ -->
                                        <div class="p-2 issue-date" style="border-top: 0px !important;">
                                            <span class="green">Provisional trade license</span>
                                            <br>
                                            <span class="green">*** Awaiting approval ***</span>
                                        </div>

                                        <!-- /* show if it is provisional */ -->
                                    @endif

                                </div>


                                <div>
                                    <div class="p-2 issue-date" style="border-top: 0px !important;">

                                        <span class="green">Date of Issue:
                                        </span><br><span>{{ date('l jS \of F Y h:i:s A') }}</span>
                                    </div>
                                </div>
                                <div class="w-100 the-seal-container">
                                    <img src="{{ config('global.narok-assets') }}approved3.png" class="the-seal">
                                </div>
                            </div>

                            <div class="col-6 p-0">
                                <div class="new-qr-container p-2">

                                    @if ($permit->data[0]->certType == 'Permanent')
                                        <!-- /* show for approved permits */ -->
                                        <p class="green">By order of</p>
                                        <!-- /* show for approved permits */ -->
                                    @else
                                        <!-- /* show if it is provisional */ -->
                                        <p class="green">Provisional</p>
                                        <!-- /* show if it is provisional */ -->
                                    @endif

                                    <div class="stamp-qr">

                                        @if ($permit->data[0]->certType == 'Permanent')
                                            <!-- /* show for approved permits */ -->
                                            <img src="{{ config('global.narok-assets') }}generic-sign.png"
                                                alt="The RBC logo" class="the-stamp">
                                            <!-- /* show for approved permits */ -->
                                        @else


                                        @endif

                                        <img class="mb-2 float-left theqr">{!! QRCode::size(110)->generate($permit->data[0]->businessID) !!}</img>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <p class="red font-14">
                                    Notice: Granting this permit <strong>DOES NOT EXEMPT</strong> the business
                                    identified above from complying with current regulations on Health and safety as
                                    established by the Government of Kenya and the <strong>COUNTY GOVERNMENT OF
                                        NAROK.</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--the sseal-->
                </div>
            </section>

            <img src="{{ asset('img/RBC-COLOR.png') }}" class="nbk d-none">


        </section>

    </page>
    <button class="print-btn" onclick="window.print()"><img src="{{ asset('document_image/printer.svg') }}"
            alt="Printer Icon"></button>
</body>

</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title>Seasonal parking stickers</title>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style type="text/css">
        .column {
            width: 45%;
            float: left;
            margin-left: 1%;
        }

        .border {
            border-style: solid;
            padding: 1%;
            margin-top: 1%;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }

        @page {
            margin: 0;
        }

    </style>
</head>

<body>
    <!-- <img style="position:absolute;top:0.77in;left:4.63in;width:4.30in;height:2.59in" src="{{ asset('stickers/vi_1.png') }}" /> -->
    @foreach ($receipt->payment_details as $payment)
        <div class="column border">
            <div>
                <img height="80" width="80" src="{{ asset('stickers/ri_1.png') }}" style="float: left;" />
                <span
                    style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Times;color:#000000;margin-left: 1%">NAIROBI
                    CITY COUNTY</span>
                <br />
                <span
                    style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Helvetica;color:#000000;margin-left: 2%">
                    Tel No: 0725-624489</span>
                <br>
                <span
                    style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Helvetica;color:#000000;margin-left: 2%">
                    Email: info@nairobi.go.ke</span>
                <br />
                <span
                    style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000;margin-left: 4%">Date
                    Issued: {{ $payment->effective_date }}</span>
            </div>
            <br>
            <span
                style="font-style:normal;font-weight:normal;font-size:11pt;font-family:Times;color:#000000;text-decoration: underline;">SEASONAL
                PARKING TICKETS</span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Receipt Number: </b>
                {{ $receipt->receipt_number }}</span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Paid By:</b>
                {{ $receipt->payment_from }}</span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Registration Number:</b>
                {{ $payment->registration_number }} <div style="float: right;">{!! QRCode::size(144)->generate($receipt->receipt_number) !!}</div></span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Vehicle Category:</b>
                {{ $payment->vehicle_category }}</span>
            <br>

            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Duration:</b>
                {{ $payment->duration }}</span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Amount:</b>
                {{ number_format($payment->amount) }}</span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Start Date:</b>
                {{ $payment->effective_date }} <b>Expiry Date:</b> {{ $payment->expiry_date }} </span>
            <br>
            <span style="font-style:normal;font-size:10pt;font-family:Times;color:#000000"><b>Served By:</b>
                {{ explode(' ', Session::get('resource')['user_full_name'])[0] }}</span>
            <br>
            <img style="float: right;" src="{{ asset('stickers/ri_3.png') }}" />
        </div>
    @endforeach

</body>

</html>

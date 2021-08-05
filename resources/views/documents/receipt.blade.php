<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel='icon' href="{{ asset('https://narok.regionalbusinessconnection.com/assets/ narok-county.png') }}"
        type='image/x-icon' />

    <style>
        .print-btn {
            display: flex;
            z-index: 1000000000;
            position: absolute;
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
            box-shadow: 1px 0px 20px 4px rgb(136 136 136 / 0.65);
            cursor: pointer;
            transition: 0.4s;

        }

        .print-btn img {
            height: 35px;
        }

        .print-btn:hover {
            transform: scale(1.2);
        }


        @media print {
            body {
                background: white !important;
            }

            @page {
                size: auto;
                /* auto is the initial value */
                margin: 0;
                /* this affects the margin in the printer settings */
            }

            /* All your print styles go here */
            .print-btn {
                display: none !important;
            }
        }

    </style>
</head>

<body
    style="background: repeating-linear-gradient(45deg, #0398408a, #039840a3 10px, #00421ba3 10px, #00421b9e 20px); background-repeat: no-repeat;min-height: 100vh; margin: 0px;">
    <main
        style="width: 6.368in;height: auto;min-height: 6.5in; background-color: white; border-style:solid 4px; border-color: black; padding: 15px;">
        <img style="position:absolute;top:0.50in;left:0.37in;width:1.07in;height:auto"
            src="{{ asset('https://narok.regionalbusinessconnection.com/assets/narok-county.png') }}" />
        <div style="position:absolute;top:0.47in;left: 1.65in;width:3.99in;line-height:0.38in;"><span
                style="font-style:normal;font-weight:bold;font-size:18pt;font-family:Times;color:#000000">Narok County
                Government</span><span
                style="font-style:normal;font-weight:bold;font-size:22pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 0.93in;left:1.65in;width: 100%;line-height:0.13in;"><span
                style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"><strong>Support
                    Tel
                    No:</strong>
                0724578157 | 0115560572 </span><span
                style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>



        <div style="position:absolute;top:1.06in;left: 1.65in;width: 100%;line-height:0.13in;"><a
                href="mailto:payments@regionalbusinessconnection.com"><span
                    style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"><strong>Email:</strong>
                    payments@regionalbusinessconnection.com</span></a>
            <span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN>
        </div>
        <div style="position:absolute;top:1.18in;left: 1.65in;/* width: 100%; */line-height:0.13in;">
            <span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"><strong>Support
                    Email:</strong></span>
            <span
                style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">support@regionalbusinessconnection.com</span></SPAN>
        </div>
        <div style="position:absolute;top:1.33in;left: 1.65in;width:100%;line-height:0.13in;"><span
                style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"><strong>Office
                    line (Business hours)</strong>
                0787036132</span><span
                style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN>
        </div>

        <div>
            {{-- <img style="height: 61px;position: absolute;left: 5.4in;top: 0.6in;" src="{{ config('global.narok-assets') }}QRCode.png"> --}}
            <div style="position: absolute;left: 5.4in;top: 0.6in;">{!! QRCode::size(85)->generate($receipt->receiptInfo->receiptSecurityCode) !!}</div>
        </div>
        <div style="position:absolute;top:2.02in;left: 0.43in;width:3.84in;line-height:0.22in;"><span
                style="font-style:normal;font-weight:normal;font-size:13pt;font-family:Times;color:#000000;white-space: nowrap; text-transform: uppercase;">RECEIPT
                FOR {{ $receipt->receiptInfo->incomeTypeDescription }}</span><span
                style="font-style:normal;font-weight:normal;font-size:13pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top: 2.23in;left: 0.43in;width: 5.6in;height:0.02in;" src="receipt/vi_1.png" />
        <div style="position:absolute;top:2.46in;left:0.43in;width:0.75in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Receipt
                No.</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 2.41in;left:2.15in;width:1.06in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000; white-space:nowrap">{{ $receipt->receiptInfo->receiptNo }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:2.57in;left:1.16in;width: 3.1in;height: 0.02in;" src="receipt/vi_1.png" />
        <div style="position:absolute;top:2.46in;left:4.29in;width:0.34in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Date</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 2.42in;left:4.72in;width:1.07in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000">{{ date('d/m/Y', strtotime($receipt->receiptInfo->receiptDate)) }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:2.57in;left:4.72in;width:1.30in;height: 0.03in;" src="receipt/vi_3.png" />
        <div style="position:absolute;top:2.85in;left:0.43in;width:1.54in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Payment
                received
                from</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top:2.80in;left:2.19in;width:0.91in;line-height:0.12in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000;white-space:nowrap">{{ $receipt->receiptInfo->paidBy }}</span><span
                style="font-style:normal;font-weight:bold;font-size:7pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:2.96in;left:1.97in;width: 2.3in;height: 0.03in;" src="receipt/vi_4.png" />
        <div style="position:absolute;top:2.85in;left:4.29in;width:0.41in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000;white-space:nowrap">of
                KES</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 2.8in;left: 4.8in;width:0.45in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000;white-space:nowrap">{{ number_format($receipt->receiptInfo->receiptAmount) }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:2.96in;left: 4.8in;width:1.08in;height:0.03in;" src="receipt/vi_5.png" />
        <div style="position:absolute;top:3.24in;left:0.43in;width:0.61in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">In
                words</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top:3.22in;left:1.63in;width:0.21in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">***</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 3.18in;left:1.89in;width:1.35in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000;white-space:nowrap">KES
                {{ strtoupper(NumConvert::word((int) $receipt->receiptInfo->receiptAmount)) }} ONLY ***</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:3.35in;left:0.98in;width:5.03in;height:0.03in" src="receipt/vi_6.png" />
        <!-- <img style="position:absolute;top:3.39in;left:2.34in;width:1.77in;height:1.77in" src="t0.png" /> -->
        <div style="position:absolute;top:3.62in;left:0.43in;width:0.27in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">For</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 3.57in;left:1.0in;width:0.68in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:11pt;font-family:Times;color:#000000;white-space:nowrap">{{ $receipt->receiptDetail[0]->briefDescription }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>

        <div style="position:absolute;top: 3.95in;left:0.43in;width:1.56in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Fee
                Description</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div style="position:absolute;top: 3.90in;left: 1.5in;width:0.45in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:11pt;font-family:Times;color:#000000;white-space:nowrap">{{ $receipt->receiptDetail[0]->feeAccountDesc }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:3.73in;left:0.73in;width:5.29in;height:0.03in" src="receipt/vi_7.png" />
        <img style="position:absolute;top: 4.11in;left:1.45in;width: 3.44in;height:0.03in;"
            src="{{ asset('receipt/vi_7.png') }}" />


        <img style="position:absolute;top:3.73in;left:0.73in;width:5.29in;height:0.03in"
            src="{{ asset('receipt/vi_7.png') }}" />
        <div style="position:absolute;top:4.38in;left:0.43in;width:0.56in;line-height:0.17in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Paid
                via</span><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>


        <div style="position:absolute;top: 4.29in;left: 1.1in;width:0.45in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Times;color:#000000;white-space:nowrap">{{ $receipt->receiptInfo->paymentMode }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <img style="position:absolute;top:4.5in;left:1.07in;width: 1.95in;height:0.03in;"
            src="{{ asset('receipt/vi_8.png') }}" />
        <img style="position:absolute;top:4.29in;left:3.86in;width:2.16in;height:0.27in"
            src="{{ asset('receipt/vi_9.png') }}" />

        <div style="position:absolute;top: 4.1in;left: 4.99in;width: auto;height:0.27in;">
            <span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000;white-space: nowrap;">Amount
                In KES</span>
            <span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000"> </span>
        </div>

        <div style="position:absolute;top:4.38in;left:3.91in;width:0.67in;line-height:0.14in;">
            <span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000;white-space: nowrap;">Billed</span>
            <span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000"> </span>
        </div>
        <div
            style="position:absolute;top:4.38in;left: 4.5in;width: 1.45in;line-height:0.14in;text-align: right;/* background: red; */">
            <span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">{{ number_format($receipt->receiptInfo->billAmount) }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN>
        </div>
        <img style="position:absolute;top:4.55in;left:3.86in;width:2.16in;height:0.27in" src="receipt/vi_10.png" />
        <div style="position:absolute;top:4.64in;left:3.91in;width:0.95in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000;white-space: nowrap;">Paid</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div
            style="position:absolute;top:4.64in;left: 4.5in;width: 1.45in;line-height:0.14in;text-align: right;/* background: red; */">
            <span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">{{ number_format($receipt->receiptInfo->receiptAmount) }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN>
        </div>
        <img style="position:absolute;top:4.81in;left:3.86in;width:2.16in;height:0.27in" src="receipt/vi_11.png" />
        <div style="position:absolute;top:4.90in;left:3.91in;width:0.44in;line-height:0.14in;"><span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">Balance</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN></div>
        <div
            style="position:absolute;top:4.90in;left: 4.5in;width: 1.45in;line-height:0.14in;text-align: right;/* background: red; */">
            <span
                style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Times;color:#000000">{{ number_format($receipt->receiptInfo->billBalance) }}</span><span
                style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Times;color:#000000">
            </span><br /></SPAN>
        </div>
        <!--
<div style="position:absolute;top:5.26in;left:0.43in;width:0.50in;line-height:0.13in;"><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">Served by</span><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"> </span><br/></SPAN></div>
<div style="position:absolute;top:5.26in;left:1.07in;width:0.09in;line-height:0.13in;"><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">Admin</span><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"> </span><br/></SPAN></div>
<div style="position:absolute;top:5.26in;left:1.72in;width:1.27in;line-height:0.13in;"><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">Bill No </span></SPAN><br/></div>
<div style="position:absolute;top:5.26in;left:1.72in;width:1.27in;line-height:0.13in;"><DIV style="position:relative; left:0.43in;"><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">{{ $receipt->receiptInfo->billNo }}</span><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"> </span><br/></SPAN></DIV></div>
<div style="position:absolute;top:5.26in;left:3.44in;width:1.45in;line-height:0.13in;"><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">printed <?php echo date('Y-m-d h:i:sa'); ?></span><span style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000"> </span><br/></SPAN></div>
<img style="position:absolute;top:5.15in;left:5.15in;width:0.64in;height:0.34in" src="receipt/ri_2.png" /> -->
        <br>

        <div style="position:absolute;top:5.26in;left:0.43in;width:0.50in;line-height:0.13in;">
            <div style="display: flex; justify-content:space-between; align-items: center; width:5.59in;">
                <span>
                    <span
                        style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000;  white-space: nowrap;">Served
                        by</span>
                    @if (!is_null(Session::get('resource')))
                        <span
                            style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000; white-space: nowrap;">{{ Session::get('resource')['user_full_name'] }}</span>
                    @else
                        <span
                            style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000;  white-space: nowrap;">Self
                            service portal

                        </span>
                    @endif
                </span>
                <span>
                    <span
                        style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000; white-space: nowrap;">Bill
                        No :</span>
                    <span
                        style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000">{{ $receipt->receiptInfo->billNo }}</span>
                </span>
                <span
                    style="font-style:italic;font-weight:normal;font-size:8pt;font-family:Times;color:#000000; white-space: nowrap;">Printed:
                    <?php echo date('Y-m-d h:i:sa'); ?>
                </span>
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <span style="color: #313350 !important; font-size: 10px;">Powered By</span>
                    <img src="{{ config('global.narok-assets') }}RBC-COLOR.png" style="height:20px; width: 45px">
                </div>
            </div>
        </div>
        <br>

        @if ($receipt->receiptInfo->printCount >= 1)
            <h1 style="font-size: 215px;opacity: 0.2;transform: rotate(45deg);">Copy</h1>
        @endif
    </main>

    <button class="print-btn" onclick="window.print()"><img src="{{ config('global.narok-assets') }}printer.svg"
            alt="Printer Icon"></button>
</body>

</html>

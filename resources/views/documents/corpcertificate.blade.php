<!DOCTYPE html>
<html>
<head>
<title> {{ config('global.siteTitle') }}</title>
<link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style type="text/css">
.fab img {
    width: auto;
    height: 35px;
}
.fab {
    width: 70px;
    height: 70px;
    background-color: #060096;
    border-radius: 50%;
    box-shadow: 0 6px 10px 0 #666;
    font-size: 50px;
    line-height: 70px;
    color: white;
    text-align: center;
    position: fixed;
    right: 50px;
    bottom: 50px;
    z-index: 1000;
    transition: all 0.1s ease-in-out;
    border: none;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}
.d-none{
	display: none !important;
}
.fab:hover {
    box-shadow: 0 6px 14px 0 #666;
    transform: scale(1.05);
}
	table {border-collapse: collapse;}
	table td {padding: 0px}
	@font-face {
font-family: "Libre Baskerville";
src: url("");
src: url("fonts/librebaskerville-bold-webfont.woff") format("woff");
}

@media print {
	.fab{
		display:none !important;
	}

  body { margin: 0cm !important; }
}


</style>
</head>


<body style="margin: 0px !important;">
	<button class="print-btn fab"><img src="{{asset('cert/print copy.png')}}"></button>
    @foreach($getCorporateFoodHandlerCerts->data as $item)
	<div class="cert-container" style="position:relative;margin:0pc !important;display: flex;height: 16.18in;width: 10.89in;margin-bottom: 1in !important;">

		<img style="position:absolute;top: 0in;left: 0in;width: 10.89in;height: 16.18in;" src="{{asset('cert/ci_1.png')}}" />
		<img style="position:absolute;top: 0in;left: 0in;width: 10.89in;height: 16.18in;" src="{{asset('cert/green-bg.png')}}">
		<img style="position:absolute;top: 0.1in;left: 0.1in;width: 10.71in;height: 15.97in;" src="{{asset('cert/ri_1.png')}}" />

		<img style="position:absolute;top:0.70in;left: 0.53in;width:2.84in;height:3.35in;" src="{{asset('cert/ri_2.png')}}" />
		<img style="position:absolute;top:1.97in;left:3.71in;width: 6.8in;height:0.09in;" src="{{asset('cert/ci_3.png')}}" />
		<img style="position:absolute;top:2.04in;left:3.71in;width: 6.8in;height:0.02in;" src="{{asset('cert/ci_4.png')}}" />


		<div style="position:absolute;top:0.73in;left:3.71in;width:6.24in;line-height:0.69in;"><span style="font-style:normal;font-weight:bold;font-size:37pt;font-family:Libre Baskerville;color:#212529">Nairobi City County</span><span style="font-style:normal;font-weight:bold;font-size:37pt;font-family:Libre Baskerville;color:#212529"> </span><br></div>

		<div style="position:absolute;top:1.51in;left:3.71in;/* width:3.87in; */line-height:0.38in;"><span style="font-style:normal;font-weight:bold;font-size:20px;font-family:Libre Baskerville;color:#212529">The Food, Drugs And Chemical Substances Act  (CAP. 254)</span><span style="font-style:normal;font-weight:bold;font-size:20pt;font-family:Libre Baskerville;color:#212529"> </span><br></div>

		<img style=style="position:absolute;top:2.13in;left:3.71in;width:0.18in;height:0.18in" src="{{asset('cert/ci_5.png')}}" />

		<div style="position:absolute;top:2.23in;right: 0.37in;width: 100%;/* line-height:0.27in; */text-align: right;"><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Aldrich;color:#212529;text-align: right;">Cert ID No: {{$item->certId}}</span><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Aldrich;color:#212529"> </span><br></div>

		<div style="position:absolute;top: 2.23in;left: 3.71in;width:0.70in;line-height:0.27in;"><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family: 'Aldrich', sans-serif;color:#212529">AW{{Session::get('health')['ApplicantId']}}</span><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Aldrich;color:#212529"></span><br/></div>
		<div style="position:absolute;top:5.35in;/* left:3.65in; */width: 100%;line-height:0.60in;display: flex;justify-content: center;max-width: 10.89in;">
		<span style="font-style:normal;font-weight:normal;font-size:30pt;font-family: 'Norican', cursive;color:#212529">Certificate Of Medical Examination</span><br/>

		</div>
		<div style="position:absolute;top:6.15in;/* left:5.33in; */width: 100%;line-height:0.56in;display: flex;justify-content: center;max-width: 10.89in;"><span style="font-style:normal;font-weight:bold;font-size:30pt;font-family:Libre Baskerville;color:#212529">FORM D</span><span style="font-style:normal;font-weight:bold;font-size:30pt;font-family:Libre Baskerville;color:#212529"> </span><br></div>





Corporate has no people registered
<!-- <div style="position:absolute;top:7.62in;left:0.36in;width:0.71in;line-height:0.22in;"><span style="font-style:normal;font-weight:bold;font-size:12pt;font-family:Libre Baskerville;color:#212529">Details</span><br/>
</div>
 -->

 {{-- new text --}}

<div style="position:absolute;top:7.34in;left: 0.53in;right: 0.53in;max-width: 9.83in;width: 100%;line-height:0.33in;">
	<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">
	I hereby certify that I have examined  <span class="content-field" style="font-style:normal;font-weight: bolder;font-size:15pt;font-family:Share Tech Mono;color:#000000;text-decoration: underline;"> {{ $item->firstName }}  {{ $item->otherNames }} </span> of ID No. <span class="content-field" style="
    font-style: normal;font-weight: bolder;font-size: 15pt;font-family: Share Tech Mono;color: #000000;text-decoration: underline;">{{ $item->idNo }}</span> and that in my opinion (s)he
is fit under the Food, Drugs and Chemical Substances (Food Hygiene Regulations) to work at:
</span>
<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br></div>

{{-- new text --}}
<div style="position:absolute;top: 8.4in;left: 0.53in;width:5.35in;line-height:0.34in;">
	<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Company: </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">{{$item->businessName}}</span><span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br>
  <span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Business ID:</span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">{{$item->businessID}} </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">
	</span><br>
  <span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Subcounty: </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">{{$item->subCountyName}}</span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br>
	<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Ward: </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">{{$item->wardName}}</span>
	<br/>
</div>


<div style="position:absolute;top: 10in;left:0.53in;width:5.36in;line-height:0.31in;">
	<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Examined At:  </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">Clinic Name</span>
	<br/>
	<span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Document No: </span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529">{{$item->receiptNo}}</span><br/>
</div>

<div class="d-none" style="position:absolute;top:11.48in;left:0.53in;width:0.60in;line-height:0.33in;"><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Sign:</span><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br/>
</div>

<img style="position:absolute;top:11.09in;left:1.09in;width:0.62in;height:0.69in" src="{{asset('cert/ri_3.png')}}" />

<div class="d-none" style="position:absolute;top:11.91in;left:0.53in;width:2.91in;line-height:0.32in;"><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Medical Officer Of Health</span><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br/><span style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Fira Sans;color:#212529">Date:</span><span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529"> {{date('d-m-Y', strtotime($item->startDate))}}</span><span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans;color:#212529"> </span><br/>
</div>

<img style="position:absolute;top: 8.99in;left: 7.93in;width: 2.4in;height: auto;" src="{{asset('cert/ri_4.png')}}"/>

<img style="position:absolute;top: 14.09in;left: 0.4in;width: 1.8in;height: auto;" src="{{asset('cert/ri_5.png')}}"/>

<div style="position:absolute;top: 14.65in;left:2.69in;line-height:0.31in;font-weight: 300;">
	<span style="font-style:normal;font-weight: 800;font-size: 12px;font-family: Fira Sans;color:#212529;">NB: This Certificate is valid for Six (6) Months only</span><span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans Black;color:#212529"> </span><br/><span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans Black;color:#212529"> </span><br/>
</div>

<div style="position:absolute;top:11.56in;left:9.26in;height:2.14in">{!! QRCode::size(144)->generate($item->receiptNo); !!}<br><b style="font-style:normal;font-weight:normal;font-size:15pt;font-family:Aldrich;color:#000000;text-align: right;">Serial no: {{$item->id}}</b></div>

<div style="position:absolute;top: 14.5in;left: 9.0in;/* width: 100%; */line-height:0.53in;color: red;">
	<span style="font-style:normal;font-weight:bold;font-size: 14px;font-family: Fira Sans;color:#212529;color: red;text-align: right;">Expiry Date: {{ date('Y-m-d', strtotime(str_replace('.', '/', $item->certExpiry))) }}</span>
	<span style="font-style:normal;font-weight:bold;font-size:15pt;font-family:Fira Sans Black;color:#212529"> </span>
	<br/>
</div>
<img style="position:absolute;top: 15.4in;left:0.53in;width: 10in;height:0.01in;" src="{{asset('cert/ci_11.png')}}" />

<div style="position:absolute;top: 15.50in;left: 0.50in;/* width:3.33in; */line-height:0.23in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">City Hall</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">, | Po Box 30075-00100 Nairobi, Kenya</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529"> </span><br>
</div>
<div style="position:absolute;top: 15.50in;left: 6.1in;width:5.21in;line-height:0.23in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">Governors Office</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">,</span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">F:</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">12562 </span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">T:</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">12562 | </span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">F:</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">12562 </span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Fira Sans;color:#212529">E:</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529">Governor@Nairobicity.Go.Ke</span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Fira Sans;color:#212529"> </span><br>
</div>
</div

    </div>

	@endforeach

	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

<script>
	$('.print-btn').on('click',function(){
		window.print();
	})

</script>
</body>


</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use NumConvert;
use App\Receipt;
//use Session;
use Illuminate\Support\Facades\Session;

use PDF;

class SBPController extends Controller
{
    //url for business permits
    protected $url = "https://biller.revenuesure.co.ke/";

    public function printReceipt(Request $request)
    {
      $url = config('global.trade-license');
      $data = [
        'function'=>'getReceipt',
        'billNo'=>$request->billNo
      ];

      $this->data['receipt'] = json_decode($this->trade_curl($url, $data));
        $receipt = $this->data['receipt']->data[0];
        if ($this->data['receipt']->status ===200) {
            return view(  'documents.receipt', ['receipt'=> $receipt]);
        }else{
            return Redirect::back()->withErrors($this->data['receipt']->message);
        }
    }

    public function allPrints($pay_id)
    {
        // $url = $this->url . 'clinics';
        // $data = [];
        // $clinics = json_decode($this->clinics_curl($url, $data));

        return view('nakuru-sbp.all-printables', compact('pay_id'));
    }

    public function billPayment(Request $request)
    {
      $url = config('global.bill-payment');

      $data = [
        'function'=>'CustomerPayBillOnline',
        'PayBillNumber'=>272525,
        'Amount'=> $request->Amount,
        'PhoneNumber' => $request->phoneNumber,
        'AccountReference' => $request->paymentCode,
        'TransactionDesc' => $request->accNo,
        'json'=>true
      ];

      //dd($data);

      $payment_info = json_decode($this->trade_curl($url, $data));
      //dd($payment_info);
      return response()->json(['success'=>$payment_info]);

    }

    public function getOverallReceipt($pay_id)
    {
      //$url = $this->url. 'getreceipt';
      $url = config('global.bill-payment');

        $data = [
            'function'=>'checkPaymentVerification',
            'account_reference' => $pay_id,
        ];

        //dd($data);
        $checkPaymentVerification = json_decode($this->trade_curl($url, $data));
        //dd($checkPaymentVerification);
        return response()->json(['success'=>$checkPaymentVerification]);
    }

    public function registerBusinessForm()
    {
      $url = config('global.trade-license');
      $data=[
        'function'=>'getPostalCodes',
      ];

    	$postal_info = json_decode($this->trade_curl($url,$data));
    	//dd($postal_info);

      if(is_null($postal_info))
      {
        return redirect()->back()->withErrors('We are unable to pull postal addresses. Kindly try later');
      }

      if($postal_info->success != true)
      {
          return redirect()->back()->withErrors($postal_info->message);
      }

      //      $url = $this->url. 'permit/api/sbp/subcountys';
      //      $sub_info = json_decode($this->get_curl($url));

      $url = config('global.demographics');

       $data=[
         'function'=>'getSubCounty',
           'countyCode'=>33
       ];

    	 $sub_info = json_decode($this->trade_curl($url,$data));

      //dd($sub_info);

      if(is_null($sub_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }
      //      if($sub_info->status_code != 200)
      if($sub_info->success === false)
      {
          return redirect()->back()->withErrors($sub_info->message);
      }

    	$url = config('global.trade-license');


      $data=[
        'function'=>'getCategoryCharges',
      ];

    	$act_info = json_decode($this->trade_curl($url,$data));

      //dd($act_info);

      if(is_null($act_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($act_info->success === false)
      {
          return redirect()->back()->withErrors($act_info->message);
      }

      $data=[
        'function'=>'getDocuments',
      ];


      $doc_info = json_decode($this->trade_curl($url,$data));

      if(is_null($doc_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($doc_info->success != true)
      {
          return redirect()->back()->withErrors($doc_info->message);
      }

    	// dd($act_info->response_data);
    	$postalcodes = $postal_info->data;
    	$subcounties = $sub_info->data;
    	$business_activities = $act_info->data;
    	$documents = $doc_info->data;

      $data = [
        'postalcodes' => $postalcodes,
        'subcounties' => $subcounties,
        'business_activities' => $business_activities,
        'documents' => $documents,
      ];


    	// dd($postalcodes);
      return response()->json($data);
    }

    public function getPostalName($id)
    {
      $url = config('global.trade-license');
      $data=[
        'function'=>'getPostalCodes',
        'postalID'=>$id
      ];

    	$postal_info = json_decode($this->trade_curl($url,$data));

      //dd($postal_info);

      if(is_null($postal_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($postal_info->success != true)
      {
          return redirect()->back()->withErrors($postal_info->message);
      }

    	return response()->json($postal_info->data);

    }

    public function getWards(Request $request)
    {
    	$url = config('global.demographics');
    	$data =
    	[
        'function'=>'getWards',
        'subCountyCode' => $request->subcountyID,
    	];


      //dd($data);
      $ward_info  = json_decode($this->trade_curl($url, $data));

      //dd($ward_info);
      if(is_null($ward_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($ward_info->success === false)
      {
          return redirect()->back()->withErrors($ward_info->message);
      }

    	return response()->json($ward_info);
    }

    public function getActivityDetail($id)
    {
    	$url = config('global.trade-license');

    	$data = [
        'function'=>'getSubCategoryCharges',
    		'parentBrimsCode' => $id
    	];

    	$subs = json_decode($this->trade_curl($url, $data));
      if(is_null($subs))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($subs->success === false)
      {
          return redirect()->back()->withErrors($subs->message);
      }

    	// dd($subs);

    	return response()->json($subs);
    }

    public function registerTradeLicense(Request $request)
    {
      // dd($request->all());

        $url = config('global.trade-license');

        $data = [
          'function'=>'registerBusiness',
          'businessName'=>$request->RegBusinessName,
          'telephone1'=>$request->telephone1,
          'telephone2'=>$request->telephone2,
          'FaxNumber'=>$request->faxNumber,
          'email'=>$request->email,
          'newphysicalAddress'=>$request->newphysicalAddress,
          'plotNumber'=>$request->newplotNumber,
          'contactPersonDesignation'=>$request->contactPersonDesignation,
          'contactPersonPOBox'=>$request->contactPersonPOBox,
          'contactPersonPostalCode'=>$request->contactPersonPostalCode,
          'contactPersonTown'=>$request->contactPersonTown,
          'contactPersonTelephone1'=>$request->contactPersonTelephone1,
          'contactPersonTelephone2'=>$request->contactPersonTelephone2,
          'contactPersonFaxNumber'=>$request->contactPersonFaxNumber,
          'businessActivityDescription'=>$request->businessActivityDescription,

          'otherBusinessClassificationDetails'=>$request->otherBusinessClassificationDetails,
          'premisesArea'=>$request->premisesArea,
          'numberOfEmployees'=>$request->numberOfEmployees,
          'activityCode'=>$request->newactivityCode,
          'zoneCode'=>$request->NewSubcounty,
          'wardCode'=>$request->NewwardCode,
          'relativeSize'=>$request->relativeSize,
          'building'=>$request->newbuildingName,

          'floor'=>$request->newfloor,
          'houseNumber'=>$request->newhouseNumber,
          'businessRegistrationNo'=>$request->ceriOfIncorporation,
          'pinNumber'=>$request->KRAPin,
          'vatNumber'=>$request->VatNumber,
          'poBox'=>$request->pobox,
          'postalCode'=>$request->postalCode,

          'idTypeCode'=>$request->idTypeCode,
          'town'=>$request->postalTown,
          'idDocumentNumber'=>$request->idDocumentNumber,
          'updatedBy'=>$request->updatedBy,
          'operationalStatus'=>$request->operationalStatus,
        ];

        // dd($data);
        $this->data['TradeLicense'] = json_decode($this->trade_curl($url,$data));
      // dd($this->data);

        if(is_null($this->data))
        {
          return redirect()->back()->withErrors('Something went wrong. Please try again.');
        }

        if($this->data['TradeLicense']->status != 200)
        {
            return redirect()->back()->withErrors($this->data['TradeLicense']->message);
        }else {
            // return view('nakuru-sbp.registration-bill')->with($this->data);
            return response()->json($this->data);

        }

    }

    public function printTradeBill($id)
    {
        $url = config('global.trade-license');

        //dd($businessID);
        $data = [
            'function'=>'getBill',
            'billNo' => $id
        ];


        //dd($data);
        $bill_info = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($bill_info);

        if(empty($bill_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your bill. Please try again later");
        }
        if($bill_info->success !=true)
        {
            return response()->json($bill_info->message);
        }

        $bill = $bill_info->data;

        $data = [
            'bill' => $bill,
        ];

        $pdf = PDF::loadView('bills.bill', $data);
        return $pdf->stream('bill.pdf',array('Attachment'=>0));
        //return view('bills.trade-bill', ['bill' => $bill]);
    }

    public function registerBusiness(Request $request)
    {
    	dd($request->all());

    	$url = $this->url . 'permit/api/sbp/registersbp';

    	$data = $request->all();

    	$registered = json_decode($this->register_curl($url,$data));

      // dd($registered);

      if(is_null($registered))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($registered->status_code != 200)
      {
          return redirect()->back()->withErrors($registered->message);
      }

      $url = $this->url. 'permit/api/sbp/getbillinfos';

      $data = [
        'BillNo' => $registered->response_data->bill_number];

      $bill_info = json_decode($this->bill_curl($url, $data));

      // dd($bill_info);
      if(is_null($bill_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($bill_info->status_code != 200)
      {
          return redirect()->back()->withErrors($bill_info->message);
      }

      $data = [
        'businessName' => $request->BusinessName,
        'PINNumber' => $request->PINNumber,
        'businessActivity' => $request->businessActivity,
        'bill_number' => $bill_info->response_data->BillNo,
        'total' => $bill_info->response_data->BillTotal,
        'business_id' => $bill_info->response_data->RentIdentifier,
      ];

      // return view('sbp.confirm-details', $data);
      return response()->json($data);

    }

    public function getSBPcharges($id)
    {
        $url = config('global.trade-license');

        $data = [
          'function'=>'getOtherCharges',
          'brimsCode' => $id
        ];

        $sbp_charges = json_decode($this->trade_curl($url, $data));

        return response()->json($sbp_charges->data);
    }

    public function payment(Request $request)
    {
      $url = $this->url . 'permit/api/sbp/paypermit';

      $data = [
        'BillNo' => $request->bill_number,
        'PhoneNumber' => $request->phone_number,
      ];

      $pay_info = json_decode($this->pay_curl($url,$data));

      // dd($pay_info);
      if(is_null($pay_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($pay_info->status_code != 200)
      {
          return redirect()->back()->withErrors($pay_info->message);
      }

      return response()->json($pay_info);

    }

    public  function renewBusinessPermit()
    {
      if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }else{
        return view('sbp.renew-business-permit');
      }
    }

    public function update(Request $request)
    {
        # code...
        $formData = $request->all();
        $validator = Validator::make($formData,[
            'businessID'=>'required',
        ]);
        if ($validator->fails()) {
            # code...
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $validator->errors());
            return Redirect::back()->withErrors($validator->errors());
        }

        $url= config('global.trade-license');
        $data = [
            'function'=>'getBusinessDetails',
            'businessID'=>$request->businessID
        ];

        $this->data['business']=json_decode($this->trade_curl($url,$data));
        // dd($this->data);


        if ($this->data['business']->success != true) {
            # code...
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $this->data['business']->message);
            return Redirect::back()->withErrors($this->data['business']->message);

        }else{
            $url = config('global.demographics');
            $data=[
                'function'=>'getSubCounty',
                'countyCode'=>33
            ];

            $this->data['subcounties'] = json_decode($this->food_hygiene_alex_to_curl($url,$data));

            //dd($this->data);

            if ($this->data['subcounties']->success != true) {

                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', $this->data['subcounties']->message);
                return Redirect::back()->withErrors($this->data['subcounties']->message);

            }else{
              $RenewBusiness = collect([
                'business' => $this->data['business'],
                'subcounties' => $this->data['subcounties'],
              ]);
                return response()->json($RenewBusiness);
            }
        }

    }

    public function renew(Request $request)
    {
        $url = config('global.trade-license');

        $formData = $request->all();

        // dd($validator);

        $data = [
            'function'=>'updateBusinessDetails',
            'businessID' => $request->businessID,
            'businessName' => $request->businessName,
            'period' => $request->period,
            'contactPersonName' => $request->contactPersonName,
            'physicalAddress' => $request->physicalAddress,
            'building' => $request->building,
            'buildingType' => $request->buildingType,
            'floor' => $request->floor,
            'houseNumber' => $request->houseNumber,
            'plotNumber' => $request->plotNumber,
            'zoneCode' => $request->zoneCode,
            'wardCode' => $request->wardCode,
        ];

        // dd($data);

        $renew_info = json_decode($this->trade_curl($url, $data));

        if(is_null($renew_info))
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Something went wrong, try again later');
            return Redirect::back()->withErrors('Something went wrong, try again later');
        }

        if($renew_info->success == true)
        {
            $data = [
                'function'=>'renewBusinessPermit',
                'businessID'=>$request->businessID,
            ];
            //dd($data);

            $this->data['TradeLicense'] = json_decode($this->trade_curl($url, $data));

            if($this->data['TradeLicense']->status !=200)
            {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content',$this->data['TradeLicense']->message);
                return Redirect::back()->withErrors($this->data['TradeLicense']->message);


            }else {

                return response()->json($this->data);

            }

        }else {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $renew_info->message);
            return Redirect::back()->withErrors($renew_info->message);

        }

        $bill_info = json_decode($this->bill_curl($url, $data));
        dd($bill_info);


        if(is_null($bill_info))
        {
          return redirect()->back()->withErrors('Something went wrong. Please try again.');
        }

        if($bill_info->status_code != 200)
        {
            return redirect()->back()->withErrors($bill_info->message);
        }

        $data = [
          'businessName' => $request->BusinessName,
          'businessID' => $request->BusinessID,
          'bill_number' => $bill_info->response_data->BillNo,
          'total' => $bill_info->response_data->BillTotal,


        ];

      return response()->json($data);
    }

    public function printBill($id)
    {
      $url = config('global.bill_url').'billing/GetBill';

        // dd($url);

        $data = [
            'BillNumber' => $id
        ];


        $bill_info = json_decode($this->check_bill_curl($url, $data));

        // dd($bill_info);

      if(is_null($bill_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again after a few minutes.');
      }

      if($bill_info->status_code != 200)
      {
          return redirect()->back()->withErrors($bill_info->message);
      }

      $bill = $bill_info->response_data;

        // dd($bill);

      $data = [
                'bill' => $bill,
            ];

        $pdf = PDF::loadView('bill', $data);
        return $pdf->stream('bill.pdf',array('Attachment'=>0));

        // return view('bill', ['bill' => $bill]);


      return view('sbp.bill', ['bill' => $bill_info->response_data]);
    }

    public function getPermit(Request $request)
    {
      $url = config('global.trade-license');

      $data = [
          'function'=>'getActiveCerts',
         'businessID' => $request->businessID
      ];

      //dd($data);
      $this->data['permit'] = json_decode($this->trade_curl($url, $data));
      //dd($this->data);

      if(is_null($this->data))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }


      if( $this->data['permit'] ->success === false)
      {
        return back()->withErrors( $this->data['permit'] ->message);
      }else{
          return view('sbp.permit')->with( $this->data);

      }


        //      $bill_number = $bills_info->response_data[0]->BillNo;
        //
        //      $url = $this->url .'permit/api/sbp/get_permit';
        //      $data = [
        //        'BusinessID' => $request->business_id,
        //        'BillNo' => $bill_number,
        //      ];
        //
        //      $permit_info = json_decode($this->pay_permit_curl($url, $data));
        //
        //      // dd($permit_info);
        //      if(is_null($permit_info))
        //      {
        //        return redirect()->back()->withErrors('Something went wrong. Please try again.');
        //      }


        //      if($permit_info->status_code !== 200)
        //      {
        //        return back()->withErrors($permit_info->message);
        //      }
        //
        //      // dd($permit_info);
        //      if($permit_info->response_data->Period == 1)
        //      {
        //        $amount_in_words = NumConvert::word((int)$permit_info->response_data->SBPFee);
        //      }
        //      else
        //      {
        //       $amount_in_words = NumConvert::word((int)$permit_info->response_data->AmountPaid);
        //      }


              // $data = [
              //       'permit' => $permit_info->response_data,
              //       'amount_in_words' => $amount_in_words,
              //   ];
              //   $pdf = PDF::loadView('sbp.permit', $data);
              //   return $pdf->stream('receipt.pdf',array('Attachment'=>0));

              // dd($permit_info);

        //      return view('sbp.permit', ['permit' => $permit_info->response_data, 'amount_in_words' => $amount_in_words]);

    }

    public function getPermitDocument($BusinessID)
    {
      $url = config('global.trade-license');

      $data = [
          'function'=>'getActiveCerts',
         'businessID' => $BusinessID
      ];

      // dd($data);
      $this->data['permit'] = json_decode($this->trade_curl($url, $data));
      // dd($this->data);

      if(is_null($this->data))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }


      if( $this->data['permit'] ->success === false)
      {
        return back()->withErrors( $this->data['permit'] ->message);
      }else{
          return view('documents.tradepermit')->with( $this->data);

      }
    }

    public function getPermitForm()
    {
      if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }else{
      return view('sbp.print-permit');
      }
    }

    public function viewPermit($id, $business_id)
    {
        $url = $this->url .'permit/api/sbp/get_permit';
        $data = [
          'BusinessID' => $business_id,
          'BillNo' => $id,
        ];

        $permit_info = json_decode($this->pay_permit_curl($url, $data));

        // dd($permit_info);
        if(is_null($permit_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($permit_info->status_code != 200)
      {
          return redirect()->back()->withErrors($permit_info->message);
      }

        $amount_in_words = NumConvert::word((int)$permit_info->response_data->AmountPaid);

        return view('sbp.permit', ['permit' => $permit_info->response_data, 'amount_in_words' => $amount_in_words]);
    }

    public function getReceipt($id)
    {
      $url = $this->url. 'permit/api/sbp/getreceipt';
      $data = [
        'BillNo' => $id];
      $receipt_info = json_decode($this->bill_curl($url,$data));

      return response()->json($receipt_info);
    }

    public function viewReceipt($id)
    {
      $url = $this->url. 'permit/api/sbp/getreceipt';
      $data = [
        'BillNo' => $id];
      $receipt_info = json_decode($this->bill_curl($url,$data));

      // dd($receipt_info);
      if(is_null($receipt_info))
      {
        return redirect()->back()->withErrors('Something went wrong. Please try again.');
      }

      if($receipt_info->status_code != 200)
      {
          return redirect()->back()->withErrors($receipt_info->message);
      }

      $amount_in_words = NumConvert::word((int)$receipt_info->response_data->receiptinfos->RecieptAmount);

      $receipt = $receipt_info->response_data;
      $receipt_user_id = Session::get('resource')['user_id'];

      $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receiptinfos->BillNo,
            ],
            [
                'brief_description' => $receipt->billinfos->FeeDescription,
                'description' => $receipt->billinfos->Description,
                'receipt_no' => $receipt->receiptinfos->ReceiptNo,
                'customer' => $receipt->billinfos->Customer,
                'identifier' => $receipt->receiptinfos->BillNo,
                'date' => $receipt->receiptinfos->ReceiptDate,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->receiptinfos->RecieptAmount,
                'category' => 'SBP'
            ]
        );
      return view('sbp.receipt', ['receipt' => $receipt,'amount_in_words' => $amount_in_words]);
    }

    function trade_curl($url, $data){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 );
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);
            return $output;

        }




        public function register_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => array('BusinessName' => $data['BusinessName'],
                'businessRegistrationNo' => $data['businessRegistrationNo'],
                'PINNumber' => $data['PINNumber'],
                'VATNumber' => $data['VATNumber'],
                'POBox' => $data['POBox']
                ,'PostalCode]' => $data['PostalCode']
                ,'Town' => $data['Town']
                ,'Telephone1' => $data['Telephone1']
                ,'Telephone2' => $data['Telephone2']
                ,'FaxNumber' => $data['FaxNumber']
                ,'Email' => $data['Email'],
                'PhysicalAddress' => $data['PhysicalAddress']
                ,'PlotNumber' => $data['PlotNumber']
                ,'building' => $data['building'],
                'floor' => $data['floor']
                ,'houseNumber' => $data['houseNumber'],
                'ContactPersonDesignation' => $data['ContactPersonDesignation'],
                'ContactPersonName' => $data['ContactPersonName'],
                'IDTypeCode' => $data['IDTypeCode'],
                'IDDocumentNumber' => $data['IDDocumentNumber'],
                'ContactPersonFaxNumber' => $data['ContactPersonFaxNumber'],
                'ContactPersonTelephone1' => $data['ContactPersonTelephone1'],
                'ContactPersonTelephone2' => $data['ContactPersonTelephone2'],
                'ContactPersonPOBox' => $data['ContactPersonPOBox'],
                'contactPersonPostalCode' => $data['contactPersonPostalCode'],
                'contactPersonTown' => $data['contactPersonTown'],
                'BusinessActivityDescription' => $data['BusinessActivityDescription'],
                'PremisesArea' => $data['PremisesArea'],
                'OtherBusinessClassificationDetails_' => $data['OtherBusinessClassificationDetails'],
                'ZoneCode' => $data['ZoneCode'],
                'WardCode' => $data['WardCode'],
                'businessActivity' => $data['businessActivity'],
                'ActivityCode' => $data['ActivityCode'],
                'NumberOfEmployees' => $data['NumberOfEmployees'],
                'RelativeSize' => $data['RelativeSize'],
                'Period' => $data['Period'],)

            ));

            $response = curl_exec($curl);

            // dd($response);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }


        public function renew_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => array(
                'BusinessID' => $data['BusinessID'],
                'ContactPersonName' => $data['ContactPersonName'],
                'ContactPersonTelephone1' => $data['ContactPersonTelephone1'],
                'building' => $data['building'],
                'floor' => $data['floor'],
                'houseNumber' => $data['houseNumber'],
                'plotNumber' => $data['plotNumber'],
                'zoneCode' => $data['zoneCode'],
                'wardCode' => $data['wardCode'],
                'PhysicalAddress' => $data['PhysicalAddress'],
                'IDDocumentNumber' => $data['IDDocumentNumber'],
                'PhysicalAddress' => $data['PhysicalAddress'],
                'Period' => $data['Period'],
                'ActivityCode' =>$data['ActivityCode'],
                )

            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }


        public function to_curl( $url) {
            // append the header putting the secret key and hash
            $headers = array(
                'Content-Type: application/json',
                // 'Authorization: Bearer ' .$this->token,
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            // dd($output);
            if (curl_errno($ch))
            {
                print "Error: " . curl_error($ch);
            }
            else
            {
                // Show me the result
                return $output;
            }

            curl_close($ch);
        }


        public function postal_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('code' => $data['code']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function business_curl($url, $data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('BusinessID' => $data['BusinessID']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function permit_curl($url, $data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('business_id' => $data['business_id']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function pay_permit_curl($url, $data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('BusinessID' => $data['BusinessID'], 'BillNo' => $data['BillNo']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function bill_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('BillNo' => $data['BillNo']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function pay_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('BillNo' => $data['BillNo'], 'PhoneNumber' => $data['PhoneNumber']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }


        public function charges_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('activity_code' => $data['activity_code']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function subs_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('parent_brims_code' => $data['parent_brims_code']),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        public function get_curl( $url) {
            // append the header putting the secret key and hash
            $headers = array(
                'Content-Type: application/json',
                //
                // 'Authorization: Bearer ',
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            // dd($output);
            if (curl_errno($ch))
            {
                print "Error: " . curl_error($ch);
            }
            else
            {
                // Show me the result
                return $output;
            }
            // dd($output);
            curl_close($ch);
        }


        public function check_bill_curl($url, $data){
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_SSL_VERIFYHOST => FALSE,
              CURLOPT_SSL_VERIFYPEER => FALSE,
              CURLOPT_POSTFIELDS => array('BillNumber' => $data['BillNumber']),
            ));

            $response = curl_exec($curl);

            // dd($response);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              return $response;
            }
        }

        function food_hygiene_alex_to_curl($url, $data){

            //        $headers = array
            //        (
            //            'Content-Type: application/json',
            //            'Content-Length: ' . strlen( json_encode($data) )
            //        );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 );
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //        curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers );

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            /*if($httpcode != 200)
                {
                $this->session->set_flashdata( "error", "An error has ocurred . Try again" );
                redirect('land');
                }
            */
            curl_close($ch);
            return $output;

        }

    }

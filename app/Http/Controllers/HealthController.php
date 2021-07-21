<?php

namespace App\Http\Controllers;

//use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
//use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Health;
use QRCode;
use NumConvert;
use PDF;

class HealthController extends Controller
{

    protected $url = 'https://demo.revenuesure.co.ke/health/healthApi/api/';
    //Register user if they don't have an caccount with health otherwise allow them to create bill


    public function printHandlerCertForm()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
            return view('health.print-handler-cert');
    }
    public function uploadCorpIndiv()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
            return view('health.corporate.upload');
    }
    public function addIndivCorporate()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
            return view('health.corporate.add-individual');
    }

    public function corporateCert()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('health.corporate.print-cert');

    }

    public function getCorpCertForm()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('health.corporate.cert-form');
    }

    public function getCorpCert()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
        return view('health.corporate.corp-cert');

    }

    public function getFoodHandlerCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'idNo'=>'required',
        ]);

        $data = [
            'function'=>'getFoodHandlerCert',
            'idNo'=>$request->idNo,
        ];
        //dd($data);

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));

        //dd($this->data['getFoodHygieneLicence']);
        if ($this->data['getFoodHygieneLicence']->success === true) {
            return view('documents.certificate')->with($this->data);

           }else{
                // return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
                return response()->json($this->data['getFoodHygieneLicence']);
           }
    }

    public function printCorpCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'corporateId'=>'required',
        ]);

        $data = [
            'function'=>'getCorporateFoodHandlerCerts',
            'corporateId'=>$request->corporateId,
        ];
        //dd($data);

        $this->data['getCorporateFoodHandlerCerts'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        dd($this->data['getCorporateFoodHandlerCerts']);

        if ($this->data['getCorporateFoodHandlerCerts']->success === true) {
            return view('documents.corpcertificate')->with($this->data);

           }else{
                return redirect()->back()->withErrors($this->data['getCorporateFoodHandlerCerts']->message);
           }
    }

    public function suspendCorporateIndvi($idNo)
    {
        $url = $this->url = config('global.food_hygiene');

        $data = [
            'function'=>'removeIndividualsFromCorporate',
            'corporateId'=>Session::get('corporateId'),
            'idNo'=>$idNo,
        ];
        //dd($data);

        $this->data['removeIndividualsFromCorporate'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));


         //dd($this->data['removeIndividualsFromCorporate']);
        if ($this->data['removeIndividualsFromCorporate']->success === true) {
            return redirect()->back()->withErrors($this->data['removeIndividualsFromCorporate']->message);
           }else{
                return redirect()->back()->withErrors($this->data['removeIndividualsFromCorporate']->message);
           }
    }

    public function getResultSlip($idNo)
    {
        $url = $this->url = config('global.food_hygiene');
        $data = [
            'function'=>'getResult',
            'idNo'=>$idNo,
        ];
        //dd($data);

        $this->data1['getResult'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        $this->data['getResult'] =  $this->data1['getResult']->data;

        //dd($this->data);

        //dd($this->data);
        return view('health.food-handler.result-slip')->with($this->data);

    }
    public function getSlip($idNo){
        $url = $this->url = config('global.food_hygiene');
        $data = [
            'function'=>'getResult',
            'idNo'=>$idNo,
        ];
        //dd($data);

        $this->data['getResults'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);
        if ($this->data['getResults']->success === true) {
            return view('health.food-handler.slip-home')->with($this->data);
           }else{
                return redirect()->back()->withErrors($this->data['getResults']->message);
           }





    }


    public function allHandlerCerts($idNo)
    {
        $url = $this->url = config('global.food_hygiene');
        $data = [
            'function'=>'getFoodHandlerCerts',
            'idNo'=>$idNo,
        ];
        //dd($data);

        $this->data['getFoodHandlerCerts'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
         //dd($this->data);


        if ($this->data['getFoodHandlerCerts']->success === true) {
            return view('health.food-handler.food-home')->with($this->data);
           }else{
                return redirect()->back()->withErrors($this->data['getFoodHandlerCerts']->message);
           }
    }


    public function getCorporateCertificate($idNo)
    {
        $url = $this->url = config('global.food_hygiene');

        $data = [
            'function'=>'getFoodHandlerCert',
            'idNo'=>$idNo,
        ];
        //dd($data);

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
         //dd($this->data);
        if ($this->data['getFoodHygieneLicence']->success === true) {
            return view('documents.certificate')->with($this->data);
           }else{
                return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
           }
    }


    public function getCorporateCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'idNo'=>'required',
        ]);

        $data = [
            'function'=>'getFoodHandlerCert',
            'idNo'=>$request->idNo,
        ];
        //dd($data);

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
       //dd($this->data['getFoodHygieneLicence']);
        if ($this->data['getFoodHygieneLicence']->success === true) {
            return view('documents.certificate')->with($this->data);

           }else{
                return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
           }
    }

    public function GetCorporate()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
            return view('health.corporate.get-corporate');
    }

    public function GetCorporateAuth(Request $request)
    {
    $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'corporateId'=>'required',
        ]);

        $data = [
            'function'=>'getCorporate',
            'corporateId'=>$request->corporateId,
        ];
        //dd($data);

        $registerIndividual = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($registerIndividual);
         return response()->json(['success'=>$registerIndividual]);
}

    public function getCorporateIndividuals($id){
    $url = $this->url = config('global.food_hygiene');
    $data = [
        'function'=>'getCorporateIndividuals',
        'corporateId'=>$id,
    ];

    Session::put('corporateId',$id);
    $this->data['getCorporateIndividuals'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
    //dd($this->data);
    if ($this->data['getCorporateIndividuals']->success === true) {
        return view('corporate.home')->with($this->data);
    }else{
        return view('corporate.home')->with($this->data);

       // return redirect()->route('get-corporate')->withErrors($this->data['getCorporateIndividuals']->message);
    }
         //return response()->json(['success'=>$getCorporateIndividuals]);
    }



    public function registerIndivCorporate(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'corporateId'=>'required',
            'idNo'=>'required',

        ]);

        $data = [
            'function'=>'addIndividualsToCorporate',
            'corporateId'=>$request->corporateId,
            'idNo'=>$request->idNo,
        ];
        //dd($data);
        $addIndividualsToCorporate = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($addIndividualsToCorporate);
         return response()->json(['success'=>$addIndividualsToCorporate]);
        //dd($registerCorporates);
    }

    public function registerFoodHandler(Request $request)
    {
        // dd($request->all());

        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'firstName'=>'required',
            'otherNames'=>'required',
            'idNo'=>'required',
            'gender'=>'required',
            'selfEmployed'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'idType'=>'required',
            'postalCode'=>'required',
            'town'=>'required',
            'county'=>'required',
            'Subcounty'=>'required',
            'ward'=>'required',
            'corporateId'=>'required',
            'workGroupId'=>'required',
        ]);

        $data = [
            'function'=>'registerIndividual',
            'firstName'=>$request->firstName,
            'otherNames'=>$request->otherNames,
            'idNo'=>$request->idNo,
            'gender'=>$request->gender,
            'selfEmployed'=>$request->selfEmployed,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'idType'=>$request->idType,
            'postalCode'=>$request->postalCode,
            'town'=>$request->town,
            'county'=>$request->county,
            'subCounty'=>$request->Subcounty,
            'ward'=>$request->ward,
            'corporateId'=>$request->corporateId,
            'workGroupId'=>$request->workGroupId,
        ];
        // dd($data);

        $registerIndividual = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        // dd($registerIndividual);

         return response()->json(['success'=>$registerIndividual]);
        //dd($registerCorporates);
    }

    public function printHealthSlip(){
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        return view('health.food-handler.slip');

    }

    public function FoodHygieneBusinessDetails()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }
            return view('health.food-hygiene.business-details');

    }
    public function ApplyFoodHandlerForm()
    {

        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        $url = config('global.demographics');

        $data=[
            'function'=>'getSubCounty',
            'countyCode'=>33
        ];

        $this->data['subcounties'] = json_decode($this->food_hygiene_alex_to_curl($url,$data));

        if ($this->data['subcounties']->status != 200) {

            return Redirect::back()->withErrors([$this->data['subcounties']->message]);
        }else{

            return response()->json($this->data);
        }
    }

    public function PullBusinessDetails(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'businessID'=>'required',
        ]);
        $data = [
            'function'=>'getSBPDetails',
            'businessID'=>$request->businessID,
        ];
        // dd($data);
        $this->data['getSBPDetails'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);

        $url = config('global.demographics');

        $data=[
            'function'=>'getSubCounty',
            'countyCode'=>33
        ];
    	$this->data['subcounties'] = json_decode($this->trade_curl($url,$data));

        //dd($this->data);

        if ($this->data['getSBPDetails']->success === false) {
           // dd('true');
            return Redirect::back()->withErrors([$this->data['getSBPDetails']->message]);
        }else{

            return response()->json($this->data);

        }
    }

    public function getFoodHandlerBill($idNo)
    {
        $url = config('global.food_hygiene');
         //dd($url);
        $data = [
           'function'=> 'getFoodHandlerBill',
            'idNo' => $idNo
        ];

        Session::put('idNo', $idNo);

        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);

        return response()->json($this->data['getFoodHygieneBill']);

        // if ($this->data['getFoodHygieneBill']->success === true) {
        //     return view('health.food-handler.handler-bill')->with($this->data);
        //  }else{
        //     return redirect()->back()->withErrors([$this->data['getFoodHygieneBill']->message]);
        //  }
    }

    public function getSelectedBill(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'corporateId'=>'required',
            'ids'=>'required'
        ]);

        $data= [
            'function'=>'getSelectedCorporateFoodHandlerBill',
            'corporateId'=>$request->corporateId,
            'ids'=> implode(" , ",$request->ids),
        ];
        //dd($data);

        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);

        if ($this->data['getFoodHygieneBill']->success === true) {
            return view('health.corporate.multibill')->with($this->data);
         }else{
            return redirect()->back()->withErrors([$this->data['getFoodHygieneBill']->message]);
         }

    }

    public function registerFoodHygiene(Request $request)
    {
        // dd($request->all());

        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'businessName'=>'required',
            'businessID'=>'required',
            'telephone1'=>'required',
            'telephone2'=>'required',
            'address'=>'required',
            'postalCode'=>'required',
            'town'=>'required',
            'county'=>'required',
            'subCountyId'=>'required',
            'wardId'=>'required',
        ]);

        $data = [
            'function'=>'registerCorporates',
            'businessName'=>$request->businessName,
            'businessID'=>$request->businessID,
            'telephone1'=>$request->telephone1,
            'telephone2'=>$request->telephone2,
            'address'=>$request->address,
            'postalCode'=>$request->postalCode,
            'town'=>$request->town,
            'county'=>$request->county,
            'subCountyId'=>$request->subCountyId,
            'wardId'=>$request->wardId,
        ];
        //dd($data);

        $registerCorporates = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($registerCorporates);

         return response()->json(['success'=>$registerCorporates]);
        //dd($registerCorporates);
    }




    public function renewHandler()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        return view('health.food-handler.renew-handler');

    }


    public function renewForm()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }

        return view('health.food-hygiene.renew-form');

    }


    public function renewFoodHandler(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'idNo'=>'required',
        ]);

        $data=[
            'function'=>'renewFoodHandler',
            'idNo'=>$request->idNo
        ];

        //dd($data);
        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data['getFoodHygieneBill']);

        return response()->json($this->data['getFoodHygieneBill']);

        // if ($this->data['getFoodHygieneBill']->success === true) {
        //     return view('health.food-handler.handler-bill')->with($this->data);
        //  }else{
        //  return redirect()->back()->withErrors($this->data['getFoodHygieneBill']->message);
        // }


    }



    public function renewFoodHygiene(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'businessID'=>'required',
        ]);

        $data=[
            'function'=>'renewFoodHygieneLicence',
            'businessID'=>$request->businessID
        ];

        //dd($data);
        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data['getFoodHygieneBill']);

        return response()->json($this->data);

        // if ($this->data['getFoodHygieneBill']->success === true) {
        //     return view('health.food-hygiene.hygiene-bill')->with($this->data);
        //  }else{
        //  return redirect()->back()->withErrors($this->data['getFoodHygieneBill']->message);
        // }


    }


    public function billForm()
    {
        if (is_null(Session::get('resource'))) {
            Session::put('url', url()->current());
            return redirect()->route('login');
        }


        $url = 'https://biller.revenuesure.co.ke/permit/api/sbp/subcountys';
        $sub_info = json_decode($this->get_curl($url));
        //dd($sub_info);
        if(is_null($sub_info))
        {
          return redirect()->back()->withErrors('Something went wrong. Please try again.');
        }
        $clinics_info = ($this->clinics());
        //dd($clinics_info);


        $name_array = explode(' ', Session::get('resource')['user_full_name']);
        $subcounties = $sub_info->response_data;
        if(Session::get('resource')['national_id'] == null)
        {
          return view('health.create-handlers-cert', ['clinics' => $clinics_info->response_data, 'name_array' => $name_array, 'subcounties' => $subcounties]);
        }

          $url = $this->url. 'checkId';
          $data = [
            'IDNumber' => Session::get('resource')['national_id'],
          ];

          $health_info = json_decode($this->id_curl($url, $data));
          if(empty($health_info))
          {
              return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
          }

          if($health_info->status_code !=200)
          {
            $url = 'https://biller.revenuesure.co.ke/permit/api/sbp/subcountys';

            return view('health.create-handlers-cert', ['clinics' => $clinics_info->response_data, 'name_array' => $name_array, 'subcounties' => $subcounties]);
          }

          $health = collect([
            'type' => $health_info->response_data->type,
            'ApplicantId' => $health_info->response_data->ApplicantId,
            // 'ApplicantNO' => $health_info->response_data->ApplicantNO,
          ]);

          Session::put('health', $health);

            return view('health.generate-bill', ['data' => $health_info->response_data, 'clinics' => $clinics_info->response_data]);

    }


    public function generateBill()
    {
        $url = $this->url. 'generatebill';
        $data = [
                'type' => Session::get('health')['type'],
                'ApplicantId' => Session::get('health')['ApplicantId'],
                'ApplicantNO' => null,
            ];

            $bill_info = json_decode($this->bill_curl($url, $data));

            // dd($bill_info);
            if(empty($bill_info))
            {
                return redirect()->back()->withErrors("We're having trouble storing your details. Please try again later");
            }
            if($bill_info->status_code !=200)
            {
                return response()->json($bill_info);
            }


            return response()->json($bill_info);

    }


    public function register(Request $request)
    {
        // dd($request->all());

        $url = $this->url . 'register';
        $data = $request->all();
        // dd($data);
        $registered = json_decode($this->register_curl($url, $data));

         //dd($registered);
        if(empty($registered))
        {
            return redirect()->back()->withErrors("We're having trouble storing your details. Please try again later");
        }
        if($registered->status_code !=200)
        {
            return response()->json($registered);
        }

        $login_url = $this->url. 'logins';
        $login_data = [
            'IDNumber' => $request->IDNumber,
            'Password' => $request->Password,
        ];
        $logged = json_decode($this->login_curl($login_url, $login_data));

        // dd($logged);
        if(empty($logged))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
        }
        if($logged->status_code !=200)
        {
            return response()->json($logged);
        }

        if($logged->status_code == 200)
        {
            $new_logged = collect([
              'type' => $logged->response_data->type,
              'ApplicantId' => $logged->response_data->ApplicantId,
              ]);

            Session::put('health', $new_logged);

            $bill_url = $this->url. 'generatebill';
            $bill_data = [
                'type' => $new_logged['type'],
                'ApplicantId' => $new_logged['ApplicantId'],
                'ApplicantNO' => $request->employees,
            ];

            $bill_info = json_decode($this->bill_curl($bill_url, $bill_data));

            return response()->json($bill_info);
        }


    }

    public function getReceipt($bill_number)
    {
        $url = $this->url. 'getreceipt';
        $data = [
            'BillNo' => $bill_number,
        ];

        $receipt_info = json_decode($this->receipt_curl($url, $data));
        return response()->json($receipt_info);
    }


    public function hygienePrints($pay_id)
    {
        return view('health.food-hygiene.printable', compact('pay_id'));
    }


    public function corporatePrints($pay_id)
    {
        return view('health.corporate.printables', compact('pay_id'));
    }
    public function handlerPrints($pay_id)
    {
        $url = $this->url = config('global.food_hygiene');

        $data=[
            'function'=>'getClinics',
        ];

        $clinics = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($clinics);

        return view('health.food-handler.handler-printable', compact('pay_id','clinics'));
    }



    public function printCorpFoodHandlerCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'corporateId'=>'required'
        ]);

        $data=[
            'function'=>'getCorporateFoodHandlerCerts',
            'corporateId'=>$request->corporateId,
        ];

        //dd($data);

        $this->data['getCorporateFoodHandlerCerts'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
         dd($this->data);

         if ($this->data['getCorporateFoodHandlerCerts']->success === true) {
            return view('documents.corpcertificate')->with($this->data);

           }else{
                return redirect()->back()->withErrors($this->data['getCorporateFoodHandlerCerts']->message);
           }



    }




    public function printFoodHandlerCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'idNo'=>'required'
        ]);

        $data=[
            'function'=>'getFoodHandlerCert',
            'idNo'=>$request->idNo,
        ];

        //dd($data);

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
         //dd($this->data);

        if ($this->data['getFoodHygieneLicence']->success === true) {
         return view('documents.certificate')->with($this->data);

        }else{
             return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
        }



    }
    public function printFoodHygieneCert(Request $request)
    {
        $url = $this->url = config('global.food_hygiene');
        $request->validate([
            'businessID'=>'required'
        ]);

        $data=[
            'function'=>'getFoodHygieneLicence',
            'businessID'=>$request->businessID,
        ];

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);

        if ($this->data['getFoodHygieneLicence']->success === true) {
         return redirect()->view('documents.foodhygienecert')->with($this->data);

        }else{
             return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
        }
    }

    public function FoodHygieneDocument($businessID){
        $url = $this->url = config('global.food_hygiene');

        $data=[
            'function'=>'getFoodHygieneLicence',
            'businessID'=>$businessID,
        ];

        $this->data['getFoodHygieneLicence'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        //dd($this->data);

        if ($this->data['getFoodHygieneLicence']->success === true) {
         return view('documents.foodhygienecert')->with($this->data);

        }else{
             return redirect()->back()->withErrors($this->data['getFoodHygieneLicence']->message);
        }
    }

    public function getHygieneReceipt($bill_number)
    {
    $url = config('global.food_hygiene_pay_online');
    $data = [
        'function'=>'getFoodHygieneLicence',
        'businessID' => Session::get('businessID'),
    ];

    dd($data);
    $getFoodHygieneLicence = json_decode($this->receipt_curl($url, $data));
     dd($getFoodHygieneLicence);


    if(empty($getFoodHygieneLicence))
    {
        return redirect()->back()->withErrors("We're having trouble retrieving your receipts. Please try again later");
    }
    if($getFoodHygieneLicence->status_code !=200)
    {
        return response()->json($getFoodHygieneLicence->message);
    }


    $amount_in_words = NumConvert::word((int)$getFoodHygieneLicence->response_data->RecieptAmount);
    return view('health.receipt', ['receipt' => $getFoodHygieneLicence->response_data, 'amount_in_words' => $amount_in_words]);
}

    public function viewReceipt($bill_number)
    {
        $url = $this->url. 'getreceipt';
        $data = [
            'BillNo' => $bill_number,
        ];

        $receipt_info = json_decode($this->receipt_curl($url, $data));
        // dd($receipt_info);
        if(empty($receipt_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your receipts. Please try again later");
        }
        if($receipt_info->status_code !=200)
        {
            return response()->json($receipt_info->message);
        }

        $amount_in_words = NumConvert::word((int)$receipt_info->response_data->RecieptAmount);
        return view('health.receipt', ['receipt' => $receipt_info->response_data, 'amount_in_words' => $amount_in_words]);
    }

    public function getCorporateBill(Request $request)
    {
        $url = config('global.food_hygiene');
         //dd($url);
        $data = [
           'function'=> 'getCorporateFoodHandlerBill',
            'corporateId' => $request->corporateId
        ];
        //dd($data);
        Session::put('corporateId',$request->corporateId);

        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));

        if ($this->data['getFoodHygieneBill']->success === true) {
            return view('health.corporate.corporate-bill')->with($this->data);
         }else{
            return redirect()->back()->withErrors([$this->data['getFoodHygieneBill']->message]);
         }

    }

    public function getFoodHygieneBill($billNo)
    {
        $url = config('global.food_hygiene');
         //dd($url);
        $data = [
           'function'=> 'getBill',
            'billNo' => $billNo
        ];

        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));

        //dd($this->data);

        Session::put('customerId',$this->data['getFoodHygieneBill']->data->customerId);

        return response()->json($this->data);

    }


    public function getFoodHygieneBillOld($businessID)
    {
        $url = config('global.food_hygiene');
         //dd($url);
        $data = [
           'function'=> 'getFoodHygieneBill',
            'businessID' => $businessID
        ];

        //dd($data);
        Session::put('businessID', $businessID);
        $this->data['getFoodHygieneBill'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));
        dd($this->data);

        if ($this->data['getFoodHygieneBill']->success === true) {
            return view('health.food-hygiene.hygiene-bill')->with($this->data);
         }else{
            return redirect()->route('food-hygiene-business-details')->withErrors([$this->data['getFoodHygieneBill']->message]);
         }
    }
    public function payFoodHygiene(Request $request)
    {
        // dd($request->all());

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

      $payment_info = json_decode($this->payme_to_curl($url, $data));
       return response()->json($payment_info);

    }

    public function getFoodHygieneReceipt($pay_id)
    {
      $url = config('global.bill-payment');
      $data = [
        'function'=>'checkPaymentVerification',
        'account_reference' => $pay_id,
        ];

        $checkPaymentVerification = json_decode($this->payme_to_curl($url, $data));
        return response()->json(['success'=>$checkPaymentVerification]);
    }

    public function multiFoodHandlerBill($idNo)
    {
        $url = config('global.food_hygiene');

         //dd($businessID);

        $data = [
            'function'=>'fetchBillDetails',
            'billNo' => $idNo
        ];


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

        $pdf = PDF::loadView('bills.ubp-bill', $data);
        return $pdf->stream('bill.pdf',array('Attachment'=>0));
        //return view('bills.ubp-bill', ['bill' => $bill]);
        //return view('bills.trade-bill', ['bill' => $bill]);

    }

    public function printFoodHandlerBill($idNo)
    {
        $url = config('global.food_hygiene');

         //dd($businessID);

        $data = [
            'function'=>'getFoodHandlerBill',
            'idNo' => $idNo
        ];


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

        //        $pdf = PDF::loadView('bills.food-hygiene', $data);
        //        return $pdf->stream('bill.pdf',array('Attachment'=>0));
       return view('bills.food-hygiene', ['bill' => $bill]);
    }

    public function printFoodHygieneBill($businessID)
    {
        $url = config('global.food_hygiene');

         //dd($businessID);

        $data = [
            'function'=>'getFoodHygieneBill',
            'businessID' => $businessID
        ];


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

        //$pdf = PDF::loadView('bills.food-hygiene', $data);
        //return $pdf->stream('bill.pdf',array('Attachment'=>0));
        return view('bills.food-hygiene', ['bill' => $bill]);
    }

    public function printBill($bill_number)
    {
        $url = config('global.bill_url').'billing/GetBill';

        // dd($url);

        $data = [
            'BillNumber' => $bill_number
        ];


        $bill_info = json_decode($this->check_bill_curl($url, $data));
        // dd($bill_info);
        if(empty($bill_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your bill. Please try again later");
        }
        if($bill_info->status_code !=200)
        {
            return response()->json($bill_info->message);
        }

        $bill = $bill_info->response_data;


        $data = [
                'bill' => $bill,
            ];

        $pdf = PDF::loadView('bill', $data);
        return $pdf->stream('bill.pdf',array('Attachment'=>0));
        // return view('bill', ['bill' => $bill]);
    }

    public function healthCredentials()
    {
      return view('health.credentials');
    }

    public function getOtpIndiv(Request $request)
    {
      $url = config('global.food_hygiene');
      $data = [
          'function'=>'getIndividual',
          'idNo' => $request->idNo
        ];

      Session::put('temp_id', $request->idNo);
      $getIndividual = json_decode($this->food_hygiene_alex_to_curl($url,$data));
        //dd($getIndividual->success);


      if(empty($getIndividual))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
        }

      // dd($health_info);

      if($getIndividual->success === true)
      {
          $otp = rand(1000,9999);

          Session::put('otp', $otp);
          $url = config('global.food_hygiene');

          $data = [
            'function' => 'sendOTP',
            'phoneNumber' => $getIndividual->data->mobile,
            'message' => 'Your PIN is '. $otp .'. Use this PIN to access your certificates.',
          ];

          $credentials = json_decode($this->food_hygiene_alex_to_curl($url, $data));

          return response()->json($credentials);
      }
      else
      {
        return response()->json($getIndividual);
      }

    }

    public function getOtpCorporate(Request $request)
    {
      $url = config('global.food_hygiene');
      $data = [
          'function'=>'getCorporate',
          'corporateId' => $request->corporateId
        ];

      Session::put('temp_id', $request->corporateId);
      $getCorporate = json_decode($this->food_hygiene_alex_to_curl($url,$data));
      //dd($getCorporate);

      if(empty($getCorporate))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
        }
        
    //     dd($getCorporate->data);

    //   dd($getCorporate->data->telephone1);

      if($getCorporate->success === true)
      {
          $otp = rand(1000,9999);

          Session::put('otp', $otp);
          $url = config('global.food_hygiene');

          $data = [
            'function' => 'sendOTP',
            'phoneNumber' => $getCorporate->data->telephone1,
            'message' => 'Your PIN is '. $otp .'. Use this PIN to access your certificates.',
          ];

          $credentials = json_decode($this->food_hygiene_alex_to_curl($url, $data));

          return response()->json($credentials);
      }
      else
      {
        return response()->json($getCorporate);
      }

    }

    public function getOtp(Request $request)
    {
      // dd($request->all());

      $url = $this->url. 'checkId';
      $data = ['IDNumber' => $request->national_id];
      Session::put('temp_id', $request->national_id);
      $health_info = json_decode($this->id_curl($url,$data));

      if(empty($health_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
        }

      // dd($health_info);

      if($health_info->status_code == 200)
      {
          $otp = rand(1000,9999);

          Session::put('otp', $otp);
          $url = 'http://revenuesure.co.ke/RevenueSure/api/General/SendSms';

          $data = [
            'from' => 'NCCG',
            'to' => $health_info->response_data->Telephone,
            'message' => 'Your PIN is '. $otp .'. Use this PIN to access your certificates.',
          ];

          $credentials = json_decode($this->to_curl($url, $data));



          return response()->json($credentials);
      }
      else
      {
        return response()->json($health_info);
      }

    }
    public function confirmOtpCorporate(Request $request)
    {
      $temp_otp = $request->otp;
      $otp = Session::get('otp');

     // dd($temp_otp);
      //dd($otp);

      if($temp_otp == $otp)
      {
        $message = 'success';
        return response()->json($message);
      }
      else
      {
        $message = 'OTP mismatch. Kindly enter the correct OTP';
        return response()->json($message);
      }
    }

    public function confirmOtp(Request $request)
    {
      $temp_otp = $request->otp;
      $otp = Session::get('otp');

      if($temp_otp == $otp)
      {
        $message = 'success';
        return response()->json($message);
      }
      else
      {
        $message = 'OTP mismatch. Kindly enter the correct OTP';
        return response()->json($message);
      }
    }

    public function viewHealthCertificate($id)
    {

        $url = $this->url. 'checkId';

        $data = [
          'IDNumber' => $id,
        ];

        $health_info = json_decode($this->id_curl($url, $data));

        if(empty($health_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details. Please try again later");
        }
        // dd($health_info);
        if($health_info->status_code !=200)
        {
            return redirect()->back()->withErrors($health_info->message);
        }

        $health = collect([
          'type' => $health_info->response_data->type,
          'ApplicantId' => $health_info->response_data->ApplicantId,
          // 'ApplicantNO' => $health_info->response_data->ApplicantNO,
        ]);

        Session::put('health', $health);

        $url = $this->url. 'mybill';
        $applicant_id = Session::get('health')['ApplicantId'];

        $data = [
            'ApplicantId' => (int)$applicant_id,
        ];

        // dd($data);

        $bills = json_decode($this->get_bills_curl($url, $data));

        if(empty($bills))
        {
            return redirect()->back()->withErrors("We're having trouble fetching your bills. Please try again later");
        }

        // dd($bills->response_data);
        if($bills->status_code == 200)
        {

            return view('health.view-certificate', ['bills' => $bills->response_data]);
        }
        else
        {
            return redirect()->back()->withErrors($bills->message);
        }


    }

    public function printCertificate($bill_id)
    {
        $national_id = Session::get('resource')['national_id'];
        $applicant_id = Session::get('health')['ApplicantId'];


        $data = [
            'BillID' => $bill_id,
            'ApplicantId' => $applicant_id,
             ];

        $url = $this->url. 'certificate';

        // dd($url);

        $certificate_info = json_decode($this->certificate_curl($url, $data));

        if(empty($certificate_info))
        {
            return redirect()->back()->withErrors("We're having trouble fetching your certificates. Please try again later");
        }

        if($certificate_info->status_code !=200)
        {
            return redirect()->back()->withErrors($certificate_info->message);
        }
        // dd($certificate_info);



      return view('documents.certificate', ['certificate' => $certificate_info->response_data]);
    }

    public function payment(Request $request)
    {
      // dd($request->all());
      $url = $this->url . 'pay_ajax';
      $data = [
        'phone_number' => $request->phone_number,
        'BillNo' => $request->bill_number,
      ];

      $payment_info = json_decode($this->pay_curl($url, $data));

       dd($payment_info);

      return response()->json($payment_info);

      // dd($payment_info);
    }

    public function clinics()
    {
      $url = $this->url . 'clinics';

      $data = [];

      $clinics = json_decode($this->clinics_curl($url, $data));
      if(is_null($clinics))
      {
        return redirect()->back()->withErrors('We are having trouble retrieving clinics. Please try again later.');
      }

      return $clinics;
    }

    public function getWards(Request $request)
    {
    	$url = config('global.demographics');
    	$data =
    	[
        'function'=>'getWards',
        'subCountyCode' => $request->subCountyCode,
    	];


    	$ward_info  = json_decode($this->trade_curl($url, $data));
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

    public function apply()
    {
      return view('health.apply');
    }

    public function checkID(Request $request)
    {

      $clinics_info = ($this->clinics());
      $name_array = explode(' ', Session::get('resource')['user_full_name']);
      $url = 'https://biller.revenuesure.co.ke/permit/api/sbp/subcountys';
      $sub_info = json_decode($this->get_curl($url));
      if(is_null($sub_info))
        {
          return redirect()->back()->withErrors('Something went wrong. Please try again.');
        }
      // dd($sub_info);
      $subcounties = $sub_info->response_data;

      $url = $this->url. 'checkId';
      $data = ['IDNumber' => $request->id_number];


      $health_info = json_decode($this->id_curl($url, $data));

      if(empty($health_info))
      {
          return redirect()->back()->withErrors("Something went wrong. Please try again later");
      }

      if($health_info->status_code != 200)
      {


        return view('health.create-handlers-cert', ['clinics' => $clinics_info->response_data, 'subcounties' => $subcounties, 'name_array' => $name_array]);
      }
      else
      {
        $health = collect([
            'type' => $health_info->response_data->type,
            'ApplicantId' => $health_info->response_data->ApplicantId,
            // 'ApplicantNO' => $health_info->response_data->ApplicantNO,
          ]);

          Session::put('health', $health);
        return view('health.generate-bill', ['data' => $health_info->response_data, 'clinics' => $clinics_info->response_data]);
      }
    }

    public function printHealthCertificate($ApplicantID, $BillID)
    {
        $data = [
            'BillID' => $BillID,
            'ApplicantId' => $ApplicantID,
             ];

             // dd($data);

        $url = 'https://biller.revenuesure.co.ke/health/healthApi/api/certificate';

        // dd($url);

        $certificate_info = json_decode($this->certificate_curl($url, $data));

        // dd($certificate_info);

        if(empty($certificate_info))
        {
            return redirect()->back()->withErrors("We're having trouble fetching your certificates. Please try again later");
        }

        if($certificate_info->status_code !=200)
        {
            return redirect()->back()->withErrors($certificate_info->message);
        }
        // dd($certificate_info);

        //  $data = [
        //     'certificate' => $certificate_info->response_data
        // ];


        // $pdf = PDF::loadView('documents.certificate', $data);
        // return $pdf->stream('food handlers certificate.pdf',array('Attachment'=>0));

        return view('documents.certificate', ['certificate' => $certificate_info->response_data]);
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


    public function register_curl($url, $data)
    {
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
          CURLOPT_POSTFIELDS => array('type' => '1','Telephone' => $data['Telephone'],'SubCounty' => $data['zones'],'WardId' => $data['wards'], 'FirstName' => $data['FirstName'], 'MiddleName' => $data['MiddleName'], 'LastName' => $data['LastName'], 'company_name' =>$data['company_name'], 'premiseName' => $data['premiseName'], 'Location' => $data['Location'], 'PremisePlotNo' => $data['PremisePlotNo'], 'IDNumber' => $data['IDNumber'], 'Password' => $data['IDNumber']),
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

    public function login_curl($url, $data)
    {
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
          CURLOPT_POSTFIELDS => array('IDNumber' => $data['IDNumber'], 'Password' => $data['Password']),
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

    public function bill_curl($url, $data)
    {
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
          CURLOPT_POSTFIELDS => array('type' => $data['type'],'ApplicantId' => $data['ApplicantId'], 'ApplicantNO' => $data['ApplicantNO']),
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
    public function receipt_curl($url, $data){
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

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function print_bill_curl($url, $data){
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

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function get_bills_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('ApplicantId' => $data['ApplicantId']),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function certificate_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('ApplicantId' => $data['ApplicantId'], 'BillID' => $data['BillID']),
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

    public function id_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('IDNumber' => $data['IDNumber']),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

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
          CURLOPT_POSTFIELDS => array('phone_number' => $data['phone_number'], 'BillNo' => $data['BillNo']),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function clinics_curl($url, $data){
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
          // CURLOPT_POSTFIELDS => array('phone_number' => $data['phone_number'], 'BillNo' => $data['BillNo']),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }

    public function to_curl($url, $data){
        // dd(json_encode($data));
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        // dd($output);
        if (curl_errno($ch))
        {
            print "Error: " . curl_error($ch);
        }
        else
        {
            return $output;
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

    function payme_to_curl($url, $data){

        //        $headers = array
        //        (
        //            'Content-Type: application/json',
        //            'Content-Length: ' . strlen( json_encode($data) )
        //        );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false );
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
                curl_setopt($ch, CURLOPT_ENCODING, "" );
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
                curl_setopt($ch, CURLOPT_TIMEOUT, 0 );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Skip SSL Verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // Skip SSL Verification

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

            function food_hygiene_alex_array_to_curl($url, $data){

                        $headers = array
                       (
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen( json_encode($data) )
                       );

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



}

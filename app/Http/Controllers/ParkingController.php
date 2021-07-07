<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NumConvert;
use App\Receipt;
use Illuminate\Support\Facades\Session;

class ParkingController extends Controller
{   //GLOBAL FUNCTIONS

    protected $token;
    protected $url;
    protected $parking_categories;

    public function __construct()
    {
        $this->token = $this->getToken();
        $this->url = config('global.parking_url');

        $this->parking_categories = $this->getParkingCategories();
    }

    public function getToken()
    {
        if(Session::has('token'))
        {
            $token = Session::get('token');
        }
        else
        {
            $url = config('global.url'). 'Account/GetToken';

            $data = [
                'user_name' => 'PARKING',
                'password' => 'lockfree',
            ];

            $token = json_decode(stripslashes($this->token_curl($url,$data)))->token;
        }

        return $token;


    }


    public function getParkingCategories()
    {
        $url = $this->url. 'Parking/GetParkingCategories';
        $parking_info = json_decode($this->get_curl($url));
        if(is_null($parking_info))
        {
            return redirect()->back()->withErrors('We are having trouble retrieving parking categories. Please try again later.');
        }

        if($parking_info->status_code !=200 )
        {
            return redirect()->back()->withErrors($parking_info->message);
        }
        return $parking_info;

    }

    public function getParkingCharges(Request $request)
    {

        // dd($request->all());
        $url =$this->url. 'Onstreet/GetOnstreetCharge';

        if(!is_null($request->zone_code))
        {
            $data = [
                'vehicle_category_id' =>$request->daily_vehicle_category_code,
                'number_plate' => $request->registration_number,
                'duration_id' => $request->duration_code,
                'zone_id' => $request->zone_code
            ];
        }
        else
        {
            $data = [
                'vehicle_category_id' =>$request->seasonal_vehicle_category_code,
                'number_plate' => $request->registration_number,
                'duration_id' => $request->duration_code
            ];
        }


        // dd($data);
        $charges_info = json_decode($this->to_curl($url, $data));


        return response()->json($charges_info);
    }

    //OFFSTREET PARKING
	public function offstreetParking()
	{
		// $zones_info = $this->parking_categories->response_data->zones;

		// $data = [
		// 	'zones' => $this->parking_categories->response_data->zones,
		// 	'vehicle_categories' => $this->parking_categories->response_data->vehicle_categories,
		// ];


		return view('parking.offstreet.offstreet-parking');
	}

    public function getOffstreetZones()
    {

    	$offstreet_url = config('global.parurl'). 'Parking/GetOffstreetZones';
    	$data = [];
    	$zones_info = json_decode($this->to_curl($offstreet_url, $data));


    	return $zones_info;
    }



    public function offstreetParkingPayment(Request $request)
    {
        $url = $this->url. 'Offstreet/GetOffstreetCharge';

        $data = [
            'number_plate' => $request->car,
        ];

        $charges_info = json_decode($this->to_curl($url, $data));

        // dd($charges_info);

        return response()->json($charges_info);
    }

    //DAILY PARKING
    public function dailyParking()
    {
        $parking_info = $this->parking_categories;

    	$data = [
			'zones' => $parking_info->response_data->zones,
			'vehicle_categories' => $parking_info->response_data->vehicle_categories,
		];

        return response()->json($data);
    }

    //PARKING PAYMENT

    public function initiateOnstreetPayment(Request $request)
    {

        // dd($request->all());

    	$url = $this->url. 'Onstreet/InitiateOnstreetPayment';

        $data = [
            'phone_number' => $request->phone_number,
            'vehicle_category_id' => $request->daily_vehicle_category_code,
            'zone_id' => $request->zone_code,
            'number_plate' => $request->registration_number,
        ];
        //  dd($data);
    	$payment = json_decode($this->to_curl($url,$data));

        return response()->json($payment);

    }

    public function initiateOffstreetPayment(Request $request)
    {
        $url = $this->url. 'OffStreet/InitiateOffstreetPayment';

        $data = [
            'phone_number' => $request->phone_number,
            'number_plate' => $request->registration_number,
        ];

        $payment = json_decode($this->to_curl($url,$data));

        return response()->json($payment);

    }

    public function getParkingReceipt($id)
    {

        $url = $this->url . 'Parking/GetTransactionReceipt?transactionCode='.$id;

        $receipt_info = json_decode($this->get_curl($url));

        return response()->json($receipt_info);

    }


    public function viewParkingReceipt($id)
    {
        $url = $this->url . 'Parking/GetTransactionReceipt?transactionCode='.$id;


        $receipt_info = json_decode($this->get_curl($url));
        $receipt = $receipt_info->response_data;

        $brief_description = $receipt->receipt_entries[0]->number_plate. ' '.$receipt->receipt_entries[0]->vehicle_category.' ' .$receipt->receipt_entries[0]->zone;

        if(Session::has('resource'))
        {
            $receipt_user_id = Session::get('resource')['user_id'];
        }
        else
        {
            $receipt_user_id = null;
        }

            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->transaction_code
            ],
            [
                'brief_description' => $brief_description,
                'description' => $receipt->description,
                'receipt_no' => $receipt->receipt_number,
                'customer' => $receipt->account_from,
                'identifier' => $receipt->transaction_code,
                'date' => $receipt->receipt_date,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->total_payments,
                'category' => 'Parking'
            ]
        );

        $amount_in_words  = NumConvert::word(number_format($receipt->total_payments));
        return view('parking.receipt2', ['receipt' => $receipt, 'amount_in_words' => $amount_in_words]);
    }

    public function getOffStreetParkingReceipt($id)
    {


        $url = $this->url . 'Parking/GetTransactionReceipt?transactionCode='.$id;

        $receipt_info = json_decode($this->get_curl($url))->response_data->receipt_entries;

        return response()->json($receipt_info);

    }


    public function viewOffstreetParkingReceipt($id)
    {
        $url = $this->url . 'Parking/GetTransactionReceipt?transactionCode='.$id;

        $receipt_info = json_decode($this->get_curl($url));
        $receipt = $receipt_info->response_data;

        $amount_in_words  = NumConvert::word(number_format($receipt->total_payments));
        return view('parking.receipt', ['receipt' => $receipt, 'amount_in_words' => $amount_in_words]);
    }

    //SEASONAL PARKING

    public function seasonalParking()
    {
        $parking_info = $this->getParkingCategories();

        // dd($parking_info1;)
        $data = [
            'zones' => $parking_info->response_data->zones,
            'durations' => $parking_info->response_data->durations,
            'vehicle_categories' => $parking_info->response_data->vehicle_categories,
        ];
        return view('parking.seasonal.seasonal-parking', $data);

    }

    public function to_curl($url, $data){
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' .$this->token,
            'api-key:7935cf09148cbce9794db37be028260a',
            'Content-Length: ' . strlen(json_encode($data))
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
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

    public function token_curl($url, $data){
        $headers = array(
            'Content-Type: application/json',
            'api-key:7935cf09148cbce9794db37be028260a',
            'Content-Length: ' . strlen(json_encode($data))
        );

        // dd($headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);
        if (curl_errno($ch))
        {
            print "Error: " . curl_error($ch);
        }
        else
        {
            return $output;
        }
    }


    function get_curl( $url) {
        // append the header putting the secret key and hash
        $headers = array(
            'Content-Type: application/json',
            'api-key:7935cf09148cbce9794db37be028260a',
            'Authorization: Bearer ' .$this->token,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
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


}

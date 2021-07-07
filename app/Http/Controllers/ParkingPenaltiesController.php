<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ParkingPenaltiesController extends Controller
{
    protected $token;
    protected $url;
    //
    public function __construct()
    {
        $this->token = $this->getToken();
        $this->url = config('global.parking_url');
    }
    public function parkingPenalties()
    {

        $parking_info = $this->getParkingCategories();

        // dd($parking_info);

        $data = [
            'zones' => $parking_info->response_data->zones,
            'durations' => $parking_info->response_data->seasonal_durations,
            'vehicle_categories' => $parking_info->response_data->vehicle_categories,
        ];
    	return view('parking.penalties.parking-penalties', $data);
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

        // dd($parking_info);
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

    public function getParkingPenalties(Request $request)
    {
    	$url = config('global.parking_url'). 'Parking/GetPenaltyCharge';

        // dd($url);

    	$data = [
    		'number_plate' => $request->registration_number,
            'token' => $this->token,
    		
    	];

        // dd($data);

    	$charges_info = json_decode($this->to_curl($url, $data));

        // dd($charges_info);
    	return response()->json($charges_info);
    }



    public function initiateParkingPayment(Request $request)
    {   
        $url = $this->url. 'Onstreet/InitiatePenaltyPayment';

        $data = [
           
            'phone_number' => $request->phone_number,
            'number_plate' => $request->number_plate,



        ];

        // dd($data);
        $payment = json_decode($this->to_curl($url,$data));
        // dd($payment);
        return response()->json($payment);


    }






    public function to_curl($url, $data){
        // dd(json_encode($data));
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

    public function token_curl($url, $data){
        $headers = array(
            'Content-Type: application/json',
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
        // dd($this->token);
        if (curl_errno($ch))
        {
            print "Error: " . curl_error($ch);
        }
        else
        {
            return $output;
        }
    }
}

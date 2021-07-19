<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use NumConvert;
use PDF;
use QRCode;


class SeasonalController extends Controller
{
    //

    protected $url;

    public function __construct()
    {
    	$this->url = config('global.parking_url');
    }


    public function index()
    {

        	if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }

        	$url = $this->url . 'Parking/GetParkingsEntries';

            // dd($url);

        	$data = [
        		'token' => $token,
                "query" => "",
                "query_type" => 13,
                "date_from" => "",
                "date_to" => ""
        	];

            // dd($token);

        	$vehicles = json_decode($this->to_curl($url,$data));
        	// dd($vehicles);

        	$url = $this->url. 'Parking/GetParkingCategories';
	        $parking_info = json_decode($this->get_curl($url, $token));

            // dd($parking_info);

	        if(is_null($parking_info))
	        {
	            return redirect()->back()->withErrors('We are having trouble retrieving parking categories. Please try again later.');
	        }

	        if($parking_info->status_code !=200 )
	        {
	            return redirect()->back()->withErrors($parking_info->message);
	        }

            // dd($parking_info);
	        
	        $data = [
	        	'durations' => $parking_info->response_data->seasonal_durations,
	        	'vehicle_categories' => $parking_info->response_data->vehicle_categories,
	        	'vehicles' => $vehicles,
            ];
            
            // dd($data);  

            return response()->json($data);
        
    }

    public function addVehicle(Request $request)
    {
        // dd($request->all());
        // dd(Session::has('token'));

        if(Session::has('token'))
        {
            $token = Session::get('token');

        }
        else
        {
            $token = Session::get('seasonal_token');
        }

    	$data = [
    		'number_plate' => $request->seasonal_registration_no,
    		'category_id' => (int)$request->seasonal_vehicle_category_code,
    		'duration_id' => (int)$request->seasonal_duration_code,
    		'token' => $token,
    	];

        // dd($data);

    	$url = $this->url. 'Parking/AddParkingEntry';

        // dd($url);

    	$newVehicle = json_decode($this->to_curl($url, $data));

        // dd($newVehicle);

    	if(empty($newVehicle))
    	{
    		return response()->json($newVehicle);
    	}
    	if($newVehicle->status_code !=200)
    	{
    		return response()->json($newVehicle);
    	}

    	$vehicle = collect([
    		'number_plate' => $request->seasonal_registration_no,
    		'duration' => $request->duration,
    		'vehicle_type' => $request->vehicle_type,
    		'amount' => $request->amount,
    		'parking_code' => '',
    	]);

        if(Session::has('token'))
        {
            $token = Session::get('token');
        }
        else
        {
            $token = Session::get('seasonal_token');
        }

        $url = $this->url . 'Parking/GetParkingsEntries';

        // dd($url);

        $data = [
            'token' => $token,
            "query" => "",
            "query_type" => 13,
            "date_from" => "",
            "date_to" => ""
        ];

        // dd($token);

        $vehicles = json_decode($this->to_curl($url,$data));
        // dd($vehicles);

    	// dd($vehicle);

        $addVehicleResponse = collect([
            'newVehicle'=> $newVehicle,
            'newVehicleDetails'=> $vehicles
        ]);

    	Session::push('seasonal_vehicle', $vehicle);
    	return response()->json($addVehicleResponse);
    }

    public function removeEntry(Request $request)
    {
            if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }

        $url = $this->url .'Parking/RemoveParkingEntry?entryId='. $request->parking_code. '&companyId=0';

        // dd($url);

        $removedVehicle = json_decode($this->get_curl($url, $token));

        // dd($removedVehicle);

        if(Session::has('token'))
        {
            $token = Session::get('token');
        }
        else
        {
            $token = Session::get('seasonal_token');
        }

        $url = $this->url . 'Parking/GetParkingsEntries';
        // dd($url);

        $data = [
            'token' => $token,
            "query" => "",
            "query_type" => 13,
            "date_from" => "",
            "date_to" => ""
        ];

        // dd($token);

        $vehicles = json_decode($this->to_curl($url,$data));
        // dd($vehicles);

        $removeVehicleResponse = collect([
            'removedVehicle'=> $removedVehicle,
            'removedVehicleDetails'=> $vehicles
        ]);

        return response()->json($removeVehicleResponse);
    }

    public function initiatePayment(Request $request)
    {
            if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }
        $url = $this->url . 'Parking/InitiateParkingMultiple';

        $data = [
            'phone_number' => $request->phone_number,
            'payment_type' => 0,
            'save' => false,
            'entry_type' => 0,
            'company_id' => 0,
            // 'entry_ids' => $request->entry_ids,
            'token' => $token,
        ];

        dd($data);

        $paidVehicle = json_decode($this->to_curl($url, $data));

        // dd($paidVehicle);

        return response()->json($paidVehicle);
    }

    public function getReceipt($id)
    {
            if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }
        $url =  $this->url. 'Parking/GetSeasonalParkingReceipt';

        $data = [
            'receipt_number' => $id,
            'token' => $token,
        ];

        $receiptInfo = json_decode($this->to_curl($url,$data));

        return response()->json($receiptInfo);
    }

    public function viewReceipt($id)
    {
        if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }
        $url =  $this->url. 'Parking/GetSeasonalParkingReceipt';

        $data = [
            'receipt_number' => $id,
            'token' => $token,
        ];

        $receiptInfo = json_decode($this->to_curl($url,$data));

        $amount_in_words = NumConvert::word((int)$receiptInfo->response_data->amount);

        $receipt_data = [
                'receipt' => $receiptInfo->response_data,
                'amount_in_words' => $amount_in_words,
            ];
        // return view('parking.receipt2', ['receipt' => $receipt, 'amount_in_words' => $amount_in_words]);
            $pdf = PDF::loadView('seasonal.receipt', $receipt_data);  
            return $pdf->stream('receipt.pdf',array('Attachment'=>0));
        // 
        // return view('seasonal.receipt',['receipt' => $receiptInfo->response_data, 'amount_in_words' => $amount_in_words]);

}

    public function getStickers($id)
    {
        // dd($id);
        if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }
        $url =  $this->url. 'Parking/GetSeasonalParkingReceipt';

        $data = [
            'receipt_number' => $id,
            'token' => $token,
        ];

        $receiptInfo = json_decode($this->to_curl($url,$data));

        // dd($receiptInfo);

        return view('seasonal.stickers', ['receipt'=>$receiptInfo->response_data]);


    }
    public function viewStickers()
    {
        return view('seasonal.stickers-form');
    }

    public function printStickers(Request $request)
    {
        // dd($request->all);
        if(Session::has('token'))
            {
                $token = Session::get('token');
            }
            else
            {
                $token = Session::get('seasonal_token');
            }
        $url =  $this->url. 'Parking/GetSeasonalParkingReceipt';

        $data = [
            'receipt_number' => $request->stickers_id,
            'token' => $token,
        ];

        $receiptInfo = json_decode($this->to_curl($url,$data));

        if(is_null($receiptInfo))
            {
                return redirect()->back()->withErrors('We are having trouble retrieving your stickers. Please try again later.');
            }

            if($receiptInfo->status_code !=200 )
            {
                return redirect()->back()->withErrors('Payment not found! Please check the payment code.');
            }

            $stickers_data = [
                'receipt'=>$receiptInfo->response_data,
            ];

        // dd($receiptInfo);
            // $pdf = PDF::loadView('seasonal.stickers', $stickers_data);  
            // return $pdf->stream('stickers.pdf',array('Attachment'=>0));

        return view('seasonal.stickers', ['receipt'=>$receiptInfo->response_data]);


    }




























    public function to_curl($url, $data){
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' .$data['token'],
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
        $error = curl_error($ch);
        if (curl_errno($ch))
        {
            return "Error: " . curl_error($ch);
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


    function get_curl( $url, $token) {
        // append the header putting the secret key and hash
        $headers = array(
            'Content-Type: application/json',
            'api-key:7935cf09148cbce9794db37be028260a',
            'Authorization: Bearer ' . $token,
            // 'Authorization: Bearer ' .,
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

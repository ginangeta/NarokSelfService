<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QRCode;
use Session;
use App\Receipt;
use PDF;

class BillsController extends Controller
{
    //

    public function createBill()
    {
    	$url = config('global.url'). 'General/GetZonesWardsSubCounties';
    	$data = [];

    	$wards_info = json_decode($this->to_curl($url,$data));
    	$wards = $wards_info->response_data->wards;
    	return view('bills.create-bill', ['wards' => $wards]);
    }

    public function payBill(Request $request)
    {

    	return view ('bills.pay-bill');
    }


    public function generateBill(Request $request)
    {
    	$url = config('global.bill_url'). 'CreateBill';
    	$data = $request->all();
    	$bill_info = json_decode($this->generate_curl($url, $data));
    	$bill = $bill_info->response_data->billinfo[0];

        $semi_bill_number = $bill->BillNo;

        // dd($semi_bill_number);

        $generate_bill_url = config('global.bill_url'). 'GenerateBill';

        $bill_data =
        [
            'BillNumber' => $semi_bill_number,
            'UserID' => 1,
        ];

        $bill_info = json_decode($this->create_curl($generate_bill_url, $bill_data));

        $bill_number = $bill_info->response_data->bill_number;
        // dd($bill_number);

    	return $bill_number;
    }

    public function getBillDetails(Request $request)
    {
        // dd($request->all());
    	$url = config('global.biller_url').'users/authenticate';

      // dd($url);

        $data = [
            "email" => "biller@narok.prod",
            "password" => "biller@2021!"
        ];

        // dd($data);

        $token = json_decode($this->to_curl($url,$data));
        // dd($token);
        $header = $token->data->auth_token;

        // dd($header);

        if($token->status === 200) {

            $url = config('global.biller_url').'/billing/invoice';
            $data = [
                'billNo' => $request->bill_number
            ];

            //dd($url);
            $bill_info = json_decode($this->token_curl($url,$data,$header));

            // dd($bill_info);


            if(empty($bill_info))
            {
                return redirect()->back()->withErrors("We're having trouble retrieving your bill details. Please try again later");
            }
            $bill = $bill_info;
            return response()->json($bill);
        }else{
            return redirect()->back()->withErrors("We're having trouble retrieving your bill details. Please try again later");
        }

    }


    public function getBillReceipt($id)
    {
        $url = config('global.bill_url').'billing/GetReceipt';

        $data = ['BillNumber' => $id];

        $receipt_info = json_decode($this->receipt_curl($url, $data));

        // dd($receipt_info);
        if(empty($receipt_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your receipt. Please try again later");
        }

        return response()->json($receipt_info);
    }

    public function viewBillReceipt($id)
    {
      $url = config('global.bill_url').'billing/GetReceipt';

        $data = ['BillNumber' => $id];

        $receipt_info = json_decode($this->receipt_curl($url, $data))->response_data;
        // dd($receipt);
        if(empty($receipt_info))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your bills. Please try again later");
        }
        $receiptInfo = $receipt_info->receiptInfo;
        $receipt = $receipt_info->billInfo;

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
                'identifier' => $receiptInfo->BillNo
            ],
            [
                'brief_description' => $receipt->Description,
                'description' => $receipt->FeeDescription,
                'receipt_no' => $receiptInfo->ReceiptNo,
                'customer' => $receipt->Customer,
                'identifier' => $receiptInfo->BillNo,
                'date' => $receiptInfo->ReceiptDate,
                'user_id' => $receipt_user_id,
                'amount' => $receiptInfo->RecieptAmount,
                'category' => 'Bills'

            ]
        );


        return view('bills.receipt', ['receipt' => $receipt, 'receiptInfo' => $receiptInfo]);
    }

    public function initiateBillPayment(Request $request)
    {
      // dd($request->all());
    	// $url = config('global.'). 'billing/MpesaPayment';

      $url = 'https://payme.revenuesure.co.ke/api/index.php';

      // dd($url);

    	$data = [
        'function' => 'CustomerPayBillOnlinePush',
        'PayBillNumber' => 272525,
        'Amount' => $request->amount,
        'AccountReference' => $request->bill_number,
        'TransactionDesc' => $request->bill_id,
    		'BillNumber' => $request->bill_number,
    		'PhoneNumber' => $request->phone_number,
        'FullNames' => ''
    	];

      // dd($data);

    	$payment_info = json_decode($this->pay_curl($url, $data));

      

      // dd($payment_info);

      if(empty($payment_info))
        {
            return redirect()->back()->withErrors("We're having trouble initiating payment. Please try again later");
        }

        
    	return response()->json($payment_info);
    }

    public function printBill($bill_number)
    {
      $url = config('global.biller_url'). 'users/authenticate';

      // dd($url);

      $data = [
          "email" => "biller@narok.prod",
          "password" => "biller@2021!"

      ];


      $token = json_decode($this->to_curl($url,$data))->data->auth_token;

      // dd($token);
      
      $url = config('global.biller_url'). 'billing/invoice';

      // dd($url);

      $data = [
          'billNo' => $bill_number,
          'token' => $token
      ];
      // dd($data);



      $sent = json_decode($this->bill_curl($url,$data));  
      
      // dd($sent);

      return view('documents.bill', ['bill' => $sent->data]);

      // return view('bill', ['bill' => $bill]);
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
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_SSL_VERIFYHOST => FALSE,
          CURLOPT_SSL_VERIFYPEER => FALSE,
          CURLOPT_POSTFIELDS => array('BillNumber' => $data['BillNumber']),
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
        $headers = array(
            'Content-Type: application/json',
//            'Authorization: Bearer ' .$header,
            'Content-Length: ' . strlen(json_encode($data))
        );
        //dd($headers);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
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

        curl_close($ch);

    }


    public function generate_curl($url, $data){
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
		  CURLOPT_POSTFIELDS => array('IncomeTypeID' => '1','FeeID' => '73','Customer' => $data['name'],'Description' => $data['description'],'WardID' => '1','UserID' => '1','Amount' => $data['amount'],'RefID' => '1'),
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

    public function create_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('BillNumber' => $data['BillNumber'],'UserID' => '1'),
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

    public function bill_payment_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('BillNumber' => $data['BillNumber'],'PhoneNumber' => $data['PhoneNumber']),
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


    public function token_curl($url, $data, $header)
    {
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' .$header,
            'Content-Length: ' . strlen(json_encode($data))
        );

        //dd($headers);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);

        //dd($output);
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

    public function bill_curl($url, $data){
      $headers = array(
          'Content-Type: application/json',
         'Authorization: Bearer ' .$data['token'],
          'Content-Length: ' . strlen(json_encode($data))
      );
      //dd($headers);


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

      curl_close($ch);
     
      
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
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_SSL_VERIFYHOST => FALSE,
      CURLOPT_SSL_VERIFYPEER => FALSE,
      CURLOPT_POSTFIELDS => array('function' => 'CustomerPayBillOnlinePush','PayBillNumber' => '272525','Amount' => $data['Amount'],'PhoneNumber' => $data['PhoneNumber'],'AccountReference' => $data['AccountReference'],'TransactionDesc' => $data['TransactionDesc'],'FullNames' => $data['FullNames']),
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

}

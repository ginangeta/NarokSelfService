<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use QRCode;
use Illuminate\Support\Str;
use NumConvert;
use App\Receipt;



class ReceiptController extends Controller
{
    //

    public function getReceiptDetails(Request $request)
    {

            $url = config('global.trade-license');
            //dd($url);
            $data = [
                'function'=> 'getReceipt',
                'billNo' => $request->billNo
            ];

            //dd($data);
            $this->data['receipt'] = json_decode($this->food_hygiene_alex_to_curl($url, $data));

            //dd($this->data);



            if ($this->data['receipt']->status ===200) {
              $url = config('global.biller_url'). 'users/authenticate';

              // dd($url);

              $data = [
                  "email" => "akiburei@gmail.com",
                  "password" => "123456789"

              ];


              $token = json_decode($this->to_curl($url,$data))->data->auth_token;

              $url = config('global.biller_url'). 'invoice/receipt/count';


              $data = [
                  'receiptNo' => $this->data['receipt']->data[0]->receiptInfo->receiptNo,
                  'token' => $token
              ];

              $counted = json_decode($this->bill_curl($url,$data));

              $receipt = $this->data['receipt']->data[0];

                // return view('receipts.demo-receipt')->with($this->data->receipt->data[0]);
                return view(  'receipts.receipt-demo', ['receipt'=> $receipt]);
            }else{
                return Redirect::back()->withErrors($this->data['receipt']->message);
            }

    }

    public function generateReceipt(Request $request)
      {
        // dd($request->all());



        if(Session::has('resource'))
        {
            $receipt_user_id = Session::get('resource')['user_id'];
        }
        else
        {
            $receipt_user_id = null;
        }


        if(Str::startsWith(strtoupper($request->bill_number), 'PKN') || Str::startsWith(strtoupper($request->bill_number), 'PKF'))
        // if($request->type == 'parking')
        {
            $url = 'https://www.revenuesure.co.ke/RevenueSure/api/Payment/GetTransactionReceipt?identifierCode='.strtoupper($request->bill_number);

            // $url = 'https://payme.revenuesure.co.ke/?function=getParkingPayments&numberPlate='.strtoupper($request->bill_number);


          $receipt_info = json_decode($this->get_curl($url));

          // dd($receipt_info);

            return response()->json($receipt_info);
        }

        if(Str::startsWith(strtoupper($request->bill_number), 'PKX'))
        {
            $url = 'https://www.revenuesure.co.ke/RevenueSure/api/Parking/GetSeasonalParkingReceipt';

            $data = [
            'receipt_number' => $request->bill_number,
            'token' => Session::get('seasonal_token'),
            ];

            $receipt_info = json_decode($this->to_curl($url,$data));

            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            $receipt = $receipt_info->response_data;


            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            $amount_in_words = NumConvert::word((int)$receipt_info->response_data->amount);
            return response()->json($receipt_info);
        }

       //Default


        $url = config('global.bill_url').'billing/GetReceipt';

        $data =
        [
            'BillNumber' => strtoupper($request->bill_number)
        ];


        $receipt_info = json_decode($this->receipt_curl($url, $data));

            if(empty($receipt_info))
            {
              return response()->json($receipt_info);
            }

            if($receipt_info->status_code !=200)
            {
              return response()->json($receipt_info);
            }

            if(Str::startsWith(strtoupper($request->bill_number), 'LR'))
            {
              $category = "Land";
            }
            else if(Str::startsWith(strtoupper($request->bill_number), 'HS'))
            {
              $category = "Rent";
            }
            else if(Str::startsWith(strtoupper($request->bill_number), 'PC'))
            {
              $category = "Seasonal";
            }
            else
            {
              $category = "Bills";
            }


             $receipt = $receipt_info->response_data;


        $amount_in_words = NumConvert::word((int)$receipt->receiptInfo->RecieptAmount);
        // dd($receipt);

        return response()->json($receipt_info);

    }

    public function getReceipt($bill_number)
    {

      $url = config('global.biller_url'). 'users/authenticate';

        // dd($url);

        $data = [
            "email" => "akiburei@gmail.com",
            "password" => "123456789"

        ];


        $token = json_decode($this->to_curl($url,$data))->data->auth_token;

        $url = config('global.biller_url'). 'invoice/receipt';

        // dd($url);

        $data = [
            'billNo' => $bill_number,
            'payReferenceNo' => '',
            'receiptNo' => '',
            'token' => $token
        ];

        $sent = json_decode($this->bill_curl($url,$data));


        return response()->json($sent);
    }

    public function printReceipt($bill_number)
    {

      $url = config('global.biller_url'). 'users/authenticate';

        // dd($url);

        $data = [
            "email" => "akiburei@gmail.com",
            "password" => "123456789"

        ];


        $token = json_decode($this->to_curl($url,$data))->data->auth_token;

        $url = config('global.biller_url'). 'invoice/receipt';

        // dd($url);

        $data = [
            'billNo' => $bill_number,
            'payReferenceNo' => '',
            'receiptNo' => '',
            'token' => $token
        ];

        $sent = json_decode($this->bill_curl($url,$data));

        // dd($sent);

        $url = config('global.biller_url'). 'invoice/receipt/count';


        $data = [
            'receiptNo' => $sent->data[0]->receiptInfo->receiptNo,
            'token' => $token
        ];

        $counted = json_decode($this->bill_curl($url,$data));


        return view('receipts.receipt-demo', ['receipt'=> $sent->data[0]]);
    }

    // public function getReceipt($id)
    // {
    //     $url = config('global.bill_url').'billing/GetReceipt';
    //     // dd($url);

    //     $data = ['BillNumber' => $id];

    //     $receipt_info = json_decode($this->receipt_curl($url, $data));

    //     // dd($receipt_info);

    //     return response()->json($receipt_info);
    // }



    public function viewReceipt($bill_number)
      {
        if(Session::has('resource'))
        {
            $receipt_user_id = Session::get('resource')['user_id'];
        }
        else
        {
            $receipt_user_id = null;
        }

        if(Str::startsWith(strtoupper($bill_number), 'PKN') || Str::startsWith(strtoupper($bill_number), 'PKF'))
        {
            $url = 'https://www.revenuesure.co.ke/RevenueSure/api/Payment/GetTransactionReceipt?identifierCode='.strtoupper($bill_number);

            // $url = 'https://payme.revenuesure.co.ke/?function=getParkingPayments&numberPlate='.strtoupper($bill_number);



          $receipt_info = json_decode($this->get_curl($url));

          // dd($receipt_info);


            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            $receipt = $receipt_info->response_data;

            $brief_description = $receipt->identifier. ' '.$receipt->duration.' ' .$receipt->zone;

            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receipt_number
            ],
            [
                'brief_description' => $brief_description,
                'description' => $receipt->briefDescription,
                'receipt_no' => $receipt->receipt_number,
                'customer' => $receipt->payment_from,
                'identifier' => $receipt->receipt_number,
                'date' => $receipt->transaction_time,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->total_amount,
                'category' => 'Parking'
            ]
        );

            $amount_in_words  = NumConvert::word((int)$receipt->total_amount);

            $data = [
                'receipt' => $receipt,
                'amount_in_words' => $amount_in_words,
            ];

            $pdf = PDF::loadView('parking.receipt3', $data);
            return $pdf->stream('receipt.pdf',array('Attachment'=>0));
            // return view('parking.receipt3', $data);
        }



        if(Str::startsWith(strtoupper($bill_number), 'PKX'))
        {
            $url = 'https://www.revenuesure.co.ke/RevenueSure/api/Parking/GetSeasonalParkingReceipt';

            $data = [
            'receipt_number' => strtoupper($bill_number),
            'token' => Session::get('seasonal_token'),
        ];


            $receipt_info = json_decode($this->to_curl($url,$data));

            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            $receipt = $receipt_info->response_data;


            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }


            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receipt_number
            ],
            [
                'brief_description' => 'Seasonal parking',
                'description' => 'Seasonal parking',
                'receipt_no' => $receipt->receipt_number,
                'customer' => $receipt->payment_from,
                'identifier' => $receipt->receipt_number,
                'date' => $receipt->date_paid,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->amount,
                'category' => 'Seasonal Parking'
            ]
        );
            $amount_in_words = NumConvert::word((int)$receipt_info->response_data->amount);
            // return view('seasonal.receipt',['receipt' => $receipt_info->response_data, 'amount_in_words' => $amount_in_words]);
            $data = [
                'receipt' => $receipt,
                'amount_in_words' => $amount_in_words,
            ];
            $pdf = PDF::loadView('seasonal.receipt', $data);
            return $pdf->stream('receipt.pdf',array('Attachment'=>0));
        }





        $url = config('global.bill_url').'billing/GetReceipt';

        $data =
        [
            'BillNumber' => strtoupper($bill_number)
        ];

        $receipt_info = json_decode($this->receipt_curl($url, $data));
        if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            if(Str::startsWith(strtoupper($bill_number), 'LR'))
            {
              $category = "Land";
            }
            else if(Str::startsWith(strtoupper($bill_number), 'HS'))
            {
              $category = "Rent";
            }
            else if(Str::startsWith(strtoupper($bill_number), 'PC'))
            {
              $category = "Seasonal";
            }
            else if(Str::startsWith(strtoupper($bill_number), 'BP'))
            {
              $category = "SBP";
            }
            else
            {
              $category = "Bills";
            }
            $receipt = $receipt_info->response_data;


            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receiptInfo->BillNo
            ],
            [
                'brief_description' => $receipt->billInfo->Description,
                'description' => $receipt->billInfo->FeeDescription,
                'receipt_no' => $receipt->receiptInfo->ReceiptNo,
                'customer' => $receipt->billInfo->Customer,
                'identifier' => $receipt->receiptInfo->BillNo,
                'date' => $receipt->receiptInfo->ReceiptDate,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->receiptInfo->RecieptAmount,
                'category' => $category
            ]
        );
        $amount_in_words  = NumConvert::word((int)$receipt_info->response_data->receiptInfo->RecieptAmount);


        $data = [
            'receipt' => $receipt,
            'amount_in_words' => $amount_in_words,
        ];


        if($receipt->billInfo->AccountNo == '1-8115')
        {
            $pdf = PDF::loadView('health.receipt', $data);
            return $pdf->stream('receipt.pdf',array('Attachment'=>0));
            // return view('health.receipt', ['receipt' => $receipt, 'amount_in_words' => $amount_in_words]);
        }
        else
        {
            $pdf = PDF::loadView('receipts.receipt3', $data);
            return $pdf->stream('receipt.pdf',array('Attachment'=>0));
            // return view('receipts.receipt3', ['receipt' => $receipt, 'amount_in_words' => $amount_in_words]);
        }



    }


    public function saveReceipts($bill_number, $user_id)
      {

        $receipt_user_id = $user_id;

        if(Str::startsWith(strtoupper($bill_number), 'PKN') || Str::startsWith(strtoupper($bill_number), 'PKF'))
        {
            $url = 'http://revenuesure.co.ke/RevenueSure/api/Payment/GetTransactionReceipt?identifierCode='.strtoupper($bill_number);
            // dd($url);

            $receipt_info = json_decode($this->get_curl($url));

            // dd($receipt_info);
            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              $data = [
                'status_code' => 400,
                'message' => 'Transaction was not saved',
                'response_data' => null,
              ];

              return $data;
            }

            $receipt = $receipt_info->response_data;

            $brief_description = $receipt->identifier. ' '.$receipt->duration.' ' .$receipt->zone;

            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receipt_number
            ],
            [
                'brief_description' => $brief_description,
                'description' => $receipt->briefDescription,
                'receipt_no' => $receipt->receipt_number,
                'customer' => $receipt->payment_from,
                'identifier' => $receipt->receipt_number,
                'date' => $receipt->transaction_time,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->total_amount,
                'category' => 'Parking'
            ]
        );
            $data = [
                'status_code' => 200,
                'message' => 'Transaction saved successfully',
                'response_data' => null,
              ];

              return $data;
        }

        if(Str::startsWith(strtoupper($bill_number), 'PKX'))
        {
            $url = 'https://www.revenuesure.co.ke/RevenueSure/api/Parking/GetSeasonalParkingReceipt';

            $data = [
            'receipt_number' => strtoupper($bill_number),
            'token' => Session::get('seasonal_token'),
        ];


            $receipt_info = json_decode($this->to_curl($url,$data));

            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }

            $receipt = $receipt_info->response_data;


            if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              return redirect()->back()->withErrors("The reference number " . strtoupper($bill_number) . " has no payment.");
            }


            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receipt_number
            ],
            [
                'brief_description' => 'Seasonal parking',
                'description' => 'Seasonal parking',
                'receipt_no' => $receipt->receipt_number,
                'customer' => $receipt->payment_from,
                'identifier' => $receipt->receipt_number,
                'date' => $receipt->date_paid,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->amount,
                'category' => 'Seasonal Parking'
            ]
        );

            $data = [
                'status_code' => 200,
                'message' => 'Transaction saved successfully',
                'response_data' => null,
              ];

              return $data;
        }

        if(Str::startsWith(strtoupper($bill_number), 'BP'))
        {
           $url = 'https://biller.revenuesure.co.ke/permit/api/sbp/getreceipt';

        $data =
        [
            'BillNo' => strtoupper($bill_number)
        ];

        $receipt_info = json_decode($this->bp_receipt_curl($url, $data));

        if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              $data = [
                'status_code' => 400,
                'message' => 'Transaction was not saved',
                'response_data' => null,
              ];

              return $data;
            }

        // dd($receipt_info);
            $amount_in_words  = NumConvert::word((int)$receipt_info->response_data->receiptinfos->RecieptAmount);

            $receipt = $receipt_info->response_data;
            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receiptinfos->BillNo
            ],
            [
                'brief_description' => $receipt->billinfos->Description,
                'description' => $receipt->billinfos->FeeDescription,
                'receipt_no' => $receipt->receiptinfos->ReceiptNo,
                'customer' => $receipt->billinfos->Customer,
                'identifier' => $receipt->receiptinfos->BillNo,
                'date' => $receipt->receiptinfos->ReceiptDate,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->receiptinfos->RecieptAmount,
                'category' => 'SBP'
            ]
        );
            $data = [
                'status_code' => 200,
                'message' => 'Transaction saved successfully',
                'response_data' => null,
              ];

              return $data;

         }




        $url = config('global.bill_url').'billing/GetReceipt';

        $data =
        [
            'BillNumber' => strtoupper($bill_number)
        ];

        $receipt_info = json_decode($this->receipt_curl($url, $data));
        if($receipt_info->status_code !=200 || empty($receipt_info))
            {
              $data = [
                'status_code' => 400,
                'message' => 'Transaction was not saved',
                'response_data' => null,
              ];

              return $data;
            }


            if(Str::startsWith(strtoupper($bill_number), 'LR'))
            {
              $category = "Land";
            }
            if(Str::startsWith(strtoupper($bill_number), 'HS'))
            {
              $category = "Rent";
            }
            if(Str::startsWith(strtoupper($bill_number), 'PC'))
            {
              $category = "Seasonal";
            }
            if(Str::startsWith(strtoupper($bill_number),'MS'))
            {
              $category = "Bills";
            }


            $receipt = $receipt_info->response_data;


            $receipt_entry = Receipt::firstOrCreate(
            [
                'identifier' => $receipt->receiptInfo->BillNo
            ],
            [
                'brief_description' => $receipt->billInfo->Description,
                'description' => $receipt->billInfo->FeeDescription,
                'receipt_no' => $receipt->receiptInfo->ReceiptNo,
                'customer' => $receipt->billInfo->Customer,
                'identifier' => $receipt->receiptInfo->BillNo,
                'date' => $receipt->receiptInfo->ReceiptDate,
                'user_id' => $receipt_user_id,
                'amount' => $receipt->receiptInfo->RecieptAmount,
                'category' => $category
            ]
        );

      $data = [
                'status_code' => 200,
                'message' => 'Transaction saved successfully',
                'response_data' => null,
              ];

              return $data;
    }
    public function downloadReceipt($reference_number)
    {
      		$url = config('global.url') . 'Payment/GetTransactionReceipt?identifierCode=';
            $reference_number = $reference_number;
            // dd($reference_number);
            $data = ['reference_number' => $reference_number];

            $receipt_info = json_decode(stripslashes($this->get_curl($url,$data)));

            $receipt = $receipt_info->response_data;
            // $receipt = $receipt_details;
            // dd($receipt);
      		$pdf = PDF::loadView('welcome');
      		return $pdf->download('receipt.pdf');


    }


    function to_curl($url, $data){

        $headers = array
        (
            'Content-Type: application/json',
            'Content-Length: ' . strlen( json_encode($data) )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
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

    function get_curl( $url) {
        // append the header putting the secret key and hash
        $headers = array(
            'Content-Type: application/json',
            'api-key:7935cf09148cbce9794db37be028260a',
            // 'Authorization: Bearer ' .$token,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
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

        // dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }


    public function bp_receipt_curl($url, $data){
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
          CURLOPT_POSTFIELDS => array('BillNo' => $data['BillNo']),
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


}

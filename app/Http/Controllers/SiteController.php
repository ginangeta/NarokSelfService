<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function home(){
        if(!Session::has('seasonal_token'))
        {
            $url = config('global.url'). 'Account/GetToken';

            $data = [
                'user_name' => 'PARKING',
                'password' => 'lockfree',
            ];

            $token_info = json_decode(stripslashes($this->token_curl($url,$data)));

            if(empty($token_info))
            {
                return view('index');
            }

            if($token_info->status_code !=200)
            {
                return view('index');
            }

            $token = $token_info->token;

            Session::put('seasonal_token', $token);
        }
        
        return view('index');
    } 
    
    public function signup(){
        return view('auth.register');
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //

    public function signin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $this->url = config('global.auth_url');
        $url=$this->url. 'Account/GetToken';

        $data = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'password' => 'required'
        ]);

        // dd($data);

        $data= json_decode(stripslashes($this->to_curl($url,$data)));
        // dd($data);
        $status = $data->status_code;
        $message = $data->message;
        $auth = $data->authentication_status;
        $role = $data->roles;

        if (empty($data)){
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        }else{
            if ($status == 200  && $auth==true){

                $product = collect([
                    'is_login'=>1,
                    'token' => $data->token,
                    'roles' => $data->roles,
                    'user_id'=>$data->user_id,
                    'username' =>$data->username,
                    'email' => $data->email,
                    'national_id' => $data->national_id,
                    'user_full_name'=>$data->user_full_name,
                    'phone_number' => $data->msisdn,
                ]);

                // dd($product);
                Session::put('resource', $product);
                Session::put('token', $data->token);

                // dd(Session::all());

                    if(Session::get('Reset'))
                    {
                        return redirect()->route('password.new');
                    }
                    else
                    {

                        $previous_url = Session::get('url');
                        $previous_url = null;

                        // dd($previous_url);

                        if(is_null($previous_url))
                        {
                            return redirect()->route('home');

                        }
                        else
                        {
                           return redirect()->intended($previous_url); 
                        }
                
                    }
            //  return Redirect::route('welcome')->withErrors(['Success']);
            }else{
                return Redirect::back()->withErrors($message);
            }
        }
    }

    public function registration(Request $request)
    {

        // $this->url = config('global.url');
        // $url=$this->url. 'Account/Register';

        $url = 'http://dashboards.revenuesure.co.ke/Authentication/api/'.'Account/Register';

    
    	$validatedData = $request->validate([
    		'full_name' => ['required', 'string', 'max:255'],
    		// 'middle_name' => ['required', 'string', 'max:255'],
    		'email' => ['required', 'email', 'max:255'],
    		'phone_number' => ['required'],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
    		'password_confirmation' => ['required', 'min:6'],
    		'role' => ['required', 'string'],
    		// 'user_name' => ['required', 'string'],
    		'roles_List' => ['required'],
    	]);

        $name_array = explode(' ',$request->full_name);

        if(sizeof($name_array)<2)
        {
            return redirect()->back()->withErrors('Please enter your full name');
        }

        // dd($name_array);
        $data = [
            'first_name' => $name_array[0],
            'last_name' => $name_array[1],
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $request->password,
            'role' => $request->role,
            'user_name' => $request->email,
            'sub_roles_list' => [25],
        ];

        // dd($url);

        $this->data['regData'] = json_decode(stripslashes($this->to_curl($url,$data)));
        // dd($this->data);
        $status = $this->data['regData']->status_code;
        $message = $this->data['regData']->message;

        if (empty($this->data['regData'])){
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        }else{
            if ($status == 200){
                return Redirect::route('login')->with('success', 'You have been registered successfully. Log in to access services.');
            }else{
                return Redirect::back()->withErrors($message);
            }
        }

    }

    public function forgotPassword()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        // dd(Session::get('resource')['user_id']);

        if (is_null(Session::get('resource'))) {
            return redirect()->route('login');
        }else{

            $user_id= Session::get('resource')['user_id'];
            $old_password= $request->Sent_password;
            $new_password = $request->Reset_password;
            $token = $request->_token;

            $data=[
                'user_id'=>$user_id,
                'old_password' =>$old_password,
                'new_password'=>$new_password,
                'token' => $token
            ];
            $this->url = config('global.auth_url');
            $url = $this->url . 'Account/ChangePassword';

            $status=json_decode($this->to_curl($url, $data));

        //    dd($status);
        //    dd($status->status_code);
            if(empty($status))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details.Please try again later.");
        }
            if ($status->status_code == 200){
                Session::put('Reset', false);
                return redirect()->route('signin')->with('success', $status->message);
            }else{
                return redirect()->back()->withErrors($status->message);

            }


        }

        // dd($created);

        if(is_null($created))
        {
            return redirect()->route('password.new')->with('errors', 'An error occured.');
        }

        if(!$created->success)
        {
            return redirect()->route('password.new')->with('errors', $created->msg);
        }

        // dd($created);

        return redirect()->route('home')->with('success', 'The password has been reset successfully.');

    }   

    public function newPassword(){
        return view('auth.newpassword');

    }

    public function resetPassword(Request $request)
    {
        // dd($request->all());

        if($request->emailaddress){
            $username= $request->emailaddress;

        }else{
            $username= $request->phonenumber;
        }

        $token = Session::get('token');
        $data=[
            'username'=>$username,
            'token' => $token
        ];
        $this->url = config('global.auth_url');
        $url = $this->url . 'Account/ForgotPassword';

        $status=json_decode($this->to_curl($url, $data));
        Session::put('forgot_url', url()->current());

        // dd($status->message);
        if(empty($status))
        {
            return redirect()->back()->withErrors("We're having trouble retrieving your details.Please try again later.");
        }

        if ($status->status_code == 200){
            Session::put('Reset', true);
            return redirect()->route('signin')->with('success', $status->message);

        }else{
            return redirect()->back()->withErrors($status->message);
        }

    }

    public function userResetPassword(Request $request)
    {
        // dd($request->all());
        $url = config('global.url').'user/forgot_password/';
        // dd($url);

        $data = [
            'email' => Session::get('user')->username,
        ];

        // dd($data);

        $response = Http::post($url,$data);
        // dd($response);

        $created = json_decode($response->body());

        // dd($created);

        if(is_null($created))
        {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if(!$created->success)
        {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);

        return view('auth.change-password')->with('success', $created->msg);


    }

    public function otpLogin()
    {
        // dd($request->all());
        $url = config('global.url').'otp_login/';
        // dd($url);

        $phone = Session::get('userphone');

        $data = [
            'phone' => $phone,
        ];

        // dd($data);

        $response = Http::post($url,$data);
        // dd($response);

        $created = json_decode($response->body());

        // dd($created);

        if(is_null($created))
        {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if(!$created->success)
        {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);

        return redirect()->route('otp', [
            'phoneNumber' => $phone] );

    }

    public function validateOTP(Request $request)
    {
        // dd($request->all());
        $url = config('global.url').'validate_otp/';
        // dd($url);

        $data = [
            'phone' => $request->phone,
            'otp' => $request->otp,
        ];

        // dd($data);

        $response = Http::post($url,$data);
        // dd($response);
        $created = json_decode($response->body());
        // dd($created);

        if(is_null($created))
        {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if(!$created->success)
        {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);
        Session::put('user', $created->data->data);
        Session::put('Usertoken', $created->data->data->token);

        return redirect()->route('details');

    }

    public function logout()
    {
        Session::flush('token');
        Session::flush('user');

        return redirect()->route('home');
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

}

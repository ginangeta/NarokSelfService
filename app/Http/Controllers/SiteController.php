<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function home(){
        return view('index');
    } 
    public function signup(){
        return view('auth.register');
    } 
}


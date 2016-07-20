<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    public function index(){
        $user = JWTAuth::parseToken()->authenticate();
        $data = [
            'token'=>$_GET['token'],
            'user'=>$user
        ];
        return view("home.index",$data);
    }

    public function info(){
        return view("home.info")->with('token',$_GET['token']);
    }
}

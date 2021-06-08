<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    //
    public function index(){
        return view('authentication.index');
    }

    public function login(Request $request){
        // echo $request->username;
        // echo $request->password;
        $username = $request->username;
        $password = $request->password;
        $auth = new User();
        $login = $auth->auth($username,$password);
        if($login==true)
            return "1";
        else
            return "0";
        //return json_encode(User::all());
    }

    public function dashboard(){
        return view('authentication.homepage');
    }

    public function main(){
        return view('dashboard.dashboard');
    }
}

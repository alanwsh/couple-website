<?php

namespace App\Http\Controllers;
use App\Models\Trie;
use Illuminate\Http\Request;

class TriEController extends Controller
{
    public function index(){
        return view('generate');
    }

    public function generate(Request $request){
        $number = $request->post('number');
        // $client = new \Guzzle\Service\Client();
        // $body['name'] = "Testing";
        $url = "http://localhost/generateapi/";
        // $response = $client->request("POST",$url,['form_params'=>$body]);   
        // $response = $client->send($response);
        // return $response;   
    }
}

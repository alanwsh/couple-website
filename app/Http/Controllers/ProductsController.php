<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(){
        $title = "Welcome to Laravel 8";
        $description = "Create by Alan";

        $data = [
            'productOne' => 'IPhone',
            'productTwo' => 'Samsung'
        ];
        //return view('products.index',compact('title','description'));
        //return view('products.index')->with('data',$data);
        return view('products.index',['data'=>$data]);
    }

    public function about(){
        return "This is about page";
    }

    public function show($name){
        $data = [
            'iphone' => 'iPhone11',
            'samsung' => 'SamsungS9'
        ];
        return view('products.index',['products'=>$data[$name]??'Product '.$name.' does not exist']);
    }
}

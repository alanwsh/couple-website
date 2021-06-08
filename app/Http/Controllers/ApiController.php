<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index(){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $item = DB::table('iteminven')->where('ItemId',$id)->get();
        }
        else{
            $item = DB::table('iteminven')->get();
        }
            $data = json_decode($item,true);
            $item_size = sizeof($item);
            for($i=0;$i<$item_size;$i++){
                $item_price = $item[$i]->ItemPrice;
                $discount_code = $item[$i]->DiscountCode;
                $discount_percentage = DB::table('discount')->where('DiscountCode',$discount_code)->value('discount');
                $discount_price = round($item_price*(1-($discount_percentage/100)),2);   
                $data[$i]['DiscountPrice'] = $discount_price;
            }
            $item = json_encode($data);
        return json_decode($item);
    }
}

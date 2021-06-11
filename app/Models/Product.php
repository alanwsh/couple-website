<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;
    public function get_list(){
        $product  = DB::table('product')->get();
        return $product;
    }
    public function del_product($id){
        $delete_result = DB::table('product')->where('id',$id)->delete();
        return $delete_result;
    }
}

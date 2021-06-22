<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Media extends Model
{
    use HasFactory;
    protected $table = "media";
    public function get_media(){
        $result = DB::table('media')->get();
        return $result;
    }
    public function upload_media($description,$extension){
        $result = DB::table('media')->insert(['description'=>$description,'filetype'=>$extension]);
        $id = DB::table('media')->max('id');
        $data = array(
            'id'=>$id,
            'result'=>$result);
        return $data;
    }
}

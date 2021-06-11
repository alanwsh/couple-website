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
}

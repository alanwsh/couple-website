<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model{
    use HasFactory;
    public $table = "user";
    public function auth($username,$password){
        //return DB::table('user')->where('username',$username)->first();
        //$data = DB::table('user')->
        $result = DB::table('user')->where('username',$username)->where('password',$password)->get();
        if(count($result))
            return true;
        else
            return false;
    }
}
// class User extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for arrays.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * The attributes that should be cast to native types.
//      *
//      * @var array
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];
// }

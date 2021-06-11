<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Models\Product;
class HomeController extends Controller
{
    //
    private $total_product;
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

    public function upload_media(Request $request){
        $image = $request->file->get();
        echo $image;
    }
    public function main(Request $request){
        $id = $request->get('id');
        if($id==1)
            return "Dashboard";
        elseif($id==2)
            return "User Profile";
        elseif($id==3)
            return "To-do List";
        elseif($id==4){
            $media = new Media();
            $library = $media->get_media();
            return view('dashboard.media',compact('library'));
        }
        elseif($id==5)
            return "Blog Post";
        else
            return "My Favourites";
        //return view('dashboard.dashboard')->with('menu',$id);
    }

    public function load_product(){
        $product_model = new Product();
        $product = $product_model->get_list();
        $this->total_product = count($product);
        return view('products.dashboard',compact('product'));
    }

    public function delete_product(Request $request){
        $product_id = $request->post('id');
        $product_model = new Product();
        $del_result = $product_model->del_product($product_id);
        $this->total_product -= 1;
        for($i=$product_id+1;$i<=$this->total_product;$i++){
            DB::table('product')->where('id',$i)->update('id',$i-1);
        }
        return $del_result;
    }
}

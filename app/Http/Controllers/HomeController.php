<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
use App\Models\Product;
use App\Models\Todo;
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
        // $image = $request->file->get();
        // echo $image;
        // return $request->description->get();
        //$image = $request->file('upload_file');
        $validator = Validator::make($request->all(),
        [
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);
        // $result = $request->validate([
        //     'file' => 'required|mimes:jpeg,png,jpg'
        // ]);
        if($validator->fails()){
            $messages = $validator->messages();
            return $messages;
        }
        $media = new Media;
        //user directory
        $imagePath = $request->file('image');
        $description = $request->media_description;
        $image_name = $imagePath->getClientOriginalName();
        $image_extension = '.'.$imagePath->extension();
        $result = $media->upload_media($description,$image_extension);
        $upload_image_name = $result['id'].$image_extension;
        // $result = $request->file('image')->storeAs('image/media',$image_name);
        $request->image->move(public_path('image/media'),$upload_image_name);
        if($result['result']==true){
            if(Storage::disk('assets')->exists($upload_image_name))
                return true;
            else
                return false;
        }
        else{
            return false;
        }     
    }
    public function main(Request $request){
        $id = $request->get('id');
        if($id==1)
            return "Dashboard";
        elseif($id==2)
            return "User Profile";
        elseif($id==3){
            $todo = new Todo();
            $category = $todo->read_category();
            $todo_list = $todo->read_todo();
            return view('dashboard.todo',compact('category','todo_list'));
        }
           
        elseif($id==4){
            $media = new Media();
            $library = $media->get_media();
            return view('dashboard.media',compact('library'));
        }
        elseif($id==5)
            return view('dashboard.blog');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    use HasFactory;
    public function read_category(){
        $category = DB::table('categories')->get();
        return $category;
    }

    public function read_todo(){
        $todo = DB::table('todo_list')->get();
        return $todo;
    }

    public function delete_todo($id){
        $result = DB::table('todo_list')->where('id',$id)->delete();
        if($result)
            return true;
        else
            return false;
    }

    public function complete_todo($id,$date){
        $result = DB::table('todo_list')->where('id',$id)->update(['status'=>'completed','completed_on'=>$date]);
        if($result)
            return true;
        else
            return false;
    }

    public function add_category($name,$description,$icon){
        $result = DB::table('categories')->insert(['name'=>$name,'description'=>$description,'icon'=>$icon]);
        if($result)
            return true;
        else
            return false;
    }

    public function add_todo($name,$description,$category,$deadline){
        $result = DB::table('todo_list')->insert(['title'=>$name,'description'=>$description,'category'=>$category,'deadline'=>$deadline]);
        if($result)
            return true;
        else
            return false;
    }

    public function edit_todo($id,$name,$description,$category,$deadline){
        $result = DB::table('todo_list')->where('id',$id)->update(['title'=>$name,'description'=>$description,'category'=>$category,'deadline'=>$deadline]);
        if($result)
            return true;
        else
            return false;
    }
}

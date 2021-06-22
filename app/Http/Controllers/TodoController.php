<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;
class TodoController extends Controller
{
    //
    public function todo_delete($id){
       $todo = new Todo();
       return $todo->delete_todo($id);
    }

    public function todo_complete($id,$date){
        $todo = new Todo();
        return $todo->complete_todo($id,$date);
    }

    public function add_category($name,$desc,$icon){
        $todo = new Todo();
        return $todo->add_category($name,$desc,$icon); 
    }

    public function add_todo($name,$desc,$category,$deadline){
        $todo = new Todo();
        return $todo->add_todo($name,$desc,$category,$deadline);
    }

    public function edit_todo($id,$name,$desc,$category,$deadline){
        $todo = new Todo();
        return $todo->edit_todo($id,$name,$desc,$category,$deadline);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index(){
        return view('categories.index');
    }
    public function add(){
        return view('categories.add');
    }
    public function save(Request $a){
          $file=$a->file('image');
          $filename= 'image'.time().'.'.$a->image->extension();
          $file->move("upload/",$filename);

          $data = new Categories;
          $data->categories_name=$a->name;
          $data->image=$filename;
          $data->status=1;
          $data->save();
        //   dd($data);
          if($data){
              return redirect('categories/add')->with('message','Data Successfully Inserted!.');
            }
        }
    public function display(){
        $data=categories::orderBy('id','desc')->get();
        return view('categories.display',compact('data'));
    }
    public function view($id){
        $data=categories::find($id);
        return view('categories.view',compact('data'));
    }
    public function edit($id){
        $data=categories::find($id);
        return view('categories.edit',compact('data'));
    }
    public function update(Request $a){
        if($a->hasFile('image')){
            $file=$a->file('image');
            $filename= 'image'.time().'.'.$a->image->extension();
            $file->move("upload/",$filename);

            $data=categories::find($a->id);
            $data->categories_name=$a->name;
            $data->image=$filename;
            $data->status=1;
            $data->save();
            if($data){
                return redirect('categories/display')->with('message','Data successfully Updated!.');
            }
        }
        else{
            $data=categories::find($a->id);
            $data->categories_name=$a->name;
            $data->status=1;
            $data->save();
            if($data){
                return redirect('categories/display')->with('message','Data successfully Updated!.');
            }
        }
    }
    public function delete($id){
        $data=categories::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('categories/display')->with('message','Data Successfully Deleted!.');
            
        }
    }
}


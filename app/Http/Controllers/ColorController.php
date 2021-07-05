<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function add(){
        return view('color.addcolor');
    }
    public function save(Request $a){
        $data= new color;
        $data->color=$a->color;
        $data->status=1;
        $data->save();
        if($data){
            return redirect('color/addcolor')->with('message','Data Successfully Inserted!.');
        }
    }
    public function display(){
        $data=color::orderBy('id','desc')->get();
        return view('color.display',compact('data'));
    }
    public function view($id){
        $data=color::find($id);
        return view('color.view',compact('data'));
    }
    public function edit($id){
        $data=color::find($id);
        return view('color.edit',compact('data'));
    }
    public function update(Request $a){
        $data=color::find($a->id);
        $data->color=$a->color;
        $data->save();
        if($data){
            return redirect('color/display')->with('message','Data Successsfully Updated!.');
        }
    }
    public function delete($id){
        $data=color::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('color/display')->with('message','Data Successfully Deleted!.');
        }
    }
}
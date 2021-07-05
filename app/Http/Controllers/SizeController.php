<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function add(){
        return view('size.addsize');
    }
    public function save(Request $a){
        $data= new Size;
        $data->size=$a->size;
        $data->status=1;
        $data->save();
        if($data){
            return redirect('size/addsize')->with('message','Data Successfully INserted!.');
        }
    }
    public function display(){
        $data=size::orderBy('id','desc')->get();
        return view('size.display',compact('data'));
    }
    public function view($id){
        $data=size::find($id);
        return view('size.view',compact('data'));
    }
    public function edit($id){
        $data=size::find($id);
        return view('size.edit',compact('data'));
    }
    public function update(Request $a){
        $data=size::find($a->id);
        $data->size=$a->size;
        $data->save();
        if($data){
            return redirect('size/display')->with('message','Data Successfully Upadted!.');
        }
    }
    public function delete($id){
        $data=size::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('size/display')->with('message','Data Successfully Deleted!.');
        }
    }
}
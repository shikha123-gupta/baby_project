<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function add(){
        return view('brand.addbrand');
    }
    public function save(Request $a){
         $file=$a->file('image');
         $filename='image'.time().'.'.$a->image->extension();
         $file->move("upload/",$filename);

         $data=new brand;
         $data->name=$a->name;
         $data->image=$filename;
         $data->status=1;
         $data->save();
         if($data){
             return redirect('brand/addbrand')->with('message','Data Successfully Inserted!.');
         }
    }
    public function display(){
        $data=brand::orderBy('id','desc')->get();
        return view('brand.display',compact('data'));
    }
    public function view($id){
        $data=brand::find($id);
        return view('brand.view',compact('data'));
    }
    public function edit($id){
        $data=brand::find($id);
        return view('brand.edit',compact('data'));
    }
    public function update(Request $a){
        if($a->hasFile('image')){
            $file=$a->file('image');
            $filename='image'.time().'.'.$a->image->extension();
            $file->move("upload/",$filename);

            $data=brand::find($a->id);
            $data->name=$a->name;
            $data->image=$filename;
            $data->save();
            if($data){
                return redirect('brand/display')->with('message','Data Successfully UPdated!.');
            }
        }
        else{
            $data=brand::find($a->id);
            $data->name=$a->name;
            $data->save();
            if($data){
                return redirect('brand/display')->with('message','Data Successfully UPdated!.');
            }
        }
    }
    public function delete($id){
        $data=brand::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('brand/display')->with('message','Data Successfully Deleted!.');
        }
    }
}



                   

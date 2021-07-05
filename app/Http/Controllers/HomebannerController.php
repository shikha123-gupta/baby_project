<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homebanner;

class HomebannerController extends Controller
{
    public function add(){
        return view('homebanner.addbanner');
    }
    public function save(Request $a){
        $file=$a->file('image');
        $filename='image'.time().'.'.$a->image->extension();
        $file->move("upload/",$filename);

        $data=new homebanner;
        $data->image=$filename;
        $data->btn_text=$a->btn_text;
        $data->btn_link=$a->btn_link;
        $data->status=1;
        $data->save();
        if($data){
            return redirect('homebanner/addbanner')->with('message','Data Successfully Inserted!.');
        }
    }
    public function display(){
        $data=homebanner::orderBy('id','desc')->get();
        return view('homebanner.display',compact('data'));
    }
    public function view($id){
        $data=homebanner::find($id);
        return view('homebanner.view',compact('data'));
    }
    public function edit($id){
        $data=homebanner::find($id);
        return view('homebanner.edit',compact('data'));
    }
    public function update(Request $a){
        if($a->hasFile('image')){
            $file=$a->file('image');
            $filename='image'.time().'.'.$a->image->extension();
            $file->move("upload/",$filename);

            $data=homebanner::find($a->id);
            $data->image=$filename;
            $data->btn_text=$a->btn_text;
            $data->btn_link=$a->btn_link;
            $data->save();
            if($data){
                return redirect('homebanner/display')->with('message','Data Successfully Updated!.');
            }
        }
        else{
            $data=homebanner::find($a->id);
            $data->btn_text=$a->btn_text;
            $data->btn_link=$a->btn_link;
            $data->save();
            if($data){
                return redirect('homebanner/display')->with('message','Data Successfully Updated!.');
            }
        }
    }
    public function delete($id){
        $data=homebanner::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('homebanner/display')->with('message','Data Successfully Deleted!.');
        }
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productimage;
use App\Models\Product;

class ProductimageController extends Controller
{
    public function addimage($id){
        $data=productimage::find($id);
        $dataa=product::where(['id'=>$id])->get();
        $display=productimage::where(['product_id'=>$id])->get();
        return view('productimage.addimage',compact('data','dataa','display'));
    }
    public function save(Request $a){
        $file=$a->file('image');
       $filename= 'image'.time().'.'. $a->image->extension();
       $file->move("upload/",$filename);
        $data= new productimage;
        $data->product_id=$a->product_id;
        $data->image=$filename;
        $data->status=1;
        $data->save();
        if($data){
            return redirect('product/display')->with('message','Data Successfully Inserted!.');
        }
    }
    public function view($id){
        $data=productimage::find($id);
        return view('productimage.view',compact('data'));
    }
    public function edit($id){
        $data=productimage::find($id);
        $dataa=product::where(['id'=>$id])->get();
        return view('productimage.edit',compact('data','dataa'));
    }
    public function update(Request $b){
        if($b->hasFile('image')){
        $file=$b->file('image');
       $filename= 'image'.time().'.'. $b->image->extension();
       $file->move("upload/",$filename);
        $data= productimage::find($b->id);
        $data->image=$filename;
        $data->status=1;
        $data->save();
        if($data){
            return redirect('product/display')->with('message','Data Successfully Updated!.');
        }
        }
    }
    public function delete($id){
        $data=productimage::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('product/display')->with('message','Data Successfully Deleted!.');
        }
    }


}
 
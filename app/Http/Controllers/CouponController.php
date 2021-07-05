<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function add(){
        return view('coupon.addcoupon');
    }
    public function save(Request $a){
        $data= new coupon;
        $data->title=$a->title;
        $data->code=$a->code;
        $data->value=$a->value;
        $data->save();
        if($data){
            return redirect('coupon/addcoupon')->with('message','Data Successfully Inserted!.');
        }

    }
    public function display(){
        $data=coupon::orderBy('id','desc')->get();
        return view('coupon.display',compact('data'));
    }
    public function view($id){
        $data=coupon::find($id);
        return view('coupon.view',compact('data'));
    }
    public function edit($id){
        $data=coupon::find($id);
        return view('coupon.edit',compact('data'));
    }
    public function update(Request $a){
        $data=coupon::find($a->id);
        $data->title=$a->title;
        $data->code=$a->code;
        $data->value=$a->value;
        $data->save();
        if($data){
            return redirect('coupon/display')->with('message','Data Successfully Updated!.');
        }
    }
    public function delete($id){
        $data=coupon::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('coupon/display')->with('message','Data Successfully Deleted!.');
        }
    }
}


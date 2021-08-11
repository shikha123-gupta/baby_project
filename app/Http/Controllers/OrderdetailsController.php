<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderproduct;
use App\Models\Shipping;
use App\Models\Auth;

class OrderdetailsController extends Controller
{
    public function order(){
        $order=order::all();
        return view('order.orders',compact('order'));
    }
    public function paid_order($id){
        $order=order::find($id);
        $orderproduct=orderproduct::where('order_id',$id)->get();
        return view('order.paid_order',compact('order','orderproduct'));
    }
    public function invoice($id){
        $data=order::find($id);
        $orderproduct=orderproduct::where('order_id',$id)->get();
        $datass=Shipping::where('order_id',$id)->first();
        // dd($datass);
        // die;
        return view('order.invoice',compact('data','orderproduct','datass'));
    }
}

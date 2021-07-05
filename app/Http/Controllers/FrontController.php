<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homebanner;
use App\Models\Categories;
use App\Models\Productimage;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use Session;
class FrontController extends Controller
{
    public function add(){
        $banner=Homebanner::orderBY('id','desc')->get();
        $bann=Homebanner::all()->take(1);
        $cat=Categories::all()->take(2-6);
        $catss=Categories::all()->take(1);
        $product=Product::all();
        $popular=Product::where(['popular_product'=>'Yes'])->get();
        $featured=Product::where(['featured_product'=>'Yes'])->get();
        $latest=Product::where(['latest_product'=>'Yes'])->get();
        $brand=Brand::all();
        $pro=categories::all()->take(5);

        // $search=productimage::join('products','products.id','=','productimages.product_id')->where(['product_id'=>'id'])->get();
        // print_r($product);
        // die;
        return view('front.index',compact('banner','bann','cat','catss','product','pro','popular','featured','latest','brand',));
    }
    public function productdetails($id){
        $data=Product::find($id);
        $pro=productimage::where(['product_id'=>$id])->get();
        $popular=Product::where(['popular_product'=>'Yes'])->get();
        $banner=Homebanner::all()->take(1);
        return view('front.productdetails',compact('data','pro','popular','banner'));
    }
    public function addtocart(Request $cart){
        // print_r($cart->all());
        $session_id=Session::getId();
        // dd($session_id);
        $data= new cart;
        $data->product_id=$cart->product_id;
        $data->product_name=$cart->product_name;
        $data->price=$cart->price;
        $data->quantity=$cart->quantity;
        $data->image=$cart->image;
        $data->session_id=$session_id;
        $data->save();
        if($data){
            return redirect('/cart')->with('message','Data Successfully Inserted!.');
        }

    }
    public function cart(){
        $session_id=Session::getId();
        $cart=cart::where('session_id',$session_id)->get();
        // $cart=cart::orderBy('id','desc')->get();
        return view('front.cart',compact('cart'));
    }
    public function account(){
        return view('front.account');
    }



}

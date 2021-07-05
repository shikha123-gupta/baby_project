<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Categories;

class ProductController extends Controller
{
    public function add(){
        $categories=categories::all();
        $size=size::all();
        $color=color::all();
        return view('product.addproduct',compact('categories','size','color'));
    }
    public function save(Request $a){
          $file=$a->file('image');
          $filename= 'image'.time().'.'.$a->image->extension();
          $file->move("upload/",$filename);
          $data= new product;
          $data->cat_id=$a->cat_id;
          $data->product_name=$a->product_name;
          $data->product_code=$a->product_code;
          $data->image=$filename;
          $data->size=$a->size;
          $data->color=$a->color;
          $data->long_description=$a->long_description;
          $data->short_description=$a->short_description;
          $data->price=$a->price;
          $data->quantity=$a->quantity;
          $data->featured_product=$a->featured_product;
          $data->popular_product=$a->popular_product;
          $data->latest_product=$a->latest_product;
          $data->save();
          if($data){
              return redirect('product/addproduct')->with('message','Data Successfully Inserted!.');
          }
    }
    public function display(){
        $data=product::orderBy('id','desc')->get();
        return view('product.display',compact('data'));
    }
    public function view($id){
        $data=product::find($id);
        return view('product.view',compact('data'));
    }
    public function edit($id){
        $data=product::find($id);
        $productdetails=product::where(['id'=>$id])->first();
        $categories=categories::all();
        $size=size::all();
        $color=color::all();
        $categories_dropdown="<option selected disabled>Select</option>";

        foreach ($categories as $cat) {
            if($cat->id==$productdetails->cat_id){
                $selected="selected";
            }else{
                $selected="";
            }
            $categories_dropdown .= "<option value='".$cat->id."'".$selected.">".$cat->categories_name."</option>";
            

    
        }
        $size_dropdown="<option selected disabled>Select</option>";
        foreach ($size as $sizes) {
            if($sizes->size==$productdetails->size){
                $selected="selected";
            }else{
                $selected="";
            }
            $size_dropdown .= "<option value='".$sizes->size."'".$selected.">".$sizes->size."</option>";
            

    
        }
        $color_dropdown="<option selected disabled>Select</option>";
        foreach ($color as $colors) {
            if($colors->color==$productdetails->color){
                $selected="selected";
            }else{
                $selected="";
            }
            $color_dropdown .= "<option value='".$colors->color."'".$selected.">".$colors->color."</option>";
            

    
        }
        return view('product.edit',compact('data','categories_dropdown','size_dropdown','color_dropdown'));
    }
    public function update(Request $b){
        if($b->hasFile('image')){
            $file=$b->file('image');
            $filename= 'image'.time().'.'.$b->image->extension();
            $file->move("upload/",$filename); 
            $data=product::find($b->id);
            $data->cat_id=$b->cat_id;
            $data->product_name=$b->product_name;
            $data->product_code=$b->product_code;
            $data->image=$filename;
            $data->size=$b->size;
            $data->color=$b->color;
            $data->long_description=$b->long_description;
            $data->short_description=$b->short_description;
            $data->price=$b->price;
            $data->quantity=$b->quantity;
            $data->featured_product=$b->featured_product;
            $data->popular_product=$b->popular_product;
            $data->latest_product=$b->latest_product;
            $data->save();
            if($data){
               return redirect('product/display')->with('message','Data Successfully Updated!.');
            }
        }
        else{
        $data=product::find($b->id);
        $data->cat_id=$b->cat_id;
        $data->product_name=$b->product_name;
        $data->product_code=$b->product_code;
        $data->size=$b->size;
        $data->color=$b->color;
        $data->long_description=$b->long_description;
        $data->short_description=$b->short_description;
        $data->price=$b->price;
        $data->quantity=$b->quantity;
        $data->featured_product=$b->featured_product;
        $data->popular_product=$b->popular_product;
        $data->latest_product=$b->latest_product;
        $data->save();
        if($data){
            return redirect('product/display')->with('message','Data Successfully Updated!.');
        }
      }
    }
    public function delete($id){
        $data=product::find($id);
        $deleted=$data->delete();
        if($deleted){
            return redirect('product/display')->with('message','Data Successfully Deleted!.');
        }
    }

}


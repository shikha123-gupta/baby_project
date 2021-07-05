<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Auth;
class UserController extends Controller
{
    public function register(Request $a){
         $data=new user;
         $data->name=$a->name;
         $data->email=$a->email;
         $data->password=$a->password;
         $data->save();
         if($data){
             return redirect('front/account')->with('message','Data Successfully Inserted!.');
         }
    }
    public function login(Request $a){
        $data=$a->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('/addtocart');
        }
        else{
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Auth;
use Session;
use App\Models\Cart;
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
        $session=Session::getId();
        // dd($session);
        $data=$a->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            cart::where('session_id',$session)->update(['user_email'=>$data['email']]);
            return redirect('/cart');
        }
        else{
            return redirect()->back();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}

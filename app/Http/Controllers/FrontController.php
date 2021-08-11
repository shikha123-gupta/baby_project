<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homebanner;
use App\Models\Categories;
use App\Models\Productimage;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Orderproduct;
use App\Models\User;
use Session;
use DB;
use Auth;
use Mail;
use Illuminate\Support\Str;
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
        if(Auth::check()){
            $user_email=Auth::user()->email;
            $data->user_email=$user_email;
        }
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
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $cart = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }
        else{
            $session_id=Session::getId();
            $cart=cart::where('session_id',$session_id)->get();
        }
        
        // $cart=cart::orderBy('id','desc')->get();
        return view('front.cart',compact('cart'));
    }
    public function account(){
        return view('front.account');
    }
    public function checkout(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $cartss = DB::table('carts')->where(['user_email'=>$user_email])->get();
        }
        
        return view('front.checkout',compact('cartss'));
    }
    public function place_order(Request $a){
        //  print_r($a->all());
        //  die;
        $user_email=Auth::user()->email;
        $data=new order;
        $data->user_email=$user_email;
        $data->name=$a->name1;
        $data->phone=$a->phone1;
        $data->address=$a->address1;
        $data->country=$a->country1;
        $data->appartment=$a->appartment1;
        $data->city=$a->city1;
        $data->district=$a->district1;
        $data->postcode=$a->postcode1;
        $data->payment_method=$a->payment_method;
        $data->grand_total=$a->grand_total;
        $data->order_status='pending';
        $data->order_id=Str::random(10);
        $data->save();
        $order_id=DB::getPdo()->lastinsertID();
        // print_r($order_id);
        // die;
        // $user_email=Auth::user()->email;
        $data1=new shipping;
        $data1->order_id=$order_id;
        $data1->user_email=$user_email;
        $data1->name=$a->name;
        $data1->phone=$a->phone;
        $data1->address=$a->address;
        $data1->country=$a->country;
        $data1->appartment=$a->appartment;
        $data1->city=$a->city;
        $data1->district=$a->district;
        $data1->postcode=$a->postcode;
        $data1->special_notes=$a->special_notes;
        $data1->save();
        //order_product
        $cart_product=cart::where('user_email',$user_email)->get();
        // echo "<pre>";
        // print_r($cart_product);
        foreach($cart_product as $o){
            $data2=new orderproduct;
            $data2->order_id=$order_id;
            $data2->user_email=$user_email;
            $data2->product_name=$o->product_name;
            $data2->product_id=$o->product_id;
            $data2->price=$o->price;
            $data2->quantity=$o->quantity;
            $data2->image=$o->image;
            $data2->save();
        }
        if($a->payment_method=='cod'){
            $user = User::where('email',$data->user_email)->first(); 
                $to = $data->user_email;
                // print_r($to);
                // die;
                $corder =Order::all();
                $corderd = Orderproduct::all();
                $id = $data->id;
                
                
                $subject = 'User Order Successful';
                $message = "Your Order Is Successful In PnInfosys Course Program \n\n"; 
                Mail::send('front.order_email', ['msg' => $message,'corder' => $corder,'corderd' => $corderd,'id' => $id, 'user' => $user] , function($message) use ($to){ 
                    $message->to($to, 'User')->subject('User Order');
                });
                return redirect('thanks');
            }
            if($a->payment_method=='paytm'){
                $amount=$a->grand_total;
                $order_id=$data->order_id;
                $data_for_request = $this->handlePaytmRequest( $order_id, $amount );
                // print_r($data_for_request);
                // die;
                $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
                $paramList = $data_for_request['paramList'];
                $checkSum = $data_for_request['checkSum'];
                return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
            }

        
    }
    ///Paytm code ////////////////////////////////////////////////
    public function handlePaytmRequest( $order_id, $amount ) {
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();

        $checkSum = "";
        $paramList = array();

        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = 'BGvzRN60366313550145';
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = 'WEBSTAGING';
        $paramList["CALLBACK_URL"] = url( '/paytm-callback' );
        $paytm_merchant_key = 'h71rJb%yJqO3z3Iv';

    //Here checksum string will return by getChecksumFromArray() function.
    $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );

    return array(
        'checkSum' => $checkSum,
        'paramList' => $paramList
    );
}
public function paytmCallback( Request $request ) {
        // return $request;
        $order_id = $request['ORDERID'];

    if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
        $transaction_id = $request['TXNID'];
        $order = Order::where( 'order_id', $order_id )->first();
        $order->payment_status = 'complete';
        $order->transaction_id = $transaction_id;
        $order->save();
       
       $user_email = Auth::user()->email;
       DB::table('carts')->where('user_email',$user_email)->delete();
        return view( 'order-complete', compact( 'order') );
       

    } else if( 'TXN_FAILURE' === $request['STATUS'] ){
        return view( 'payment-failed' );
    }
}
public function getAllEncdecFunc(){


    function encrypt_e($input, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
    function decrypt_e($crypt, $ky) {
        $key   = html_entity_decode($ky);
        $iv = "@@@@&&&&####$$$$";
        $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
        return $data;
    }
    function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);
        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";
        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }
        return $random;
    }
    function checkString_e($value) {
        if ($value == 'null')
            $value = '';
        return $value;
    }
    function getChecksumFromArray($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = getArray2Str($arrayList);
        $salt = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = encrypt_e($hashString, $key);
        return $checksum;
    }
    function getChecksumFromString($str, $key) {
       
        $salt = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = encrypt_e($hashString, $key);
        return $checksum;
    }
    function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str = getArray2StrForVerify($arrayList);
        $paytm_hash = decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);
        $finalString = $str . "|" . $salt;
        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;
        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }
    function verifychecksum_eFromStr($str, $key, $checksumvalue) {
        $paytm_hash = decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);
        $finalString = $str . "|" . $salt;
        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;
        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }
    function getArray2Str($arrayList) {
        $findme   = 'REFUND';
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;  
        foreach ($arrayList as $key => $value) {
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if ($pos !== false || $pospipe !== false)
            {
                continue;
            }
           
            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
    function getArray2StrForVerify($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
    function redirect2PG($paramList, $key) {
        $hashString = getchecksumFromArray($paramList);
        $checksum = encrypt_e($hashString, $key);
    }
    function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }
    function getTxnStatus($requestParamList) {
        return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }
    function getTxnStatusNew($requestParamList) {
        return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
    }
    function initiateTxnRefund($requestParamList) {
        $CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return callAPI(PAYTM_REFUND_URL, $requestParamList);
    }
    function callAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                        
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData))                                                                      
        );  
        $jsonResponse = curl_exec($ch);  
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
    function callNewAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                        
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData))                                                                      
        );  
        $jsonResponse = curl_exec($ch);  
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
    function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = getRefundArray2Str($arrayList);
        $salt = generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = encrypt_e($hashString, $key);
        return $checksum;
    }
    function getRefundArray2Str($arrayList) {  
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;  
        foreach ($arrayList as $key => $value) {        
            $pospipe = strpos($value, $findmepipe);
            if ($pospipe !== false)
            {
                continue;
            }
           
            if ($flag) {
                $paramStr .= checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . checkString_e($value);
            }
        }
        return $paramStr;
    }
    function callRefundAPI($refundApiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData =json_encode($requestParamList);
        $postData = 'JsonData='.urlencode($JsonData);
        $ch = curl_init($apiURL);  
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $refundApiURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
        $jsonResponse = curl_exec($ch);  
        $responseParamList = json_decode($jsonResponse,true);
        return $responseParamList;
    }
    
        }
    
        function getConfigPaytmSettings(){
    
            define('PAYTM_ENVIRONMENT', 'PROD'); // PROD
            define('PAYTM_MERCHANT_KEY', 'EBPwh5dj_XmW1L7%'); //Change this constant's value with Merchant key received from Paytm.
            define('PAYTM_MERCHANT_MID', 'EbtGYn83534967686723'); //Change this constant's value with MID (Merchant ID) received from Paytm.
            define('PAYTM_MERCHANT_WEBSITE', 'DEFAULT'); //Change this constant's value with Website name received from Paytm.
            $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/order/status';
            $PAYTM_TXN_URL='https://securegw-stage.paytm.in/order/process';
            if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
        }
            define('PAYTM_REFUND_URL', '');
            define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
            define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
        }
       



    public function thanks(){
        $user_email=Auth::user()->email;
        cart::where('user_email',$user_email)->delete();
        return view('front/thanks');
    }
 


}

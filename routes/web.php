<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomebannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductimageController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    echo "shikha";
    // return view('welcome');
});

//admincontroller
Route::get('admin/index',[AdminController::class,'index']);

//categoriescontroller
Route::get('categories/index',[CategoriesController::class,'index']);
Route::get('categories/add',[CategoriesController::class,'add']);
Route::post('categories/save',[CategoriesController::class,'save']);
Route::get('categories/display',[CategoriesController::class,'display']);
Route::get('categories/view/{id}',[CategoriesController::class,'view']);
Route::get('categories/edit/{id}',[CategoriesController::class,'edit']);
Route::post('categories/update',[CategoriesController::class,'update']);
Route::get('categories/delete/{id}',[CategoriesController::class,'delete']);

//couponcontroller
Route::get('coupon/addcoupon',[CouponController::class,'add']);
Route::post('coupon/save',[CouponController::class,'save']);
Route::get('coupon/display',[CouponController::class,'display']);
Route::get('coupon/view/{id}',[CouponController::class,'view']);
Route::get('coupon/edit/{id}',[CouponController::class,'edit']);
Route::post('coupon/update',[CouponController::class,'update']);
Route::get('coupon/delete/{id}',[CouponController::class,'delete']);

//sizecontroller
Route::get('size/addsize',[SizeController::class,'add']);
Route::post('size/save',[SizeController::class,'save']);
Route::get('size/display',[SizeController::class,'display']);
Route::get('size/view/{id}',[SizeController::class,'view']);
Route::get('size/edit/{id}',[SizeController::class,'edit']);
Route::post('size/update',[SizeController::class,'update']);
Route::get('size/delete/{id}',[SizeController::class,'delete']);

//colorcontoller
Route::get('color/addcolor',[ColorController::class,'add']);
Route::post('color/save',[ColorController::class,'save']);
Route::get('color/display',[ColorController::class,'display']);
Route::get('color/view/{id}',[ColorController::class,'view']);
Route::get('color/edit/{id}',[ColorController::class,'edit']);
Route::post('color/update',[ColorController::class,'update']);
Route::get('color/delete/{id}',[ColorController::class,'delete']);


//homebanner controller
Route::get('homebanner/addbanner',[HomebannerController::class,'add']);
Route::post('homebanner/save',[HomebannerController::class,'save']);
Route::get('homebanner/display',[HomebannerController::class,'display']);
Route::get('homebanner/view/{id}',[HomebannerController::class,'view']);
Route::get('homebanner/edit/{id}',[HomebannerController::class,'edit']);
Route::post('homebanner/update',[HomebannerController::class,'update']);
Route::get('homebanner/delete/{id}',[HomebannerController::class,'delete']);

//brandcontroller
Route::get('brand/addbrand',[BrandController::class,'add']);
Route::post('brand/save',[BrandController::class,'save']);
Route::get('brand/display',[BrandController::class,'display']);
Route::get('brand/view/{id}',[BrandController::class,'view']);
Route::get('brand/edit/{id}',[BrandController::class,'edit']);
Route::post('brand/update',[BrandController::class,'update']);
Route::get('brand/delete/{id}',[BrandController::class,'delete']);

//productcontroller
Route::get('product/addproduct',[ProductController::class,'add']);
Route::post('product/save',[ProductController::class,'save']);
Route::get('product/display',[ProductController::class,'display']);
Route::get('product/view/{id}',[ProductController::class,'view']);
Route::get('product/edit/{id}',[ProductController::class,'edit']);
Route::post('product/update',[ProductController::class,'update']);
Route::get('product/delete/{id}',[ProductController::class,'delete']);

//productimagecontroller
Route::get('productimage/addimage/{id}',[ProductimageController::class,'addimage']);
Route::post('productimage/save',[ProductimageController::class,'save']);
Route::get('productimage/view/{id}',[ProductimageController::class,'view']);
Route::get('productimage/edit/{id}',[ProductimageController::class,'edit']);
Route::post('productimage/update',[ProductimageController::class,'update']);
Route::get('productimage/delete/{id}',[ProductimageController::class,'delete']);

//frontcontroller
Route::get('/',[FrontController::class,'add']);
Route::get('front/productdetails/{id}',[FrontController::class,'productdetails']);
Route::get('/cart',[FrontController::class,'cart']);
Route::post('/addtocart',[FrontController::class,'addtocart']);


//usercontroller
Route::get('front/account',[FrontController::class,'account']);
Route::post('user/register',[UserController::class,'register']);
Route::post('user/login',[UserController::class,'login']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fontend\fontendController;
use App\Http\Controllers\fontend\authController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\ProductController;



//Pontend Route

Route::get('/',[fontendController::class,'index']);
Route::get('/login',[fontendController::class,'login'])->name('fontend.login');
Route::get('/register',[authController::class,'register'])->name('fontend.register');
Route::get('/shop',[fontendController::class,'shop']);
Route::get('/ditails',[fontendController::class,'ditails']);


//Auth Route
Route::post('/post-register',[authController::class,'post_register'])->name('post_rgister');
Route::post('/post-login',[authController::class,'post_login'])->name('post_login');

Route::get('/admin',[AdminController::class,'index'])->name('admin');
Route::post('/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){

    //Category Route
    Route::get('admin/deshboard',[AdminController::class,'deshboard'])->name('admin.deshboard');
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('admin/manage_catagory',[CategoryController::class,'manage_category'])->name('admin.manage_category');
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('admin/category/edit/{id}',[CategoryController::class,'manage_category'])->name('admin.category.edit');
    Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('admin.category.manage_category_process');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status'])->name('admin.category.status');

    //coupon Route
    Route::get('admin/coupon',[CouponController::class,'index'])->name('admin.coupon');
    Route::get('admin/manage_coupon',[CouponController::class,'manage_coupon'])->name('admin.manage_coupon');
    Route::get('admin/coupon/edit/{id}',[CouponController::class,'manage_coupon'])->name('admin.coupon.edit');
    Route::post('admin/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('admin.coupon.manage_coupon_process');
    Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete'])->name('admin.coupon.delete');
    Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status'])->name('admin.coupon.status');


    //color Route
    Route::get('admin/color',[ColorController::class,'index'])->name('admin.color');
    Route::get('admin/color',[ColorController::class,'index'])->name('admin_color');
    Route::get('admin/manage_color',[ColorController::class,'manage_color'])->name('admin.manage_color');
    Route::get('admin/color/edit/{id}',[ColorController::class,'manage_color'])->name('admin.color.edit');
    Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('admin.color.manage_color_process');
    Route::get('admin/color/delete/{id}',[ColorController::class,'delete'])->name('admin.color.delete');
    Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status'])->name('admin.color.status');

    //products Route
    Route::get('admin/product',[ProductController::class,'index'])->name('admin.product');
    Route::get('admin/manage_product',[ProductController::class,'manage_product'])->name('admin.manage_product');
    Route::get('admin/product/edit/{id}',[ProductController::class,'manage_product'])->name('admin.product.edit');
    Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('admin.product.manage_product_process');
    Route::get('admin/product/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status'])->name('admin.product.status');
    Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'attr_delete'])->name('admin.product.attr_delete');
    Route::get('admin/product/product_image_delete/{paid}/{pid}',[ProductController::class,'image_delete'])->name('admin.product.image_delete');
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/',[HomeController::class, 'index']);
    Route::get('redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
    Route::get('all_products',[HomeController::class,'all_products']);


    /////////////////////////////////  AdminContoller  ////////////////////////////////////////////////

    // Catagory
    route::get('/view_catagory',[AdminController::class,'view_catagory']);
    Route::post('/add_category',[AdminController::class,'add_catagory'])->name('add_catagory');
    Route::get('/delete_catagory/{id}',[AdminController::class,'delete_catagory']);

    // Product
    route::get('/view_product',[AdminController::class,'view_product']);
    route::post('/add_product',[AdminController::class,'add_product']);
    route::get('/show_product',[AdminController::class,'show_product']);
    Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
    Route::get('/update_product/{id}',[AdminController::class,'update_product']);
    Route::post('/edit_product/{id}',[AdminController::class,'edit_product']);

    // Order
    Route::get('/order',[AdminController::class,'order']);
    Route::get('/delivered/{id}',[AdminController::class,'delivered']);
    Route::get('/download_pdf/{id}',[AdminController::class,'download_pdf']);

// Search
Route::get('/search',[AdminController::class,'searchData']);


/////////////////////////////////  HomeContoller  ////////////////////////////////////////////////


// Product
Route::get('product_details/{id}',[HomeController::class,'product_details']);

// Cart
Route::post('add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('show_cart',[HomeController::class,'show_cart']);
Route::get('/delete_cart/{id}',[HomeController::class,'delete_cart']);

// Payments
Route::get('/cash_on_delivery',[HomeController::class,'cash_on_delivery']);
Route::get('/stripe/{sum}',[HomeController::class,'stripe']);
Route::post('/stripe_post/{sum}',[HomeController::class,'stripe_post']);

// Search
Route::get('/search_product',[HomeController::class,'search']);

// Order
Route::get('/show_order',[HomeController::class,'show_order']);
Route::get('/order_cancel/{id}',[HomeController::class,'order_cancel']);
Route::get('/search_order',[HomeController::class,'search_order']);

// Comments
Route::post('/add_comment',[HomeController::class,'add_comment']);
Route::post('update_comment', [HomeController::class, 'update_comment']);
Route::get('delete_comment/{id}', [HomeController::class, 'delete_comment']);

// Replies
Route::post('/add_reply',[HomeController::class,'add_reply']);
Route::post('update_reply', [HomeController::class, 'update_reply']);
Route::get('delete_reply/{id}', [HomeController::class, 'delete_reply']);

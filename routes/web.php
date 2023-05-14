<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {   
   # return view('contact');
   return view('welcome');
});
Route::get('/admin', function () {    
    return view('admin');
});
Route::get('/welcome', function () {
    #return view('contact');
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/send', [App\Http\Controllers\ContactController::class, 'sendEmail'])->name('admin');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
Route::get('/admin', [App\Http\Controllers\DashboardController::class, 'index']);} 
);

Route::resource('/products', ProductController::class);


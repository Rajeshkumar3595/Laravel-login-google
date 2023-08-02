<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function(){
    return view('form');
} );

Route::get('/home', function(){
    return view('home');
} );


Route::get('/login/google', [App\Http\Controllers\HomeController::class, 'logingoogle'])->name('google_login');

Route::any('/google/cal lback', [App\Http\Controllers\HomeController::class, 'login_with_google']);

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);
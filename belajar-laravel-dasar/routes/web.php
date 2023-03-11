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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/daud', function (){
    return "Hello Daud Hidayat Ramadhan";
});

Route::redirect('/youtube', '/daud');


Route::fallback(function (){
    return "404 By Daud Hidayat Ramadhan";
});
Route::view("/hello", "hello", ['name'=> 'daud'] );

Route::get('/hello-again', function (){
   return view("hello", ['name' => 'daud']);
});

Route::get('/hello-world', function (){
    return view("hello.world", ['name' => 'daud']);
});

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
Route::get('/products/{id}', function ($productId){
    return "Product $productId";
})->name('product.detail');
Route::get('/products/{product}/items/{item}', function ($productId, $itemId){
    return "Product $productId, item $itemId";
})->name('product.items.detail');

Route::get('/categories/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404'){
    return "User $userId";
});
Route::get('/conflict/daud', function (){
    return "conflict daud";
});
Route::get('/conflict/{name}', function ($name){
   return "name $name";
});
Route::get('/product/{id}', function ($id){
    $link = \route('product.detail', ['id'=> $id]);
    return "Link $link";
});
Route::get('/product-redirect/{id}', function ($id){
    return redirect()->route('product.detail', ['id'=>$id]);
});
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownloadFile']);

Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::get('redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectForm']);
Route::get('redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get('redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])->name('redirect-hello');
Route::get('redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);
Route::get('redirect/away', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::get('middleware/api', function (){
    return "ok";
})->middleware(['contoh:DHR,401']);

Route::get('middleware/group', function (){
    return "group";
})->middleware(['DHR']);

Route::get('/form',[\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form/',[\App\Http\Controllers\FormController::class, 'submitForm']);


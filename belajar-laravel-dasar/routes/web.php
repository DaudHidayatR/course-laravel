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

Route::prefix("response/type")->group(function (){
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownloadFile']);
});
Route::controller(\App\Http\Controllers\CookieController::class)->group(function (){
    Route::get('cookie/set', 'createCookie');
    Route::get('cookie/get', 'getCookie');
    Route::get('cookie/clear', 'clearCookie');
});

Route::controller(\App\Http\Controllers\RedirectController::class)->prefix('redirect')->group(function (){
    Route::get('/from','redirectForm');
    Route::get('/to', 'redirectTo');
    Route::get('/name', 'redirectName');
    Route::get('/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
    Route::get('/named', function (){
//        return route('redirect-hello', ['name' => 'Daud']);
//        return url()->route('redirect-hello', ['name' => 'Daud']);
        return \Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'Daud']);
    });
});


Route::middleware(['contoh:DHR,401'])->prefix('/middleware')->controller(\App\Http\Middleware\contohMiddleware::class)->group(function (){
    Route::get('/api', function () {
        return "ok";
    });
    Route::get('/group', function (){
        return "group";
    });
});


Route::get('url/action', function (){
//    return action([\App\Http\Controllers\FormController::class, 'form']);
//    return url()->action([\App\Http\Controllers\FormController::class, 'form']);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'form']);
});

Route::controller(\App\Http\Controllers\FormController::class)->group(function (){
    Route::get('/form', 'form');
    Route::post('/form','submitForm');
});

Route::get('/url/current', function (){
    return \Illuminate\Support\Facades\URL::full();
});

Route::get('session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);
Route::get('errors/sample', function (){
    throw new Exception('Sample Error');
});
Route::get('errors/manual', function (){
    report(new Exception('sample errors'));
    return 'ok';
});
Route::get('errors/validation', function (){
    throw new \App\Exceptions\ValidationException('Validation Error');
});
Route::get('abort/400', function (){
    abort(400, "Ups Validation Error");
});
Route::get('abort/401', function (){
    abort(401,);
});
Route::get('abort/500', function (){
    abort(500);
});

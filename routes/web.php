<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserFavoriteController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/favorites', function () {
//     return view('favorites');
// });

Route::get('/', function () {
    if(Auth::user()!=''){
        return view('home');
    }else{
        return view('template');
    }
});

Route::get('/favorites', function () {
    if(Auth::user()!=''){
        return view('favorites');
    }else{
        return redirect('/');
    }
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResource('/contacts', ContactController::class);
Route::apiResource('/user_favorites', UserFavoriteController::class);
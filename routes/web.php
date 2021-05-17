<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserProfileController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('user/profile',[UserProfileController::class,'index'])->name('profile');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_create',[UserProfileController::class,'create'])->name('profile_create');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_edit',[UserProfileController::class,'edit'])->name('profile_edit');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile',[UserProfileController::class,'store'])->name('profile');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile_update/{id}',[UserProfileController::class,'update'])->name('profile_update');  //->middleware(['password.confirm'])->name('profile');

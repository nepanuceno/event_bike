<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\Acl\RoleUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Acl\PermissionController;
use App\Http\Controllers\Event\CategoryController;
use App\Http\Controllers\Event\ModalityController;
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

// Route::get('/', function () {
//     return view('clients.welcome');
// });

Route::get('/',[ClientController::class, 'index'])->name('welcome');
Route::post('/',[ClientController::class, 'filter_events'])->name('#events');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('register_manager', [UserController::class, 'register_manager'])->name('manager.create');
Route::post('register_manager', [RegisterController::class, 'register'])->name('manager.register');

Route::get('user/profile',[UserProfileController::class,'index'])->name('profile');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_create',[UserProfileController::class,'create'])->name('profile_create');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_edit',[UserProfileController::class,'edit'])->name('profile_edit');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile',[UserProfileController::class,'store'])->name('profile_store');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile_update/{id}',[UserProfileController::class,'update'])->name('profile_update');  //->middleware(['password.confirm'])->name('profile');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('role_user', RoleUserController::class);
    Route::resource('user', UserController::class);

    Route::get('roles_user/{id}', [RoleUserController::class, 'roles_user']);
    Route::get('delete_roles_user/{user}/{role}', [RoleUserController::class, 'delete_roles_user']);
    Route::get('search_user', [UserController::class, 'search']);

    Route::resource('user_address', UserAddressController::class);


    Route::group(['middkeware'=>['permission']], function(){
        Route::resource('event', EventController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('modality', ModalityController::class);
        Route::post('event/add_costs', [EventController::class, 'add_costs']);
        Route::post('event/add_video', [EventController::class, 'create_video'])->name('event.create.video');
        Route::get('event/remove_video/{id}', [EventController::class, 'remove_video'])->name('event.remove.video');

        Route::post('event/upload/{id}',[EventController::class, 'upload'])->name('event.upload');
        Route::get('event/filter/{id}',[EventController::class, 'event_filter'])->name('event.filter');
        Route::get('events/csv_head_file', [EventController::class, 'csv_head_file'])->name('csv_head_file');
    });
});



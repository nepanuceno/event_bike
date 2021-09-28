<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\Acl\RoleUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Acl\PermissionController;
use App\Http\Controllers\Event\CategoryController;
use App\Http\Controllers\Event\ModalityController;
use App\Http\Controllers\EventSubscribeController;
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

Route::resource('subscribe', EventSubscribeController::class);

Route::get('register_manager', [UserController::class, 'register_manager'])->name('manager.create');
Route::post('register_manager', [RegisterController::class, 'register'])->name('manager.register');

Auth::routes();

Route::get('choices',[TenantController::class, 'choices'])
    ->name('tenants.choices')
    ->middleware('auth');

Route::get('notifications/get', [NotificationsController::class, 'getNotificationsData'])->name('notifications.get');
Route::get('notifications/tenatjoin', [NotificationsController::class, 'getNotificationsTenantJoin'])->name('notificationstenantjoin.get');

Route::get('setTenantId/{id}', [TenantController::class, 'setTenantId'])->name('setTenantId');

Route::get('user/profile',[UserProfileController::class,'index'])->name('profile');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_create',[UserProfileController::class,'create'])->name('profile_create');  //->middleware(['password.confirm'])->name('profile');
Route::get('user/profile_edit',[UserProfileController::class,'edit'])->name('profile_edit');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile',[UserProfileController::class,'store'])->name('profile_store');  //->middleware(['password.confirm'])->name('profile');
Route::post('user/profile_update/{id}',[UserProfileController::class,'update'])->name('profile_update');  //->middleware(['password.confirm'])->name('profile');

Route::resource('tenant', TenantController::class);
Route::post('tenant/create_notify_joingroup', [TenantController::class, 'create_notify_joingroup'])->name('create.notify.joingroup');
Route::get('tenant/joinGroup/{tenant_id}/{user_id}/{notify_id}', [TenantController::class, 'joinGroup'])->name('joinGroup');

Route::resource('user', UserController::class);
Route::resource('user_address', UserAddressController::class);
Route::get('search_user', [UserController::class, 'search']);

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('role_user', RoleUserController::class);
    Route::get('roles_user/{id}', [RoleUserController::class, 'roles_user']);
    Route::get('delete_roles_user/{user}/{role}', [RoleUserController::class, 'delete_roles_user']);

    Route::group(['middleware'=>['permission:manager', 'tenants']], function(){
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



<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * @return string
     */
    public function redirectTo() : string
    {
        $auth = Auth::check();

        $user = User::find(Auth::id());

        if(!$user->hasRole('Manager') && !$user->hasRole('Administrator')) { //not modifier Roles / não modifique
            //Se nao houver perfil do usuario, redireciona o usuário para o formulário de preenchimento
            if($auth) {
                if(!$user->profile || !$user->tenants || !$user->adresses) {
                    return '/user/profile';
                } else {
                    return '/';
                }
            }
        }

        return $this->redirectTo;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

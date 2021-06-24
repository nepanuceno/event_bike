<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(Auth::id());

        if(session()->has('tenant_id') && !is_null(session()->get('tenant_id'))) {
            return $next($request);
            // if($user->can('manager') || $user->can('administrator')  ) {
            // } else {
            //     return redirect('/');
            // }
        }
        if($user->can('manager')) {
            return redirect('user/profile');
        }

        return redirect('choices');
    }
}

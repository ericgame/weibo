<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //方法1
        /*
        if (Auth::guard($guard)->check()) {
            session()->flash('info', '您已經登入成功，不需要再次登入或註冊！');
            return redirect('/');
            // return redirect(RouteServiceProvider::HOME);
        }
        */

        //方法2
        if (Auth::guard($guard)->check()) {
            $message = $request->is('signup') ? '您已經註冊成功，不需要再次註冊！' : '您已經登入成功，不需要再次登入！';
            session()->flash('info', $message);
            return redirect('/');
        }

        return $next($request);
    }
}

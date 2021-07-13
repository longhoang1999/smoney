<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check())
            return $next($request);
        else
            return redirect()->route('homepage.login')->with("error","Bạn phải đăng nhập trước");
    }
}

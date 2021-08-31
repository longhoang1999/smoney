<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class BankMiddleware
{

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->tks_loaitk == "3"){
            return $next($request);
        }else{
            return redirect()->route("notFound");
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyCookieLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //  auto login
        if(!Auth::check())
        {
            $cookiePhone = $request->cookie('phone');
            $cookiePassword = $request->cookie('password');
            if(isset($cookiePhone) && isset($cookiePassword))
            {
                $findUser = TaiKhoanSmoney::where("tks_sdt",$cookiePhone)->first();
                if(!empty($findUser) && $findUser->tks_loaitk=="1")
                {
                    Auth::attempt(['tks_sdt'=>$cookiePhone,'password'=>$cookiePassword]);
                }
                else
                {
                    \Cookie::queue(\Cookie::forget('phone'));
                    \Cookie::queue(\Cookie::forget('password'));
                }
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;

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
                $findStudent = Student::where("sdt",$cookiePhone)->first();
                $passwordDecrypt = $this->encrypt_decrypt($cookiePassword, 'decrypt', $findStudent->code);

                $findUser = TaiKhoanSmoney::where("tks_sdt",$cookiePhone)->first();
                if(!empty($findUser) && $findUser->tks_loaitk=="1")
                {
                    Auth::attempt(['tks_sdt'=>$cookiePhone,'password'=>$passwordDecrypt]);
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
    function encrypt_decrypt($string, $action = 'encrypt',$secret_key_Auth)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = $secret_key_Auth;
        $secret_iv = 'SMONEY';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

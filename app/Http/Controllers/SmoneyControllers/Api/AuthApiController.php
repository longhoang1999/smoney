<?php

namespace App\Http\Controllers\SmoneyControllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\Student;

class AuthApiController extends Controller
{
    public function login(Request $req)
    {
        $fields = $req->validate([
            'APIKEY' => 'required',
            'phone'=>'required',
            'password'=>'required|min:0|max:32',
        ]);
        if($fields['APIKEY'] == "SMONEYSECRETKEY"){
            if(Auth::attempt(['tks_sdt'=>$fields['phone'],'password'=>$fields['password']]))
            {
                Auth()->user()->tokens()->delete();
                // create new session
                $userLogin = Auth::user();
                $token = $userLogin->createToken('smoneytokensecret')->plainTextToken;
                $infoUser = (object) array('id_user' => $userLogin->tks_id, 'sdt_user' => $userLogin->tks_sdt);

                $response = [
                    'result' => 'success',
                    'userLogin' => $infoUser,
                    'token' => $token
                ];
                return response($response,200);
            }
            else{
                $toEncode["result"] = "fail";
                $toEncode["Error"] = "Username or password is incorrected!";            
                return response($toEncode,401);
            }
        }else{
            $toEncode["result"] = "fail";
            $toEncode["Error"] = "Connection errors";      
            return response($toEncode,400);
        }       
    }
    public function logout(Request $req){
        $fields = $req->validate([
            'APIKEY' => 'required',
        ]);
        if($fields['APIKEY'] == "SMONEYSECRETKEY"){
            Auth()->user()->tokens()->delete();
            $response = [
                'result' => 'success',
                'message' => 'Logged out',
            ];
            return response($response,200);
        }else{
            $toEncode["result"] = "fail";
            $toEncode["Error"] = "Connection errors";      
            return response($toEncode,400);
        }
    }
}

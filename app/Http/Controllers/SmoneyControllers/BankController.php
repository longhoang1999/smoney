<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SmoneyModels\Student;

class BankController extends Controller
{
    public function bankDashboard (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/bank/bankdashboard')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function schoolinfo (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/bank/schoolinfo')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function loaninfo (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/bank/loaninfo')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    
}

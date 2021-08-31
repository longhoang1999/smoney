<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\NganHang;
use App\Models\SmoneyModels\Student;

class BankController extends Controller
{
    public function bankDashboard (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/bankdashboard')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function schoolinfo (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/schoolinfo')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function loaninfo (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/loaninfo')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    
}

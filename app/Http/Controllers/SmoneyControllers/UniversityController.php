<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\NhaTruong;

class UniversityController extends Controller
{
    public function schoolDashboard (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/schooldashboard')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
            

    }
    public function workinfor (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/workinfor')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

    public function overdue (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/overdue')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function paid (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/paid')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function unpaid (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/unpaid')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function pending (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/pending')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }
}

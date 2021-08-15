<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SmoneyModels\Student;

class UniversityController extends Controller
{
    public function schoolDashboard (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/schooldashboard')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function workinfor (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/workinfor')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function overdue (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/overdue')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function paid (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/paid')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function unpaid (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/unpaid')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }

    public function pending (){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return View('smoney/university/pending')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");

    }
}

<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Cookie;

// model
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;

class HomeController extends Controller
{
    public function test2(Request $req){
        $cookieOldLog = $req->cookie('tokenLog');
        if(isset($cookieOldLog)){
            echo $cookieOldLog;
        }
    }

    public function homePage()
    {
        return view('smoney.homepage.index');
    }

    public function changeLanguage($language){
        \Session::put('website_language', $language);
        return redirect()->back();
    }
    public function homePage_old(Request $req)
    {
        if(Auth::check()){
            $userLogged = Auth::user();
            $findUser = Student::where("_id",$userLogged->tks_sotk)->first();
            return view('smoney.homepage.homepage',[
                'status' => 'userLogged',
                'name' => $findUser->hoten,
                'image' => $findUser->avatar
            ]);   
        }else{
            return view('smoney.homepage.homepage');
        }
    }

    public function login()
    {
        $province_address = DB::table('province_address')->get();
        return view('smoney.homepage.login',['province_address' => $province_address]);
    }
    public function register()
    {
        $province_address = DB::table('province_address')->get();
        return view('smoney.homepage.login',['province_address' => $province_address, 'mode'=> 'register']);
    }

    public function logout()
    {
        \Cookie::queue(\Cookie::forget('phone'));
        \Cookie::queue(\Cookie::forget('password'));
        // \Cookie::queue(\Cookie::forget('tokenLog'));
        Auth::logout();
        session()->flush();
        return redirect()->route("homepage.homepage_old");
    }
    // select address
    public function findDistrict(Request $req)
    {
        $district_address = DB::table('district_address')->where("provinceid",$req->provinceID)->get();
        $result = (object) array(
            'status' => 'success',
            'district_address' => $district_address,
        );
        return response()->json($result);
    }
    public function findWard(Request $req)
    {
        $ward_address = DB::table('ward_address')->where("districtid",$req->districtID)->get();
        $result = (object) array(
            'status' => 'success',
            'ward_address' => $ward_address,
        );
        return response()->json($result);
    }
    
    public function jobInformation(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.jobinformation')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }
    public function marketplace(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.marketplace')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }
    
    public function loadAllCity(Request $req){
        $province_address = DB::table('province_address')->get();
        $result = (object) array(
            'status' => 'success',
            'province_address' => $province_address,
        );
        return response()->json($result);
    }
}

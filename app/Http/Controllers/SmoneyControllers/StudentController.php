<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;

class StudentController extends Controller
{
    public function studentPage() {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.student')->with([
                'name' => $findStudent->hoten
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }


    public function postRegister(Request $req)
    {
        $this->validate($req,[
            'fullname'=>'required',
            'phone'=>'required|min:9|max:11',
            'password'=>'required|min:0|max:32'
        ],[
            'fullname.required' => 'Bạn phải nhập họ tên',
            'phone.required' => 'Bạn phải nhập số điện thoại',
            'phone.min' => 'Số điện thoại quá ngắn',
            'phone.max' => 'Số điện thoại quá dài',
            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.max' => 'Mật khẩu quá dài',
        ]);
        $checkExist = TaiKhoanSmoney::where("tks_sdt",$req->phone)->first();
        if(!$checkExist){
            $newStudent = new Student();
            $newStudent->hoten = $req->fullname;
            $newStudent->sdt = $req->phone;
            $newStudent->save();

            $newAccount = new TaiKhoanSmoney();
            $newAccount->tks_sotk = $newStudent->_id;
            $newAccount->tks_tentk = $req->fullname;
            $newAccount->tks_sdt = $req->phone;
            $newAccount->ths_mk = Hash::make($req->password);
            $newAccount->save();
        }
        else{
            return back()->with("error","Tài khoản đã tồn tại");
        }

        if(Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$req->password])){
            return redirect()->route("student.student");
        }
        else{
            return back()->with("error","Đăng nhập thất bại");
        }
    }
    public function postLogin(Request $req)
    {
        $this->validate($req,[
            'phone'=>'required|min:9|max:11',
            'password'=>'required|min:0|max:32'
        ],[
            'phone.required' => 'Bạn phải nhập số điện thoại',
            'phone.min' => 'Số điện thoại quá ngắn',
            'phone.max' => 'Số điện thoại quá dài',
            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.max' => 'Mật khẩu quá dài',
        ]);
        if(Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$req->password])){
            return redirect()->route("student.student");
        }
        else{
            return back()->with("error","Sai tài khoản hoặc mật khẩu");
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route("homepage.homepage_old");
    }
}

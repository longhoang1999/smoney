<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Models\SmoneyModels\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// model
use App\Models\SmoneyModels\TaiKhoanSmoney;

class StudentController extends Controller
{
    // public function getInfo()
    // {
    //     print_r(Student::get());
    //     //echo "string";
    // }
    public function studentPage() {
        return view('smoney.student.student');
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
            $newAccount = new TaiKhoanSmoney();
            $newAccount->tks_sdt = $req->phone;
            $newAccount->ths_mk = Hash::make($req->password);
            $newAccount->save();
        }
        if(Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$req->password]))
        {
            return redirect()->route("student.student");
        }
        else
        {
            echo "Đăng nhập thất bại";
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
        if(Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$req->password]))
        {
            return redirect()->route("student.student");
        }
        else
        {
            echo "Đăng nhập thất bại";
        }
    }
}

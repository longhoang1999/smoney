<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use PHPMailer;

class StudentController extends Controller
{
    public function studentPage() {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.student')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
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
            'password'=>'required|min:0|max:32',
            'confirm'=>'required|min:0|max:32',
            'email'=>'email'
        ],[
            'fullname.required' => 'Bạn phải nhập họ tên',
            'phone.required' => 'Bạn phải nhập số điện thoại',
            'phone.min' => 'Số điện thoại quá ngắn',
            'phone.max' => 'Số điện thoại quá dài',
            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.max' => 'Mật khẩu quá dài',
            'confirm.required' => 'Bạn phải nhập xác nhận mật khẩu',
            'confirm.min' => 'Xác nhận mật khẩu quá ngắn',
            'confirm.max' => 'Xác nhận mật khẩu quá dài',
            'email.email' => 'Bạn nhập sai định dạng email'
        ]);
        if($req->password === $req->confirm){
            $checkExist = TaiKhoanSmoney::where("tks_sdt",$req->phone)->first();
            if(!$checkExist){
                // create new student
                $newStudent = new Student();
                $newStudent->hoten = $req->fullname;
                $newStudent->sdt = $req->phone;
                $newStudent->email = $req->email;
                $newStudent->diachi = $req->address;
                // create folder
                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $newStudent->code = substr(str_shuffle($permitted_chars), 0, 20); 
                $path = public_path().'/folder-user/' . $newStudent->code;
                File::makeDirectory( $path,0777,true);
                $newStudent->save();

                // create new account
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
        }else{
            return back()->with("error","Xác nhận mật khẩu không chính xác");
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
    public function preferential()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.preferential')->with([
                'name' => $findStudent->hoten
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }

    public function studentLoan()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.student-loan')->with([
                'name' => $findStudent->hoten
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }
    public function searchPhone(Request $req)
    {
        $findStudent = Student::where("sdt",$req->phone)->first();
        if($findStudent){
            $result = (object) array('status' => 'success','name' => $findStudent->hoten,'sdt' => $findStudent->sdt,'email' => $findStudent->email);
            return response()->json($result);
        }else{
            $result = (object) array('status' => 'fail');
            return response()->json($result);
        }
    }
    public function sendMailForgot(Request $req){
        $findUser = Student::where([
            ['sdt', $req->sdt],
            ['email', $req->email]
        ])->first();

        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $key= substr(str_shuffle($permitted_chars), 0, 6);
        $findUser->keyforgot = $key;
        $findUser->save();

        $body = view('smoney/homepage/formforgotpass',['key' => $key,'phone' => $findUser->sdt])->render();

        if($this->sendMail($req->email,$body)){
            $result = (object) array('status' => 'success');
            return response()->json($result);
        }else{
            $result = (object) array('status' => 'fail');
            return response()->json($result);
        }
    }
    public function sendMail($email,$body){
        require_once '../app/Providers/PHPMailer/PHPMailerAutoload.php'; 
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'longhoanghai8499@gmail.com';
        $mail->Password = 'shikatori8499';
        $mail->isHTML(true);
        $mail->setFrom('system@gmail.com', 'Smoney System');
        $mail->addAddress($email, 'User');
        $mail->Subject = 'The message confirms you have successfully registered!';
        $mail->Body = $body;
        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }
    public function forgotPass(Request $req, $phone, $key){
        $findUser = Student::where([
            ['sdt', $phone],
            ['keyforgot', $key]
        ])->first();
        if($findUser){
            return view('smoney/homepage/changepass',[
                'phone' => $findUser->sdt,
                'key' => $findUser->keyforgot
            ]);
        }else{
            return view('404');
        }
    } 
    public function changePass(Request $req, $key){
        if($req->password === $req->comfirm)
        {
            $findUser = Student::where([
                ['sdt', $req->phone],
                ['keyforgot', $key]
            ])->first();
            if($findUser){
                $findUser->keyforgot = null;
                $findUser->save();
                $findUserAccount = TaiKhoanSmoney::where("tks_sdt",$req->phone)->first();
                $findUserAccount->ths_mk = Hash::make($req->password);
                $findUserAccount->save();
                return redirect()->route("homepage.login")->with("error","Bạn đã đổi mật khẩu thành công");
            }else{
                return back()->with("error","Cố lỗi khi thực hiện thao tác");
            }
        }else{
            return back()->with("error","Xác nhận mật khẩu sai");
        }
    }  

    public function studentInformation()
    {
        $userLogged = Auth::user();
        $findInfor = Student::where("_id",$userLogged->tks_sotk)->first();
        return view('smoney/student/information',[
            'avatar' => $findInfor->avatar,
            'name' => $findInfor->hoten,
            'phone' => $findInfor->sdt,
            'cccd' => $findInfor->cccd,
            'email' => $findInfor->email,
            'ngaysinh' => $findInfor->ngaysinh,
            'address' => $findInfor->diachi,
            'gender' => $findInfor->gioitinh,
            'sotk' => $findInfor->stk,
        ]);
    }
    public function changeAvatar(Request $req){
        $user = Auth::user();
        $student = Student::where("_id",$user->tks_sotk)->first();
        if($student->avatar != "")
            File::delete(public_path($student->avatar));
        $image = $req->file('file');
        $picName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('folder-user/'.$student->code), $picName);

        $student->avatar='folder-user/'.$student->code.'/'.$picName;
        $student->save();

        $result = (object) array('status' => 'success','linkImg' => asset($student->avatar));
        return response()->json($result);
    }
    public function updateInformation(Request $req)
    {
        // fullname cccd  date  gender  email  address  stk
        $this->validate($req,[
            'fullname'=>'required',
            'cccd'=>'required|numeric',
            'date' => 'date',
            'email'=>'required|email',
        ],[
            'fullname.required' => 'Bạn phải nhập họ tên',
            'cccd.required' => 'Bạn phải nhập số căn cước công dân',
            'cccd.numeric' => 'Số căn cước công dân phải là số',
            'date.date' => 'Ngày sinh phải là ngày tháng',
            'email.required' => 'Bạn phải nhập email',
            'email.email' => 'Email sai định dạng',
        ]);
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        $findStudent->hoten = $req->fullname;
        $findStudent->cccd = $req->cccd;
        $findStudent->email = $req->email;
        $findStudent->ngaysinh = $req->date;
        $findStudent->diachi = $req->address;
        $findStudent->gioitinh = $req->gender;
        $findStudent->stk = $req->stk;
        $findStudent->save();
        return back()->with("success","Cập nhật thông tin thành công");
    }
     
}

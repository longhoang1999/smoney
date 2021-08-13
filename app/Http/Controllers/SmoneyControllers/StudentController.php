<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PHPMailer;
use Redirect;
use Cookie;

// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;

class StudentController extends Controller
{
    public function deviceName(){
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $webWindows = stripos($_SERVER['HTTP_USER_AGENT'],"Windows"); 

        $device = "";
        if($iPod != false)
            $device = "iPod";
        else if($iPhone != false)
            $device = "iPhone";
        else if($iPad != false)
            $device = "iPad";
        else if($Android != false)
            $device = "Android";
        else if($webOS != false)
            $device = "webOS";
        else if($webWindows != false)
            $device = "webWindows";

        return $device;
    }
    public function writeLog(){
        // 1. make random string key, hash this -> save database
        // 2. encrypt this -> send cokie client
        // 3. decrypt token from client -> hash check with database
        
        $device = $this->deviceName();
        // find code user login
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        $code = $findStudent->code;

        // create token plain text
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tokenPlainText = substr(str_shuffle($permitted_chars), 0, 20);

        // create token encrypt -> send this to cokie
        $tokenEncrypt = $this->encrypt_decrypt($tokenPlainText, 'encrypt', $code);

        $newLogUser = new TaiKhoanSmoney_Log();
        $newLogUser->log_id_user = $user->tks_id;
        $newLogUser->log_token = Hash::make($tokenPlainText);
        $newLogUser->log_ip_address = \Request::ip();
        $newLogUser->log_device_name = $device;
        $newLogUser->save();

        return $tokenEncrypt;
    }
    public function writeString($string){
        // find code user login
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        $code = $findStudent->code;

        // 
        $tokenEncrypt = $this->encrypt_decrypt($string, 'encrypt', $code);
        return $tokenEncrypt;
    }
    public function updateLog($idLog){
        // find code user login
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        $code = $findStudent->code;

        // create token plain text
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tokenPlainText = substr(str_shuffle($permitted_chars), 0, 20);

        // create token encrypt -> send this to cokie
        $tokenEncrypt = $this->encrypt_decrypt($tokenPlainText, 'encrypt', $code);

        $oldLogUser = TaiKhoanSmoney_Log::where("log_id",$idLog)->first();
        $oldLogUser->log_token = Hash::make($tokenPlainText);
        $oldLogUser->save();

        return $tokenEncrypt;
    }
    function encrypt_decrypt($string, $action = 'encrypt',$secret_key_Auth)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = $secret_key_Auth; // user define private key
        $secret_iv = 'SMONEY'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
    function merge($a1, $a2) {

        $aRes = $a1;
        foreach ( array_slice ( func_get_args (), 1 ) as $aRay ) {
            foreach ( array_intersect_key ( $aRay, $aRes ) as $key => $val )
                $aRes [$key] += $val;
            $aRes += $aRay;
        }
        return $aRes;
    }




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

                $body = view('smoney/homepage/formcongratulations')->render();
                if($this->sendMail($req->email,$body)){
                    $sendMail = "success";
                }else{
                    $sendMail = "fail";
                    // sendMail -> view
                }
            }
            else{
                return back()->with("error","Tài khoản đã tồn tại");
            }

            if(Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$req->password])){
                $user = Auth::user();
                $tokenEncrypt = $this->writeLog();

                $tokenLogObject = (object) array("tokenLog" => $tokenEncrypt);
                $result = (object) array(
                    $user->tks_id => $tokenLogObject,
                );
                $resultToJSON = json_encode($result);
                // lấy token hiện tại thêm vào
                $cookieOldLog = $req->cookie('tokenLog');
                if(isset($cookieOldLog)){
                    $a = json_decode($cookieOldLog);
                    $b = json_decode($resultToJSON);
                    $c= (object) $this->merge((array)$a, (array)$b);
                    $c = json_encode($c);
                }else{
                    $c = $resultToJSON;
                }
                $passwordEncrypt = $this->writeString($req->password);
                return redirect()->route('student.student')
                    ->withCookie(cookie('tokenLog', $c, 43200))
                    ->withCookie(cookie('phone', $req->phone, 20160))
                    ->withCookie(cookie('password', $passwordEncrypt, 20160));
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
            $user = Auth::user();
            $tks_id = $user->tks_id;
            $findStudent = Student::where("_id",$user->tks_sotk)->first();
            $checkDevice = false;
            // check Device
            $logDevice = $req->cookie('tokenLog');
            if(isset($logDevice)){
                $logDevice = json_decode($logDevice);
                
                $logThisDevice = (isset($logDevice->$tks_id)) ? $logDevice->$tks_id->tokenLog : "";
                $tokenDecrypt = $this->encrypt_decrypt($logThisDevice, 'decrypt', $findStudent->code);

                $findUserLog = TaiKhoanSmoney_Log::where("log_id_user",$user->tks_id)->get();
                
                foreach($findUserLog as $value){
                    if(Hash::check($tokenDecrypt, $value->log_token))
                    {
                        $checkDevice = true;
                        $idLogData = $value->log_id;
                    }
                }
            }
            // true -> create new token
            if($checkDevice == true){
                unset($logDevice->$tks_id);
                
                // create new token
                $tokenEncrypt = $this->updateLog($idLogData);
                $tokenLogObject = (object) array("tokenLog" => $tokenEncrypt);
                $result = (object) array(
                    $user->tks_id => $tokenLogObject,
                );
                $c= (object) $this->merge((array)$logDevice, (array)$result);
                $c = json_encode($c);

                $passwordEncrypt = $this->writeString($req->password);
                return redirect()->route('student.student')
                    ->withCookie(cookie('tokenLog', $c, 43200))
                    ->withCookie(cookie('phone', $req->phone, 20160))
                    ->withCookie(cookie('password', $passwordEncrypt, 20160));
            }
            // false -> logout -> send mail
            if($checkDevice == false){
                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $checkDeviceCode = substr(str_shuffle($permitted_chars), 0, 8);

                $user->tks_key_device = $checkDeviceCode;
                $user->save();
                // send mail
                $body = view('smoney/homepage/formcheckdevice',[
                    'maso' => $checkDeviceCode,
                ])->render();
                if($this->sendMail($findStudent->email,$body)){
                    $sendMail = "success";
                }else{
                    $sendMail = "fail";
                }

                $passwordEncrypt = $this->writeString($req->password);
                Auth::logout();
                return back()
                    ->with("action","modalOpen")
                    ->with("userID",$tks_id)
                    ->with("phone",$req->phone)
                    ->with("passwordEncrypt", $passwordEncrypt);
            }
        }
        else{
            return back()->with("error","Sai tài khoản hoặc mật khẩu");
        }
    }
    public function successDevice(Request $req){
        $findAcc = TaiKhoanSmoney::where("tks_id",$req->idUser)->where("tks_key_device",$req->key)->first();
        if($findAcc){
            $findAcc->tks_key_device = null;
            $findAcc->save();

            // create token plain text
            $findStudent = Student::where("_id",$findAcc->tks_sotk)->first();
            $passwordDecrypt = $this->encrypt_decrypt($req->passwordEncrypt, 'decrypt', $findStudent->code);
            Auth::attempt(['tks_sdt'=>$req->phone,'password'=>$passwordDecrypt]);

            $user = Auth::user();
            $tokenEncrypt = $this->writeLog();

            $tokenLogObject = (object) array("tokenLog" => $tokenEncrypt);
            $result = (object) array(
                $user->tks_id => $tokenLogObject,
            );
            $resultToJSON = json_encode($result);
            // lấy token hiện tại thêm vào
            $cookieOldLog = $req->cookie('tokenLog');
            if(isset($cookieOldLog)){
                $a = json_decode($cookieOldLog);
                $b = json_decode($resultToJSON);
                $c= (object) $this->merge((array)$a, (array)$b);
                $c = json_encode($c);
            }else{
                $c = $resultToJSON;
            }

            
            return redirect()->route('student.student')
                ->withCookie(cookie('tokenLog', $c, 43200))
                ->withCookie(cookie('phone', $req->phone, 20160))
                ->withCookie(cookie('password', $req->passwordEncrypt, 20160));
        }else{
            return back()
                ->with("error","Bạn nhập sai mã, vui lòng xem lại trong Email của bạn")
                ->with("action","modalOpen")
                ->with("userID",$req->idUser)
                ->with("phone",$req->phone)
                ->with("passwordEncrypt", $req->passwordEncrypt);
        }
    }   
    public function preferential()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.preferential')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
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
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
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
        $mail->Subject = 'THƯ ĐƯỢC GỬI TỰ ĐỘNG TỪ HỆ THỐNG SMONEY. VUI LÒNG KHÔNG TRẢ LỜI THƯ NÀY';
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
        $province_address = DB::table('province_address')->get();
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
            'province_address' => $province_address
        ]);
    }
    public function changeAvatar(Request $req){
        $user = Auth::user();
        $student = Student::where("_id",$user->tks_sotk)->first();
        if($student->avatar != "")
            File::delete(public_path($student->avatar));

        $data = $req->image;
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';
        $url = public_path('folder-user/'.$student->code.'/'.$imageName);
        file_put_contents($url, $data);

        $student->avatar='folder-user/'.$student->code.'/'.$imageName;
        $student->save();

        $result = (object) array('status' => 'success','linkImg' => asset($student->avatar));
        return response()->json($result);


        // $user = Auth::user();
        // $student = Student::where("_id",$user->tks_sotk)->first();
        // if($student->avatar != "")
        //     File::delete(public_path($student->avatar));
        // $image = $req->file('file');
        // $picName = time().'.'.$image->getClientOriginalExtension();
        // $image->move(public_path('folder-user/'.$student->code), $picName);

        // $student->avatar='folder-user/'.$student->code.'/'.$picName;
        // $student->save();

        // $result = (object) array('status' => 'success','linkImg' => asset($student->avatar));
        // return response()->json($result);
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

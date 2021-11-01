<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use PHPMailer;
use Socialite;

use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;

class SocialNetworkController extends Controller
{
    public function getInfor($social)
    {
        return Socialite::driver($social)->redirect();
    }
    public function checkInfor($social){
        $info = Socialite::driver($social)->user();
        $user = TaiKhoanSmoney::where('provider',$social)
            ->where('provider_user_id',$info->getId())
            ->where('tks_loaitk', "1")
            ->first();
        if($user){
            // Already have an account
            if($this->updatedAccFB($user,$info,$social) == "ok")
                return redirect()->route('student.student');
            else
                return redirect()->route('homepage.login')->with("error","Email đã đăng ký, vui lòng chọn tài khoản khác");
        }else{
            // No account
            if($this->createdAccFB($info,$social) == "ok")
                return redirect()->route('student.student');
            else
                return redirect()->route('homepage.login')->with("error","Email đã đăng ký, vui lòng chọn tài khoản khác");
        }
    }

    public function updatedAccFB($user,$info,$social)
    {
        //updated
        $checkEmail = TaiKhoanSmoney::where("tks_id","<>",$user->tks_id)->where("tks_email",$info->getEmail())->first();
        if(empty($checkEmail))
        {
            $findStudent = Student::where("_id", $user->tks_sotk)->first();
            $socialUpdated =  $social;
            $user->tks_email = $info->getEmail();
            $user->tks_tentk = $info->getName();
            $user->provider_user_id = $info->getId();
            $user->provider = $socialUpdated;

            $findStudent->email = $info->getEmail();         
            $findStudent->hoten = $info->getName();
            $findStudent->save();
            if($info->avatar_original != null)
            {
                File::delete(public_path($findStudent->avatar));
                $extension = 'jpg';
                $picName = time().'.'.$extension;
                $file = file_get_contents($info->avatar_original);
                $save = file_put_contents('folder-user/'.$findStudent->code.'/'.$picName, $file);
                if($save)
                {
                    $findStudent->avatar='folder-user/'.$findStudent->code.'/'.$picName;
                    $findStudent->save();
                }
            }
            $user->save();
            Auth::login($user);
            return $status = "ok";
        }
        else{
            return $status = "exist";
        }
    }
    public function createdAccFB($info,$social)
    {
        $checkEmail = TaiKhoanSmoney::where("tks_email",$info->getEmail())->first();
        if(empty($checkEmail))
        {
            // created
            $newStudent = new Student();
            $socialCreated =  $social;
            $newStudent->hoten = $info->getName();
            $newStudent->email = $info->getEmail();
            // create folder
            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $newStudent->code = substr(str_shuffle($permitted_chars), 0, 20); 
            $path = public_path().'/folder-user/' . $newStudent->code;
            File::makeDirectory( $path,0777,true);
            if($info->avatar_original != null)
            {
                $extension = 'jpg';
                $picName = time().'.'.$extension;
                $file = file_get_contents($info->avatar_original);
                $save = file_put_contents('folder-user/'.$newStudent->code.'/'.$picName, $file);
                if($save)
                {
                    $newStudent->avatar='folder-user/'.$newStudent->code.'/'.$picName;
                }
            }
            $newStudent->save();

            // create new account
            $newAccount = new TaiKhoanSmoney();
            $newAccount->tks_sotk = $newStudent->_id;
            $newAccount->tks_tentk = $info->getName();
            $newAccount->tks_email = $info->getEmail();
            $newAccount->provider_user_id = $info->getId();
            $newAccount->provider = $socialCreated;
            $newAccount->save();


            $body = view('smoney/homepage/formcongratulations')->render();
            if($this->sendMail($info->getEmail(),$body)){
                $sendMail = "success";
            }else{
                $sendMail = "fail";
                // sendMail -> view
            }
            Auth::login($newAccount);
            return $status = "ok";
        }
        else
        {
            return $status = "exist";
        }
    }   

    
    // send mail
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
}

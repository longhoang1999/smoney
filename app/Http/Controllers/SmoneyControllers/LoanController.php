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
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;

class LoanController extends Controller
{
    function merge($a1, $a2) {

        $aRes = $a1;
        foreach ( array_slice ( func_get_args (), 1 ) as $aRay ) {
            foreach ( array_intersect_key ( $aRay, $aRes ) as $key => $val )
                $aRes [$key] += $val;
            $aRes += $aRay;
        }
        return $aRes;
    }


    public function applyLoan()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            return view('smoney.student.applyloan')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }

    public function loanRequest(Request $req){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {

            // Xóa hồ sơ cũ
            $findOldHS  = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                        ->where("hsk_send_status","false")->get();
            foreach($findOldHS as $hs){
                $hs->delete();
            }
            return view('smoney.student.loan-request')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar,
                'sdt' => $findStudent->sdt,
                'email' => $findStudent->email,
            ]);
        }
        else 
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
    }
    // load time
    public function loadTimeline(Request $req){
        $idHS = ""; $uniID = ""; $uniAr = array();
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();

        if(isset($req->pagepresent)){
            switch ($req->pagepresent) {
                case 'thongtinkhoanvay1': {
                    $hoso = new HoSoKhoanVay();
                    $hoso->hsk_id_student = $findStudent->_id;
                    $hoso->hsk_money = $req->data["money"];
                    $hoso->hsk_purpose = $req->data["purpose"];
                    $hoso->hsk_duration = $req->data["duration"];
                    // đang ở trang nào
                    $hoso->pagepresent = "thongtinkhoanvay1";
                    // ng dùng chưa xác nhận gửi
                    $hoso->hsk_send_status = "false";
                    $hoso->save();
                    $idHS = $hoso->_id;
                    break;
                }
                case 'thongtincanhan1':{
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->hsk_ten = $req->data['fullname'];
                    $findHS->hsk_main_phone = $req->data['phone'];
                    $findHS->hsk_cccd = $req->data['cccd'];
                    $findHS->hsk_birthday = $req->data['birthday'];
                    $findHS->pagepresent = "thongtincanhan1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'thongtincanhan2': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->hsk_email = $req->data['email'];
                    $findHS->hsk_gender = $req->data['gender'];
                    $findHS->hsk_stk = $req->data['stk'];
                    $findHS->hsk_otherPhone = $req->data['otherPhone'];
                    $findHS->pagepresent = "thongtincanhan2";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'thongtincuchu1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    if($req->data['liveWith'] != "3")
                        $findHS->hsk_liveWith = $req->data['liveWith'];
                    else
                        $findHS->hsk_liveWith = $req->data['liveOther'];
                    $findHS->pagepresent = "thongtincuchu1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'thongtincuchu2': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->hsk_address = $req->data['address'];
                    $findHS->pagepresent = "thongtincuchu2";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'thongtincuchu3': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    if($req->data['check'] == "1")
                        $findHS->hsk_address_now = $findHS->hsk_address;
                    else
                        $findHS->hsk_address_now = $req->data['addressNow'];
                    $findHS->pagepresent = "thongtincuchu3";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'cosodaotao1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->hsk_numberSchool = $req->data['numberSchool'];
                    $findHS->pagepresent = "cosodaotao1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'cosodaotao2': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $data = $req->data;
                    unset($data['maHS']);
                    unset($data['universityID']);
                    $oldUni = $findHS->university;
                    $newUni = (object) array($req->data['universityID'] => $data );
                    // check total uni
                    $findHS->hsk_numberSchool = strval(intval($findHS->hsk_numberSchool) - 1);
                    if($oldUni != null){
                        $c = (object) $this->merge((array)$oldUni, (array)$newUni);
                        $findHS->university = $c;
                    }else{
                        $findHS->university = $newUni;
                    }                    

                    $findHS->pagepresent = "cosodaotao2";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    $uniID = $req->data['universityID'];
                    break;
                }
                case 'cosodaotao3': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $data = $req->data;
                    unset($data['maHS']);
                    unset($data['universityID']);
                    $uniID = $req->data['universityID'];

                    $universityOld = $findHS->university;
                    $universityNew = array_merge($universityOld[$uniID],$data);
                    $universityOld[$uniID] = $universityNew;

                    $findHS->university = $universityOld;
                    $findHS->pagepresent = "cosodaotao3";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'cosodaotao4': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $data = $req->data;
                    unset($data['maHS']);
                    unset($data['universityID']);
                    $uniID = $req->data['universityID'];

                    $universityOld = $findHS->university;
                    $universityNew = array_merge($universityOld[$uniID],$data);
                    $universityOld[$uniID] = $universityNew;

                    $findHS->university = $universityOld;
                    $findHS->pagepresent = "cosodaotao4";
                    //check
                    $uniAr = array_keys($universityOld);
                    if(intval($findHS->hsk_numberSchool) > 0 ){
                        $req->page = "cosodaotao2";
                    }else if(count($uniAr) > 1 && $findHS->chooseSchool == null){
                        $req->page = "cosodaotao5";
                    }
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'cosodaotao5': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();

                    $findHS->chooseSchool = $req->data['chooseSchool'];
                    $findHS->pagepresent = "cosodaotao5";

                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
            }
        }

        $body = view('smoney/student/loanRequest/'.$req->page)->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar,
                'sdt' => $findStudent->sdt,
                'email' => $findStudent->email,
                'cccd' => $findStudent->cccd,
                'ngaysinh' => $findStudent->ngaysinh,
                'gioitinh' => $findStudent->gioitinh,
                'uniID' => $uniID,
                'uniAr' => $uniAr
            ])->render();
        return [$idHS,$body];
    }
    public function upFilePoint(Request $req){
        $this->validate($req,[
            'file'=>'required|mimes:jpeg,png,jpg'
        ]);
        $user = Auth::user();
        $findStudent = Student::select("code")->where("_id",$user->tks_sotk)->first();
        if(!empty($findStudent))
        {
            $file_temp = $req->file('file');
            $extension = $file_temp->getClientOriginalExtension();
            $noExtension = time().'_'.rand(10,10000);
            $picName = $noExtension.'.'.$extension;
            $file_temp->move(public_path('folder-user/'.$findStudent->code), $picName);
            $response = 'folder-user/'.$findStudent->code.'/'.$picName;
            $response = (object) array('url' => $response);
            return json_encode($response);
        }
    }
    public function deleteImgPoint(Request $req){
        File::delete(public_path($req->value));
        $response = (object) array('status' => 'delete success');
        return response()->json($response);
    }
}

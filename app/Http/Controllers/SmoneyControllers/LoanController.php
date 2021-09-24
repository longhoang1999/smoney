<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use PHPMailer;
use Redirect;
use Cookie;

// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\SinhVienHoSo;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;

class LoanController extends Controller
{
    // format address
    public function formatAddress($objectAddress){
        if($objectAddress != null){
            $province_address = DB::table('province_address')->where("provinceid",$objectAddress['tinh'])->first();
            $district_address = DB::table('district_address')->where("districtid",$objectAddress['huyen'])->first();
            $ward_address = DB::table('ward_address')->where("wardid",$objectAddress['xa'])->first();
            return $objectAddress['home']." - ".$ward_address->type." ".$ward_address->name." - ".$district_address->type." ".$district_address->name." - ".$province_address->type." ".$province_address->name;
        }else{
            return "";
        }
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
    function takePagepresent($pagepresent){
        if($pagepresent == "thongtinkhoanvay1")
            return "Thông tin khoản vay";
        if( $pagepresent == "thongtincanhan1" || $pagepresent == "thongtincanhan2" || $pagepresent == "thongtincuchu1" || $pagepresent == "thongtincuchu2" || $pagepresent == "thongtincuchu3"){
            return "Thông tin cá nhân";
        }
        if($pagepresent == "cosodaotao1" || $pagepresent == "cosodaotao2" || $pagepresent == "cosodaotao3" || $pagepresent == "cosodaotao4" || $pagepresent == "cosodaotao5"){
            return "Cơ sở đào tạo";
        }
        if($pagepresent == "vieclam1" || $pagepresent == "vieclam2" || $pagepresent == "vieclam3" || $pagepresent == "vieclam4"){
            return "Việc làm";
        }
        if($pagepresent == "option1" || $pagepresent == "option2" || $pagepresent == "option3" || $pagepresent == "option4" || $pagepresent == "otherpage1" || $pagepresent == "tag1"){
            return "Tùy chọn khác (nếu có)";
        }
        if($pagepresent == "notification1" || $pagepresent == "vote1"){
            return "Điều khoản Smoney";
        }
    }
    public function applyLoan()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        if($findStudent) {
            $findHSDone = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)->where("hsk_send_status","true")->get();

            $findHSNotDone = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)->where("hsk_send_status","saved")->get();
            foreach($findHSNotDone as $hs){
                $hs['takePagepresent'] = $this->takePagepresent($hs->pagepresent);
            }

            return view('smoney.student.applyloan')->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar,
                'findHSDone' => $findHSDone,
                'findHSNotDone' => $findHSNotDone
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

    public function loanRequest(Request $req,$idNN){
        $choseBank = NganHang::where("nn_id",$idNN)->first();
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();

        $inforUniArr = array();
        $uniAr = array();
        if($findStudent->university != null){
            $university = $findStudent->university;
            $uniAr = array_keys($university);

            $index = 1;
            foreach($uniAr as $value){
                $findNhaTruong = NhaTruong::where("nt_id",$value)->first();
                $newArr = array("index" => $index,
                                "id" => $findNhaTruong->nt_id,
                                "name" => $findNhaTruong->nt_ten,
                                "studentCode" => $university[$value]["studentCode"],
                                "specialized" => $university[$value]["specialized"],
                                "nameClass" => $university[$value]["nameClass"],
                                "typeProgram" => $university[$value]["typeProgram"],
                                "emailStudent" => $university[$value]["emailStudent"],
                );
                array_push($inforUniArr, $newArr);
                $index ++;
            } 
        }
        if($findStudent) {
            // Xóa hồ sơ cũ
            $findOldHS  = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                        ->where("hsk_send_status","false")->get();
            foreach($findOldHS as $hs){
                $hs->delete();
            }
            return view('smoney.student.loan-request')->with([
                'avatar' => $findStudent->avatar,
                'name' => $findStudent->hoten,
                'phone' => $findStudent->sdt,
                'cccd' => $findStudent->cccd,
                'email' => $findStudent->email,
                'ngaysinh' => $findStudent->ngaysinh,
                'addressString' => $this->formatAddress($findStudent->diachi),
                'addressNowString' => $this->formatAddress($findStudent->diachihientai),
                'otherSdt' => $findStudent->otherSdt,
                'gender' => $findStudent->gioitinh,
                'sotk' => $findStudent->stk,
                'university' => $inforUniArr,
                'parents' => $findStudent->parents,
                'yourjob' => $findStudent->yourjob,
                'choseBank' => $choseBank,
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }
    // load time
    public function loadTimeline(Request $req){
        $idHS = ""; $uniID = ""; $uniAr = array();
        $hsk_numberSchool = "";
        $IDchoseShool = "";
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();

        if(isset($req->pagepresent)){
            switch ($req->pagepresent) {
                case 'thongtinkhoanvay1': {
                    if($req->data["maHS"] == null){
                        $hoso = new HoSoKhoanVay();
                    }else{
                        $hoso = HoSoKhoanVay::where("_id",$req->data["maHS"])->first();
                    }
                    $hoso->idBank = $req->data["idBank"];
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
                    $findHS->hsk_numberSchool = "0";
                    $findHS->hsk_numberSchool_checkBack = $req->data['numberSchool'];
                    $findHS->university = null;
                    $findHS->pagepresent = "cosodaotao1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    if($req->data['numberSchool'] != "1")
                        $hsk_numberSchool = $findHS->hsk_numberSchool;
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
                    $findHS->hsk_numberSchool = strval(intval($findHS->hsk_numberSchool) + 1);
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
                    if(isset($req->data['imgPointAr'])){
                        $findHS->imgPointAr = $req->data['imgPointAr'];
                    }
                    $findHS->pagepresent = "cosodaotao4";
                    $findHS->save();
                    // $data = $req->data;
                    // unset($data['maHS']);
                    // unset($data['universityID']);
                    // $uniID = $req->data['universityID'];

                    // $universityOld = $findHS->university;
                    // $universityNew = array_merge($universityOld[$uniID],$data);
                    // $universityOld[$uniID] = $universityNew;

                    // $findHS->university = $universityOld;
                    // $findHS->pagepresent = "cosodaotao4";
                    // //check
                    // $uniAr = array_keys($universityOld);
                    // if(intval($findHS->hsk_numberSchool) < intval($findHS->hsk_numberSchool_checkBack)){
                    //     $req->page = "cosodaotao2";
                    //     $hsk_numberSchool = $findHS->hsk_numberSchool;
                    // }else if(count($uniAr) > 1 && $findHS->chooseSchool == null){
                    //     $req->page = "cosodaotao5";
                    // }
                    // $findHS->save();
                    // $idHS = $findHS->_id;
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
                case 'vieclam1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    if($req->data['employmentStatus'] == "2")
                    {
                        $req->page = "option1";
                    }
                    $findHS->employmentStatus = $req->data['employmentStatus'];
                    $findHS->pagepresent = "vieclam1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'vieclam2': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->timeWork = $req->data['timeWork'];
                    $findHS->pagepresent = "vieclam2";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'vieclam3': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->nameCompany = $req->data['nameCompany'];
                    $findHS->addressCompany = $req->data['addressCompany'];

                    $findHS->pagepresent = "vieclam3";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'vieclam4': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->wage = $req->data['wage'];
                    
                    $findHS->pagepresent = "vieclam4";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'someoption': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->option = $req->data['option'];
                    $findHS->pagepresent = "someoption";
                    if($req->data['option'] == "2"){
                        $req->page = "notification1";
                    }
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'option1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->club = $req->data['club'];
                    if($req->data['club'] == "2"){
                        $req->page = "otherpage1";
                    }
                    $findHS->pagepresent = "option1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'option2': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->nameClub = $req->data['nameClub'];

                    $findHS->pagepresent = "option2";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'option3': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->yourParents = $req->data['yourParents'];
                    if($req->data['yourParents'] == "2"){
                        $req->page = "otherpage1";
                    }
                    $findHS->pagepresent = "option3";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'option4': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->yourParentsInfo = $req->data['yourParentsInfo'];
                    $findHS->pagepresent = "option4";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'otherpage1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    if(isset($req->data['pageObject']))
                        $findHS->pageObject = $req->data['pageObject'];
                    else
                        $findHS->pageObject = null;
                    $findHS->pagepresent = "otherpage1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'tag1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->contentTag = $req->data['contentTag'];
                    $findHS->pagepresent = "tag1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'notification1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->portal = $req->data['portal'];
                    $findHS->pagepresent = "notification1";
                    $findHS->save();
                    $idHS = $findHS->_id;
                    break;
                }
                case 'vote1': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->opinion = $req->data['opinion'];
                    $findHS->star_votes = $req->data['star_votes'];
                    $findHS->pagepresent = "vote1";
                    $findHS->save();
                    $IDchoseShool = $findHS->chooseSchool;
                    $idHS = $findHS->_id;
                    break;
                }
                case 'done': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data['maHS'])->first();
                    $findHS->hsk_send_status = "true";

                    $findHS->pagepresent = "done";
                    
                    $IdsaveSV = $this->copyAndCustomStucent($req->data['maHS']);
                    $findHS->idsaveSV = $IdsaveSV;
                    $findHS->save();
                    $result = (object) array('response' => 'success');
                    return response()->json($result);
                }
                case 'savedRequest': {
                    $findHS = HoSoKhoanVay::where("_id",$req->data)->first();
                    $findHS->hsk_send_status = "saved";
                    $findHS->save();

                    $result = (object) array('response' => 'success');
                    return response()->json($result);
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
                'uniAr' => $uniAr,
                'IDchoseShool' => $IDchoseShool
            ])->render();
        return [$idHS,$body,$hsk_numberSchool];
    }
    public function copyAndCustomStucent($maHS){
        $user = Auth::user();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        $findHS = HoSoKhoanVay::where("_id",$maHS)->first();
        $copyInforSV = new SinhVienHoSo();
        $copyInforSV->maHS = $maHS;
        $copyInforSV->idSV = $findStudent->_id;
        $copyInforSV->hoten = $findStudent->hoten;
        $copyInforSV->sdt = $findStudent->sdt;
        $copyInforSV->email = $findStudent->email;
        $copyInforSV->stk = $findStudent->stk;
        $copyInforSV->diachi = $findStudent->diachi;
        $copyInforSV->diachihientai = $findStudent->diachihientai;
        $copyInforSV->cccd = $findStudent->cccd;
        $copyInforSV->ngaysinh = $findStudent->ngaysinh;
        if(isset($findStudent->otherSdt) && $findStudent->otherSdt != null)
            $copyInforSV->otherSdt = $findStudent->otherSdt;
        if(isset($findStudent->parents) && $findStudent->parents != null)
            $copyInforSV->parents = $findStudent->parents;
        $copyInforSV->yourjob = $findStudent->yourjob;
        $copyInforSV->gioitinh = $findStudent->gioitinh;
        $choseUni = $findHS->chooseSchool;
        $copyInforSV->university = $findStudent->university[$choseUni];
        $copyInforSV->save();
        return $copyInforSV->_id;
    }
    public function loadTimelinePre(Request $req){
        $user = Auth::user(); $uniAr = array();
        $findStudent = Student::where("_id",$user->tks_sotk)->first();
        switch($req->page){
            case 'thongtinkhoanvay1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = (object) array('hsk_money' => $findHS->hsk_money, 'hsk_purpose' => $findHS->hsk_purpose, 'hsk_duration' => $findHS->hsk_duration);
                break;
            }
            case 'cosodaotao5':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = (object) array('chooseSchool' => $findHS->chooseSchool);
                break;
            }
            case 'cosodaotao4':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = $findHS->imgPointAr;
                break;
            }
            case 'someoption':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = $findHS->option;
                break;
            }
            case 'option1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = $findHS->club;
                break;
            }
            case 'option2':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                if($findHS->club == "2"){
                    $req->page = "option1";
                    $dataPre = $findHS->club;
                }else{
                    $dataPre = $findHS->nameClub;
                }
                break;
            }
            case 'otherpage1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = $findHS->pageObject;
                break;
            }
            case 'tag1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                if($findHS->option == "2"){
                    $req->page = "someoption";
                    $dataPre = $findHS->option;
                }else{
                    $dataPre = $this->cutArrray($findHS->contentTag);
                }
                break;
            }
            case 'notification1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = $findHS->portal;
                break;
            }
            case 'vote1':{
                $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
                $dataPre = (object) array('opinion' => $findHS->opinion, 'star_votes' => $findHS->star_votes);
                break;
            }
            
            
            
            

            // case 'thongtincanhan1':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_ten' => $findHS->hsk_ten, 'hsk_main_phone' => $findHS->hsk_main_phone, 'hsk_cccd' => $findHS->hsk_cccd, 'hsk_birthday' => $findHS->hsk_birthday);
            //     break;
            // }
            // case 'thongtincanhan2':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_email' => $findHS->hsk_email, 'hsk_gender' => $findHS->hsk_gender, 'hsk_otherPhone' => $findHS->hsk_otherPhone, 'hsk_stk' => $findHS->hsk_stk);
            //     break;
            // }
            // case 'thongtincuchu1':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_liveWith' => $findHS->hsk_liveWith);
            //     break;
            // }
            // case 'thongtincuchu2':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_address' => $findHS->hsk_address);
            //     break;
            // }
            // case 'thongtincuchu3':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_address_now' => $findHS->hsk_address_now);
            //     break;
            // }
            // case 'cosodaotao1':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $dataPre = (object) array('hsk_numberSchool' => $findHS->hsk_numberSchool_checkBack);
            //     break;
            // }
            // case 'cosodaotao2':{
            //     $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
            //     $indexArr = $req->numberUni;
            //     $universityKey = array_keys($findHS->university);
            //     $universityArray = array_values($findHS->university);

            //     $uniAr = $universityKey;
            //     unset($uniAr[$indexArr]);

            //     $dataPre =  array(
            //         'idUniver' => $universityKey[$indexArr], 
            //         'specialized' => $universityArray[$indexArr]['specialized'], 
            //         'class' => $universityArray[$indexArr]['specialized'], 
            //         'studentCode' => $universityArray[$indexArr]['studentCode']
            //     );
            //     break;
            // }
            
            
        }
        $body = view('smoney/student/loanRequest/'.$req->page)->with([
                'name' => $findStudent->hoten,
                'avatar' => $findStudent->avatar,
                'sdt' => $findStudent->sdt,
                'email' => $findStudent->email,
                'cccd' => $findStudent->cccd,
                'ngaysinh' => $findStudent->ngaysinh,
                'gioitinh' => $findStudent->gioitinh,
                'uniAr' => $uniAr
            ])->render();
        return [$body,$dataPre];
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
        // $findHSNotDone = HoSoKhoanVay::where("_id",$req->maHS)->first();
        // if($findHSNotDone->imgPointAr != null){
        //     $array = $findHSNotDone->imgPointAr;
        //     for($i = 0; $i < count($array); $i++){
        //         if($array[$i] == $req->value){
        //             array_splice($array, $i, 1);
        //         }
        //     }
        //     $findHSNotDone->imgPointAr = $array;
        //     $findHSNotDone->save();
        // }
        File::delete(public_path($req->value));
        $response = (object) array('status' => 'delete success');
        return response()->json($response);
    }
    public function completeProfile($idHS){
        $findHSNotDone = HoSoKhoanVay::where("_id",$idHS)->first();
        switch($findHSNotDone->pagepresent){
            case 'thongtinkhoanvay1':{
                $data = (object) array(
                    '_id' => $findHSNotDone->_id,
                    'pagepresent' => $findHSNotDone->pagepresent,
                    'hsk_money' => $findHSNotDone->hsk_money, 
                    'hsk_purpose' => $findHSNotDone->hsk_purpose,
                    'hsk_duration' => $findHSNotDone->hsk_duration
                );
                break;
            }
        }
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        return view('smoney.student.loan-request')->with([
            'name' => $findStudent->hoten,
            'avatar' => $findStudent->avatar,
            'sdt' => $findStudent->sdt,
            'email' => $findStudent->email,
            'dataComplete' => $data
        ]);
    }
    public function getInfoHoso(Request $req){
        $findHS = HoSoKhoanVay::where("_id",$req->maHS)->first();
        $nameSchool = NhaTruong::where("nt_id",$findHS->chooseSchool)->select("nt_ten")->first();
        $bank = NganHang::where("nn_id",$findHS->idBank)->first();
        $body = view('smoney/student/infohosomodal')->with([
                'hsk_money' => $findHS->hsk_money,
                'hsk_purpose' => $findHS->hsk_purpose,
                'hsk_duration' => $findHS->hsk_duration,
                'chooseSchool' => $nameSchool->nt_ten,
                'imgPointAr' => $findHS->imgPointAr,
                'option' => $findHS->option,
                'club' => $findHS->club,
                'nameClub' => $findHS->nameClub,
                'pageObject' => $findHS->pageObject,
                'contentTag' => $this->cutArrray($findHS->contentTag),
                'portal' => $findHS->portal,
                'opinion' => $findHS->opinion,
                'star_votes' => $findHS->star_votes,
                'bank' => $bank
            ])->render();
        return $body;
    }



    // cut string to array
    public function cutArrray($string)
    {
        $pieces = explode("|", $string);
        $array = array();
        for ($i=0; $i < count($pieces)-1; $i++) {
            $array = Arr::add($array, $i ,$pieces[$i]);
        }
        return $array;
    }
}

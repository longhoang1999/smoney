<?php

namespace App\Http\Controllers\SmoneyControllers;

use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\SinhVienHoSo;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;
use App\Models\SmoneyModels\Notification;

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
    public function loanDetail (){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/loan-detail')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

    public function LoanOfUniWait(){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        $allLoanOfUni = HoSoKhoanVay::where("chooseSchool",strval($findUniversity->nt_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","wait")
                ->get();          
        return DataTables::of($allLoanOfUni)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfUni) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfUni->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'studentCode',
                function ($allLoanOfUni) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfUni->_id)->select("university")->first();
                    return $findStudent->university['studentCode'];
                }
            )
            ->addColumn(
                'duration',
                function ($allLoanOfUni) {
                    if($allLoanOfUni->hsk_duration == "1"){
                        return "3 tháng";
                    }else if($allLoanOfUni->hsk_duration == "2"){
                        return "6 tháng";
                    }else if($allLoanOfUni->hsk_duration == "2"){
                        return "12 tháng";
                    }
                }
            )
            ->addColumn(
                'uniStatus',
                function ($allLoanOfUni) {
                    return "<div class='tag tag-gardien-warning'>Đang chờ</div>";
                }
            )
            ->addColumn(
                'moneyRequest',
                function ($allLoanOfUni) {
                    return number_format($allLoanOfUni->hsk_money)." VNĐ";
                }
            )
            ->addColumn(
                'action',
                function ($allLoanOfUni) {
                    return "<div class='tag tag-border-blue' data-toggle='modal' data-target='#modalDetail' data-id='".$allLoanOfUni->_id."'>Chi tiết</div></a>";
                }
            )
            
            ->rawColumns(['nameStudent','studentCode','duration','uniStatus','moneyRequest','action'])
            ->make(true);
    }

    public function infoApprovedProfile(){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        $allLoanOfUni = HoSoKhoanVay::where("chooseSchool",strval($findUniversity->nt_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->get();          
        return DataTables::of($allLoanOfUni)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfUni) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfUni->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'studentCode',
                function ($allLoanOfUni) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfUni->_id)->select("university")->first();
                    return $findStudent->university['studentCode'];
                }
            )
            ->addColumn(
                'duration',
                function ($allLoanOfUni) {
                    if($allLoanOfUni->hsk_duration == "1"){
                        return "3 tháng";
                    }else if($allLoanOfUni->hsk_duration == "2"){
                        return "6 tháng";
                    }else if($allLoanOfUni->hsk_duration == "2"){
                        return "12 tháng";
                    }
                }
            )
            ->addColumn(
                'uniStatus',
                function ($allLoanOfUni) {
                    return "<div class='tag tag-gardien-blue'>Đã duyệt</div>";
                }
            )
            ->addColumn(
                'moneyRequest',
                function ($allLoanOfUni) {
                    return number_format($allLoanOfUni->hsk_money)." VNĐ";
                }
            )
            ->addColumn(
                'action',
                function ($allLoanOfUni) {
                    return "<div class='tag tag-border-blue' data-toggle='modal' data-target='#modalDetail' data-id='".$allLoanOfUni->_id."'>Chi tiết</div></a>";
                }
            )
            
            ->rawColumns(['nameStudent','studentCode','duration','uniStatus','moneyRequest','action'])
            ->make(true);
    }


    public function getModalLoan(Request $req){
        $value = HoSoKhoanVay::where("_id",$req->idHS)->first();

        $svHoSo = SinhVienHoSo::where("_id",$value->idsaveSV)->first();
        $findNhaTruong = NhaTruong::where("nt_id",$value->chooseSchool)->select("nt_ten","nt_diachi")->first();
        $findNganHang = NganHang::whereIn("nn_id",$value->idBank)->select("nn_ten")->get();
        
        $value['hoten'] = $svHoSo->hoten;
        $value['sdt'] = $svHoSo->sdt;
        $value['email'] = $svHoSo->email;
        $value['stk'] = $svHoSo->stk;
        $value['diachi'] = $this->formatAddress($svHoSo->diachi);
        $value['diachihientai'] = $this->formatAddress($svHoSo->diachihientai);
        $value['cccd'] = $svHoSo->cccd;
        $value['ngaysinh'] = date("d/m/Y", strtotime($svHoSo->ngaysinh));
        $value['otherSdt'] = $svHoSo->otherSdt;
        $value['parents'] = $svHoSo->parents;
        $value['yourjob'] = $svHoSo->yourjob;
        $value['gioitinh'] = $svHoSo->gioitinh;
        $value['university'] = $svHoSo->university;
        $value['uni'] = $findNhaTruong;
        $value['bank'] = $findNganHang;

        $body =  view('smoney.university.modal-loan')->with([
            'hs' => $value
        ])->render();
        return $body;
    }
    public function feetbackLoan(Request $req,$idHS){
        $NotificationController = app('App\Http\Controllers\SmoneyControllers\NotificationController');
    
        $findHS = HoSoKhoanVay::where("_id",$idHS)->first();
        $findUniversity = NhaTruong::where("nt_id", $findHS->chooseSchool)->first();
        if($findHS){
            if($req->statusFeedback == "true"){
                $findHS->profileStatusInUni = "pass";
                $content = "Nhà trường ".$findUniversity->nt_ten." đã chấp nhận khoản vay";
                $type = "item-info";
            }
            if($req->statusFeedback == "false"){
                $findHS->profileStatusInUni = "refuse";
                $content = "Nhà trường ".$findUniversity->nt_ten." đã từ chối khoản vay";
                $type = "item-danger";
            }
            $findHS->feedbackContentUni = $req->feedbackContent;
            $findHS->save();

            $NotificationController->makeNotification(
                $content, $findUniversity->nt_id, $findHS->hsk_id_student, 
                'apply-loan', "3", "2", $type
            );

            return back()->with("success","Cập nhật thành công");
        }else{
            return back()->with("error","Có lỗi hồ sơ");
        }
    }
    public function approvedProfile(){
        $userLogin = Auth::user();
        $findUniversity = NhaTruong::where("nt_id",$userLogin->tks_sotk)->first();
        if($findUniversity) {
            return View('smoney/university/approvedprofile')->with([
                'name' => $findUniversity->nt_ten,
                'avatar' => $findUniversity->nt_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }















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
}

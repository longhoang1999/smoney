<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Carbon\Carbon;

// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\SinhVienHoSo;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;

class StudentLoanController extends Controller
{
    public function infoLoan()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        return view('smoney.student.info-loan')->with([
            'name' => $findStudent->hoten,
            'avatar' => $findStudent->avatar
        ]);
    }
    public function paidLoan()
    {
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        return view('smoney.student.paid-loan')->with([
            'name' => $findStudent->hoten,
            'avatar' => $findStudent->avatar
        ]);
    }
    
    public function LoanOfPass(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        $allLoanOfStudent = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfStudent)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfStudent) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfStudent->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfStudent) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfStudent->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                                ->loanProposal[$allLoanOfStudent->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfStudent) {
                    return 
                        $allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfStudent) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfStudent->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfStudent) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfStudent->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
            ->make(true);
    }
    public function LoanOfPaid(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        $allLoanOfStudent = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","paid")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfStudent)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfStudent) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfStudent->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfStudent) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfStudent->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                                ->loanProposal[$allLoanOfStudent->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfStudent) {
                    return 
                        $allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfStudent) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfStudent->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfStudent) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfStudent->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
            ->make(true);
    }
    public function getModalLoanNormal(Request $req){
        $value = HoSoKhoanVay::where("_id",$req->idHS)->first();

        $svHoSo = SinhVienHoSo::where("_id",$value->idsaveSV)->first();
        $findNhaTruong = NhaTruong::where("nt_id",$value->chooseSchool)->select("nt_ten","nt_diachi")->first();
        $findNganHang = NganHang::where("nn_id",$value->chooseBank)->select("nn_ten")->first();
        
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
        $value['nameBank'] = $findNganHang->nn_ten;

        $body =  view('smoney.bank.modal-loan-normal')->with([
            'hs' => $value,
            'status' => $req->status,
            'seeHS' => 'seeHS'
        ])->render();
        return $body;
    }
    public function LoanOfBankComeEnd(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        $allLoanOfStudent = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();   
        // lọc sắp hết hạn
        foreach($allLoanOfStudent as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired < Carbon::now()){
                unset($allLoanOfStudent[$key]);
            }
            if($timeRemaining > 10){
                unset($allLoanOfStudent[$key]);
            }
        }
        return DataTables::of($allLoanOfStudent)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfStudent) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfStudent->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfStudent) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfStudent->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfStudent) {
                    return $allLoanOfStudent
                        ->loanProposal[$allLoanOfStudent->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfStudent) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfStudent->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
    }
    public function LoanOfBankOutDate(){
        $userLogin = Auth::user();
        $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
        $allLoanOfStudent = HoSoKhoanVay::where("hsk_id_student",$findStudent->_id)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get(); 
        // lọc sắp hết hạn
        foreach($allLoanOfStudent as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired > Carbon::now()){
                unset($allLoanOfStudent[$key]);
            }
        }
        return DataTables::of($allLoanOfStudent)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfStudent) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfStudent->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfStudent) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfStudent->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfStudent) {
                    return 
                        number_format($allLoanOfStudent
                            ->loanProposal[$allLoanOfStudent->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfStudent) {
                    return $allLoanOfStudent
                        ->loanProposal[$allLoanOfStudent->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfStudent) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfStudent->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
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

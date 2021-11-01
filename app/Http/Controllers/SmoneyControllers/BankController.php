<?php

namespace App\Http\Controllers\SmoneyControllers;

use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\SinhVienHoSo;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;


class BankController extends Controller
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

    public function bankDashboard (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/bankdashboard')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function schoolinfo (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/schoolinfo')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }

    public function loaninfo (){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allUni = NhaTruong::select("nt_ten", "nt_id")->get();
        if($findBank) {
            return View('smoney/bank/loaninfo')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar,
                'allUni' => $allUni
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }
    public function loanwait(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/loanwait')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }
    public function LoanOfBankWait(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("idBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->get();  

        foreach($allLoanOfBank as $key => $loan){
            if($loan->loanProposal != null){
                $loanProposal = $loan->loanProposal;
                $keyBankID = array_keys((array)$loanProposal);
                if(in_array($userLogin->tks_sotk, $keyBankID))
                    unset($allLoanOfBank[$key]);
            }
        }
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten;
                }
            )
            ->addColumn(
                'moneyRequest',
                function ($allLoanOfBank) {
                    return number_format($allLoanOfBank->hsk_money).' VNĐ';
                }
            )
            ->addColumn(
                'duration',
                function ($allLoanOfBank) {
                    if($allLoanOfBank->hsk_duration == "1"){
                        return "3 tháng";
                    }else if($allLoanOfBank->hsk_duration == "2"){
                        return "6 tháng";
                    }else if($allLoanOfBank->hsk_duration == "2"){
                        return "12 tháng";
                    }
                }
            )
            ->addColumn(
                'purpose',
                function ($allLoanOfBank) {
                    if($allLoanOfBank->hsk_purpose == "1"){
                        return "Trả học phí";
                    }
                }
            )
            ->addColumn(
                'action',
                function ($allLoanOfBank) {
                    return "<div class='tag tag-border-blue' data-toggle='modal' data-target='#modalDetail' data-id='".$allLoanOfBank->_id."'>Chi tiết</div></a>";
                }
            )
            ->rawColumns(['nameStudent','nameUni','action'])
            ->make(true);
    }
    public function getModalLoan(Request $req){
        $value = HoSoKhoanVay::where("_id",$req->idHS)->first();

        $svHoSo = SinhVienHoSo::where("_id",$value->idsaveSV)->first();
        $findNhaTruong = NhaTruong::where("nt_id",$value->chooseSchool)->select("nt_ten","nt_diachi")->first();
        
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

        $body =  view('smoney.bank.modal-loan')->with([
            'hs' => $value
        ])->render();
        return $body;
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
            'status' => $req->status
        ])->render();
        return $body;
    }
    public function LoanComfirmPay(Request $req){
        $findHS = HoSoKhoanVay::where("_id",$req->idHS)->first();
        $findHS->profileStatusInBank = "paid";
        $findHS->totalMoney = $req->totalMoney;
        $findHS->dateOfPayment = Carbon::now()->toDateTimeString();
        $findHS->save();
        return back()->with("success", "Khoản vay đã được thanh toán thành công");
    }
    public function LoanPayOutDate(Request $req){
        $findHS = HoSoKhoanVay::where("_id",$req->idHS)->first();
        $findHS->profileStatusInBank = "paid";
        $findHS->totalMoney = $req->totalMoney;
        $findHS->moneyOutDate = $req->moneyOutDate;
        $findHS->dateOfPayment = Carbon::now()->toDateTimeString();
        $findHS->save();
        return back()->with("success", "Khoản vay đã được thanh toán thành công");
    }

    public function refuseWaitLoan(Request $req){
        $findHS = HoSoKhoanVay::where("_id",$req->idHS)->first();
        $loanProposal = (object) array(
            "feedbackContentBank" => $req->loanReason
        );
        $userLogin = Auth::user();
        $loanProposal = array($userLogin->tks_sotk => $loanProposal);
        $oldloanProposal = $findHS->loanProposal;
        if($oldloanProposal != null){
            $c = (object) $this->merge((array)$oldloanProposal, (array)$loanProposal);
            $findHS->loanProposal = $c;
        }else{
            $findHS->loanProposal = $loanProposal;
        }
        $findHS->save();


        $keyBankID = array_keys((array)$findHS->loanProposal);
        if(count($keyBankID) == count($findHS->idBank)){
            if($findHS->profileStatusInBank == "wait"){
                $findHS->profileStatusInBank = "refuse";
                $findHS->save();
            }
        }
        return back()->with('success',"Bạn từ chối khoản vay thành công");
    }
    public function passWaitLoan(Request $req){
        $this->validate($req,[
            'money'=>'required',
            'interestRate'=>'required',
            'loanMonth'=>'required',
            'moneyPayAMonth'=>'required',
            'aMonthProfit'=>'required'
        ],[
            'money.required' => 'Bạn phải nhập số tiền vay',
            'interestRate.required' => 'Bạn phải nhập lãi xuất vay',
            'loanMonth.required' => 'Bạn phải nhập kì hạn vay',
            'moneyPayAMonth.required' => 'Bạn không có trường số tiền gốc phải trả mỗi tháng',
            'aMonthProfit.required' => 'Bạn không có trường số tiền lãi phải trả mỗi tháng'
        ]);
        $userLogin = Auth::user();
        $findHS = HoSoKhoanVay::where("_id",$req->idHS)->first();
        $findHS->profileStatusInBank = "pass";

        $loanProposal = (object) array(
            "feedbackContentBank" => "Bạn hãy xem xét đề xuất khoản vay của chúng tôi",
            "money" => $req->money,
            "interestRate" => $req->interestRate,
            "loanMonth" => $req->loanMonth,
            "moneyPayAMonth" => $req->moneyPayAMonth,
            "aMonthProfit" => $req->aMonthProfit,
        );
        $loanProposal = array($userLogin->tks_sotk => $loanProposal);
        $oldloanProposal = $findHS->loanProposal;
        if($oldloanProposal != null){
            $c = (object) $this->merge((array)$oldloanProposal, (array)$loanProposal);
            $findHS->loanProposal = $c;
        }else{
            $findHS->loanProposal = $loanProposal;
        }
        $findHS->save();
        return back()->with('success',"Bạn đề xuất khoản vay thành công");
    }
    public function feedBackLoanStudent(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        if($findBank) {
            return View('smoney/bank/feetback-student')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }
    public function FeedBackLoanData(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("yourDecision","yes")
                ->where("two_sides_accept",null)
                ->get();          
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten;
                }
            )
            ->addColumn(
                'moneyLoan',
                function ($allLoanOfBank) {
                    return 
                    number_format($allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['money'])
                    .' VNĐ';
                }
            )
            ->addColumn(
                'duration',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth'].' tháng';
                }
            )
            ->addColumn(
                'interestRateLoan',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['interestRate'].'%';
                }
            )
            ->addColumn(
                'action',
                function ($allLoanOfBank) {
                    return "<div class='tag tag-border-blue' data-toggle='modal' data-target='#modalDetail' data-id='".$allLoanOfBank->_id."'>Chi tiết</div></a>";
                }
            )
            ->rawColumns(['nameStudent','nameUni','action'])
            ->make(true);
    }
    public function modalLoanFeedBack(Request $req){
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

        $body =  view('smoney.bank.feed-back-loan')->with([
            'hs' => $value
        ])->render();
        return $body;
    }
    public function modalLoanSuccess(Request $req){
        $findHS = HoSoKhoanVay::where("_id",$req->id)->first();
        if($req->status == "success"){
            $findHS->two_sides_accept = "true";
            $findHS->date_accept = $req->date;
            $date = Carbon::createFromFormat('Y-m-d H:i', $req->date)
                ->addMonth(
                    intval($findHS->loanProposal[$findHS->chooseBank]['loanMonth'])
                );
            $findHS->date_expired = $date->format('Y-m-d H:i');
            $mes = "Khoản vay đã được lưu thông";
            $log = "success";
        }else if($req->status == "refuse"){
            $findHS->two_sides_accept = "false";
            $findHS->bank_reason_refusal = $req->refuse;
            $mes = "Khoản vay đã được từ chối";
            $log = "error";
        }
        $findHS->save();
        return back()->with($log, $mes);
    }
    public function LoanOfBankPass(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
            ->make(true);
    }
    public function LoanOfBankComeEnd(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();  
        // lọc sắp hết hạn
        foreach($allLoanOfBank as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired < Carbon::now()){
                unset($allLoanOfBank[$key]);
            }
            if($timeRemaining > 10){
                unset($allLoanOfBank[$key]);
            }
        }
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfBank) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfBank->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
    }
    public function LoanOfBankOutDate(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();  
        // lọc sắp hết hạn
        foreach($allLoanOfBank as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired > Carbon::now()){
                unset($allLoanOfBank[$key]);
            }
        }
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfBank) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfBank->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
    }
    public function LoanOfBankPassUni($idUni){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("chooseSchool",$idUni)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
            ->make(true);
    }
    public function LoanComingEndUni($idUni){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("chooseSchool",$idUni)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();  
        // lọc sắp hết hạn
        foreach($allLoanOfBank as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired < Carbon::now()){
                unset($allLoanOfBank[$key]);
            }
            if($timeRemaining > 10){
                unset($allLoanOfBank[$key]);
            }
        }
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfBank) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfBank->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
    }
    public function LoanOutDateUni($idUni){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("chooseSchool",$idUni)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","pass")
                ->where("two_sides_accept","true")
                ->get();  
        // lọc sắp hết hạn
        foreach($allLoanOfBank as $key => $value){
            $date_expired = Carbon::createFromFormat('Y-m-d H:i', $value->date_expired);
            $timeRemaining = $date_expired->diffInDays(Carbon::now());
            if($date_expired > Carbon::now()){
                unset($allLoanOfBank[$key]);
            }
        }
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'timeRemaining',
                function ($allLoanOfBank) {
                    $date_expired = Carbon::createFromFormat('Y-m-d H:i', $allLoanOfBank->date_expired);
                    $timeRemaining = $date_expired->diffInDays(Carbon::now());
                    return '<span class="badge badge-danger">'.$timeRemaining.' ngày</span>';
                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','timeRemaining'])
            ->make(true);
    }
    public function loanpaid(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allUni = NhaTruong::select("nt_ten", "nt_id")->get();
        if($findBank) {
            return View('smoney/bank/loanpaid')->with([
                'name' => $findBank->nn_ten,
                'avatar' => $findBank->nn_avatar,
                'allUni' => $allUni
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }

    }
    public function ListLoanPaid(){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","paid")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
            ->make(true);
    }
    
    public function ListLoanPaidUni($idUni){
        $userLogin = Auth::user();
        $findBank = NganHang::where("nn_id",$userLogin->tks_sotk)->first();
        $allLoanOfBank = HoSoKhoanVay::where("chooseBank",strval($findBank->nn_id))
                ->where("chooseSchool",$idUni)
                ->where("hsk_send_status","true")
                ->where("profileStatusInUni","pass")
                ->where("profileStatusInBank","paid")
                ->where("two_sides_accept","true")
                ->get();          
        return DataTables::of($allLoanOfBank)
            ->addColumn(
                'nameStudent',
                function ($allLoanOfBank) {
                    $findStudent = SinhVienHoSo::where("maHS",$allLoanOfBank->_id)->select("hoten")->first();
                    return $findStudent->hoten;
                }
            )
            ->addColumn(
                'nameUni',
                function ($allLoanOfBank) {
                    $findUniversity = NhaTruong::where("nt_id",strval($allLoanOfBank->chooseSchool))
                        ->select("nt_ten")->first();
                    return $findUniversity->nt_ten.'<br>'.
                        '<span class="badge badge-success">Đã duyệt</span>';
                }
            )
            ->addColumn(
                'loanProposal',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['money']).' VNĐ';
                }
            )
            ->addColumn(
                'interestRate',
                function ($allLoanOfBank) {
                    return 
                        number_format($allLoanOfBank
                            ->loanProposal[$allLoanOfBank->chooseBank]['interestRate']);
                }
            )
            ->addColumn(
                'loanMonth',
                function ($allLoanOfBank) {
                    return $allLoanOfBank
                        ->loanProposal[$allLoanOfBank->chooseBank]['loanMonth']. " tháng";
                }
            )
            ->addColumn(
                'dateAccept',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_accept));

                }
            )
            ->addColumn(
                'dateExpired',
                function ($allLoanOfBank) {
                    return date("d-m-Y h:i A", strtotime($allLoanOfBank->date_expired));

                }
            )
            ->rawColumns(['nameStudent','nameUni','loanProposal','interestRate','loanMonth','dateAccept','dateExpired'])
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

<?php

namespace App\Http\Controllers\SmoneyControllers;

use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\Admin;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard (){
        $userLogin = Auth::user();
        $findAdmin = Admin::where("ad_id",$userLogin->tks_sotk)->first();
        if($findAdmin) {
            return View('smoney/admin/index')->with([
                'name' => $findAdmin->ad_name,
                'avatar' => ''
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

     public function school (){
        $userLogin = Auth::user();
        $findAdmin = Admin::where("ad_id",$userLogin->tks_sotk)->first();
        if($findAdmin) {
            return View('smoney/admin/school')->with([
                'name' => $findAdmin->ad_name,
                'avatar' => ''
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

    public function bank (){
        $userLogin = Auth::user();
        $findAdmin = Admin::where("ad_id",$userLogin->tks_sotk)->first();
        if($findAdmin) {
            return View('smoney/admin/bank')->with([
                'name' => $findAdmin->ad_name,
                'avatar' => ''
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }

     public function account (){
        $userLogin = Auth::user();
        $findAdmin = Admin::where("ad_id",$userLogin->tks_sotk)->first();
        if($findAdmin) {
            return View('smoney/admin/student')->with([
                'name' => $findAdmin->ad_name,
                'avatar' => ''
            ]);
        }
        else {
            Auth::logout();
            return redirect()->route('homepage.login')->with("error","Tài khoản của bạn bị lỗi");
        }
    }
    public function showAllStudent(){
        $allStudent = Student::get();
        return DataTables::of($allStudent)
            ->addColumn(
                'stt',
                function ($allStudent) {
                    $stt = "";
                    return $stt;
                }
            )
            ->addColumn(
                'diachi',
                function ($allStudent) {
                    if($allStudent->diachihientai == null)
                        return '<span class="badge badge-warning">Chưa khai báo</span>';
                    else
                        return $this->formatAddress($allStudent->diachihientai);
                }
            )
            ->addColumn(
                'university',
                function ($allStudent) {
                    $uniString = "";
                    if($allStudent->university != null){
                        $idArrUni = array_keys($allStudent->university);
                        foreach($idArrUni as $value){
                            $findUniversity = NhaTruong::where("nt_id",$value)->select("nt_ten")->first();
                            $uniString = $uniString.$findUniversity->nt_ten;
                        }
                    }else{
                        $uniString = '<span class="badge badge-warning">Chưa khai báo</span>';
                    }
                    return $uniString;
                }
            )
            ->rawColumns(['stt','diachi','university'])
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

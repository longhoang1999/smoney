<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

// model
use App\Models\SmoneyModels\TaiKhoanSmoney;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\HoSoKhoanVay;
use App\Models\SmoneyModels\SinhVienHoSo;
use App\Models\SmoneyModels\TaiKhoanSmoney_Log;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;

class PositionController extends Controller
{
    public function seeHS($idHS){
        if(Auth::check()){
            $findHS = HoSoKhoanVay::where("_id", $idHS)->first();
            $userLogin = Auth::user();
            $checkUniversity = false;
            $checkStudent = false;
            $checkBank = false;

            // kiểm tra sinh viên login
            if($findHS->hsk_id_student ==  $userLogin->tks_sotk && $userLogin->tks_loaitk == "1")
            {
                $checkStudent = true;
            }
            // check nhà trường đăng ký
            if($findHS->chooseSchool ==  $userLogin->tks_sotk && $userLogin->tks_loaitk == "2")
            {
                $checkUniversity = true;
            }
            // check ngân hàng đăng ký
            if($findHS->chooseBank ==  $userLogin->tks_sotk && $userLogin->tks_loaitk == "3")
            {
                $checkBank = true;
            }

            if($checkStudent || $checkUniversity || $checkBank){
                $value = $this->loadView($idHS);
                return View('smoney/homepage/showprofileposition')->with([
                    'hs' => $value
                ]);
            }else{
                return redirect()->route("homepage.homepage_old");
            }
        }else{
            return redirect()->route("homepage.login")->with("error","Bạn phải đăng nhập trước");
        }
    }
    public function loadView($idHS){
        $value = HoSoKhoanVay::where("_id",$idHS)->first();

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
        return $value;
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

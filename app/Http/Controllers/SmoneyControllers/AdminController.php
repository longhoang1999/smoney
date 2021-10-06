<?php

namespace App\Http\Controllers\SmoneyControllers;

use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\Student;
use App\Models\SmoneyModels\NhaTruong;
use App\Models\SmoneyModels\NganHang;
use App\Models\SmoneyModels\TaiKhoanSmoney;
use Illuminate\Support\Facades\Hash;
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
    public function showAlluniversity(){
        $allUni = NhaTruong::get();
        return DataTables::of($allUni)
            ->addColumn(
                'stt',
                function ($allUni) {
                    $stt = "";
                    return $stt;
                }
            )
            ->addColumn(
                'avatar',
                function ($allUni) {
                    if($allUni->nt_avatar != null)
                        return '<div class="roud"><img src="'.asset($allUni->nt_avatar).'" alt=""></div>';
                    else
                        return "";
                }
            )
            ->addColumn(
                'action',
                function ($allUni) {
                    return '<button type="button" class="btn btn-sm btn-block btn-outline-info" data-id="'.$allUni->nt_id.'" data-toggle="modal" data-target="#detailModal">Chỉnh sửa</button><button type="button" class="btn btn-sm btn-block btn-danger" data-name="'.$allUni->nt_ten.'" data-id="'.$allUni->nt_id.'" data-toggle="modal" data-target="#resetModal">Reset password</button>';
                }
            )
            ->rawColumns(['stt','avatar','action'])
            ->make(true);
    }
    public function showAllbank(){
        $allBank = NganHang::get();
        return DataTables::of($allBank)
            ->addColumn(
                'stt',
                function ($allBank) {
                    $stt = "";
                    return $stt;
                }
            )
            ->addColumn(
                'avatar',
                function ($allBank) {
                    if($allBank->nn_avatar != null)
                        return '<div class="roud"><img src="'.asset($allBank->nn_avatar).'" alt=""></div>';
                    else
                        return "";
                }
            )
            ->addColumn(
                'action',
                function ($allBank) {
                    return '<button type="button" class="btn btn-sm btn-block btn-outline-info" data-id="'.$allBank->nn_id.'" data-toggle="modal" data-target="#detailModal">Chỉnh sửa</button><button type="button" class="btn btn-sm btn-block btn-danger" data-name="'.$allBank->nn_ten.'" data-id="'.$allBank->nn_id.'" data-toggle="modal" data-target="#resetModal">Reset password</button>';
                }
            )
            ->rawColumns(['stt','avatar','action'])
            ->make(true);
    }
    public function getUniInfo(Request $req){
        $findUni = NhaTruong::where("nt_id",$req->idUni)->first();
        $image = "";
        if($findUni->nt_avatar != null){
            $image = asset($findUni->nt_avatar);
        }   
        $data = array(
            "idUni" => $findUni->nt_id,
            "maUni" => $findUni->nt_ma,
            "sdtUni" => $findUni->nt_sdt, 
            "tenUni" => $findUni->nt_ten, 
            "imgUni" => $image,  "emailUni" => $findUni->nt_email,
            "addressUni" => $findUni->nt_diachi);
        return $data;
    }
    public function fixUniInfo(Request $req, $idUni){
        $this->validate($req,[
            'maUni'=>'required',
            'phoneUni'=>'required',
            'tenUni'=>'required',
            'addressUni'=>'required'
        ],[
            'maUni.required' => 'Bạn phải nhập mã trường',
            'phoneUni.required' => 'Bạn phải nhập số điện thoại',
            'tenUni.required' => 'Bạn phải nhập tên trường',
            'addressUni.required' => 'Bạn phải nhập địa chỉ trường'
        ]);
        $findUni = NhaTruong::where("nt_id",$idUni)->first();
        $findUni->nt_ma = $req->maUni;
        $findUni->nt_ten = $req->tenUni;
        $findUni->nt_email = $req->emailUni;
        $findUni->nt_diachi = $req->addressUni;

        // img
        if($req->file('imgUni') != null){
            if($findUni->nt_avatar != ""){
                File::delete(public_path($findUni->nt_avatar));
            }
            $image = $req->file('imgUni');
            $picName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('folder-university/'.$findUni->nt_code), $picName);
            $findUni->nt_avatar='folder-university/'.$findUni->nt_code.'/'.$picName;
        }
        $findUni->save();
        // sdt
        if($req->phoneUni != $findUni->nt_sdt){
            $checkPhone = TaiKhoanSmoney::where("tks_sdt", $req->phoneUni)->first();
            if(!$checkPhone){
                $smoneyAcc = TaiKhoanSmoney::where("tks_sdt", $findUni->nt_sdt)->first();
                $smoneyAcc->tks_sdt = $req->phoneUni;
                $smoneyAcc->save();
                $findUni->nt_sdt = $req->phoneUni;
                $findUni->save();

            }else{
                return back()->with("error","Số điện thoại đã tồn tại trong hệ thống!");
            }
        }
        return back()->with("success","Bạn đã cập nhật thành công");
    }
    public function resetPass($idUni){
        $findUni = NhaTruong::where("nt_id",$idUni)->first();
        $uniAccount = TaiKhoanSmoney::where("tks_sdt", $findUni->nt_sdt)->first();
        $uniAccount->ths_mk = Hash::make($uniAccount->tks_sdt);
        $uniAccount->save();
        return back()->with("success","Bạn đã đặt lại mật khẩu thành công!");
    }
    public function addNewUni(Request $req){
        $this->validate($req,[
            'maUni'=>'required',
            'phoneUni'=>'required',
            'tenUni'=>'required',
            'addressUni'=>'required'
        ],[
            'maUni.required' => 'Bạn phải nhập mã trường',
            'phoneUni.required' => 'Bạn phải nhập số điện thoại',
            'tenUni.required' => 'Bạn phải nhập tên trường',
            'addressUni.required' => 'Bạn phải nhập địa chỉ trường'
        ]);
        $checkPhone = TaiKhoanSmoney::where("tks_sdt", $req->phoneUni)->first();
        if(!$checkPhone){
            $newUni = new NhaTruong();
            $newUni->nt_ma = $req->maUni;
            $newUni->nt_ten = $req->tenUni;
            $newUni->nt_email = $req->emailUni;
            $newUni->nt_diachi = $req->addressUni;
            $newUni->nt_sdt = $req->phoneUni;

            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $newUni->nt_code = substr(str_shuffle($permitted_chars), 0, 20); 
            $path = public_path().'/folder-university/' . $newUni->nt_code;
            File::makeDirectory($path,0777,true);
            
               
            if($req->file('imgUni') != null){
                $image = $req->file('imgUni');
                $picName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('folder-university/'.$newUni->nt_code), $picName);
                $newUni->nt_avatar='folder-university/'.$newUni->nt_code.'/'.$picName;
            }
            $newUni->save();


            $newAcc = new TaiKhoanSmoney();
            $newAcc->tks_sotk = $newUni->nt_id;
            $newAcc->tks_sdt = $newUni->nt_sdt;
            $newAcc->tks_tentk = $newUni->nt_ten;
            $newAcc->tks_loaitk = "2";
            $newAcc->ths_mk = Hash::make($newAcc->tks_sdt);
            $newAcc->save();

            return back()->with("success","Bạn đã thêm nhà trường thành công");
        }else{
            return back()->with("error","Số điện thoại đã tồn tại trong hệ thống!");
        }
    }

    public function resetPassBank($idBank){
        $findBank = NganHang::where("nn_id",$idBank)->first();
        $uniAccount = TaiKhoanSmoney::where("tks_sdt", $findBank->nn_sdt)->first();
        $uniAccount->ths_mk = Hash::make($uniAccount->tks_sdt);
        $uniAccount->save();
        return back()->with("success","Bạn đã đặt lại mật khẩu thành công!");
    }

    public function getBankInfo(Request $req){
        $findBank = NganHang::where("nn_id",$req->idBank)->first();
        $image = "";
        if($findBank->nn_avatar != null){
            $image = asset($findBank->nn_avatar);
        }   
        $data = array(
            "idBank" => $findBank->nn_id,
            "tenBank" => $findBank->nn_ten,
            "phoneBank" => $findBank->nn_sdt,
            "imgBank" => $image,
            "emailBank" => $findBank->nn_email, 
            "addressBank" => $findBank->nn_diachi, 
            "infomationBank" => $findBank->nn_thongtin,
            "policyBank" => $findBank->nn_chinhsach,
            "activeBank" => $findBank->nn_hoatdong
        );
        return $data;
    }
    public function fixBankInfo(Request $req,$idBank){
        $this->validate($req,[
            'tenBank'=>'required',
            'phoneBank'=>'required',
            'addressBank'=>'required'
        ],[
            'tenBank.required' => 'Bạn phải nhập tên ngân hàng',
            'phoneBank.required' => 'Bạn phải nhập số điện thoại ngân hàng',
            'addressBank.required' => 'Bạn phải nhập địa chỉ ngân hàng',
        ]);
        $findBank = NganHang::where("nn_id",$idBank)->first();
        $findBank->nn_ten = $req->tenBank;
        $findBank->nn_email = $req->emailBank;
        $findBank->nn_diachi = $req->addressBank;
        $findBank->nn_thongtin = $req->infomationBank;
        $findBank->nn_chinhsach = $req->policyBank;
        $findBank->nn_hoatdong = $req->activeBank;

        // img
        if($req->file('imgBank') != null){
            if($findBank->nn_avatar != ""){
                File::delete(public_path($findBank->nn_avatar));
            }
            $image = $req->file('imgBank');
            $picName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('folder-bank/'.$findBank->nn_code), $picName);
            $findBank->nn_avatar='folder-bank/'.$findBank->nn_code.'/'.$picName;
        }
        $findBank->save();
        // sdt
        if($req->phoneBank != $findBank->nn_sdt){
            $checkPhone = TaiKhoanSmoney::where("tks_sdt", $req->phoneBank)->first();
            if(!$checkPhone){
                $smoneyAcc = TaiKhoanSmoney::where("tks_sdt", $findBank->nn_sdt)->first();
                $smoneyAcc->tks_sdt = $req->phoneBank;
                $smoneyAcc->save();
                $findBank->nn_sdt = $req->phoneBank;
                $findBank->save();

            }else{
                return back()->with("error","Số điện thoại đã tồn tại trong hệ thống!");
            }
        }
        return back()->with("success","Bạn đã cập nhật thành công");
    }
    public function addNewBank(Request $req){
        $this->validate($req,[
            'tenBank'=>'required',
            'phoneBank'=>'required',
            'addressBank'=>'required'
        ],[
            'tenBank.required' => 'Bạn phải nhập tên ngân hàng',
            'phoneBank.required' => 'Bạn phải nhập số điện thoại ngân hàng',
            'addressBank.required' => 'Bạn phải nhập địa chỉ ngân hàng',
        ]);
        $checkPhone = TaiKhoanSmoney::where("tks_sdt", $req->phoneBank)->first();
        if(!$checkPhone){
            $newBank = new NganHang();
            $newBank->nn_ten = $req->tenBank;
            $newBank->nn_diachi = $req->addressBank;
            $newBank->nn_email = $req->emailBank;
            $newBank->nn_thongtin = $req->infomationBank;
            $newBank->nn_chinhsach = $req->policyBank;
            $newBank->nn_hoatdong = $req->activeBank;
            $newBank->nn_sdt = $req->phoneBank;

            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $newBank->nn_code = substr(str_shuffle($permitted_chars), 0, 20); 
            $path = public_path().'/folder-bank/' . $newBank->nn_code;
            File::makeDirectory($path,0777,true);
            
               
            if($req->file('imgBank') != null){
                $image = $req->file('imgBank');
                $picName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('folder-bank/'.$newBank->nn_code), $picName);
                $newBank->nn_avatar='folder-bank/'.$newBank->nn_code.'/'.$picName;
            }
            $newBank->save();


            $newAcc = new TaiKhoanSmoney();
            $newAcc->tks_sotk = $newBank->nn_id;
            $newAcc->tks_sdt = $newBank->nn_sdt;
            $newAcc->tks_tentk = $newBank->nn_ten;
            $newAcc->tks_loaitk = "3";
            $newAcc->ths_mk = Hash::make($newAcc->tks_sdt);
            $newAcc->save();

            return back()->with("success","Bạn đã thêm ngân hàng thành công");
        }else{
            return back()->with("error","Số điện thoại đã tồn tại trong hệ thống!");
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

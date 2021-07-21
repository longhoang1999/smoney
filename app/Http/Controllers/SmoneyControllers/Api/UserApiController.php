<?php

namespace App\Http\Controllers\SmoneyControllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmoneyModels\Student;

class UserApiController extends Controller
{
    public function getInformation(Request $req)
    {
        $fields = $req->validate([
            'APIKEY' => 'required',
        ]);
        if($fields['APIKEY'] == "SMONEYSECRETKEY"){
            $user = Auth::user();
            $findInfor = Student::where("_id",$user->tks_sotk)->first();
            if($findInfor){          
                $response = [
                    'result' => 'success',
                    'findInfor' => $findInfor,
                ];
                return response($response,200);
            }else{
                $toEncode["result"] = "fail";
                $toEncode["Error"] = "The system cannot find your account";            
                return response($toEncode,401);
            } 
        }else{
            $toEncode["result"] = "fail";
            $toEncode["Error"] = "Connection errors";      
            return response($toEncode,400);
        }
    }
    public function updateInformation(Request $req)
    {
        $fields = $req->validate([
            'APIKEY' => 'required',
        ]);
        if($fields['APIKEY'] == "SMONEYSECRETKEY"){
            $user = Auth::user();
            $findInfor = Student::where("_id",$user->tks_sotk)->first();
            if($findInfor){          
                $folder=$findInfor->code;
                $image = $req->file('input_img');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('folder-user/'.$folder), $imageName);
                // save to db
                $findInfor->image = 'folder-user/'.$folder.'/'.$imageName;
                $findInfor->save();

                $response = [
                    'result' => 'success',
                    'linkImg' => url($findInfor->image),
                ];
                return response($response,200);
            }else{
                $toEncode["result"] = "fail";
                $toEncode["Error"] = "The system cannot find your account";            
                return response($toEncode,401);
            } 
        }else{
            $toEncode["result"] = "fail";
            $toEncode["Error"] = "Connection errors";      
            return response($toEncode,400);
        }
    }
}

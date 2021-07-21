<?php

namespace App\Http\Controllers\SmoneyControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// model
use App\Models\SmoneyModels\Student;

class HomeController extends Controller
{
    public function homePage()
    {
        return view('smoney.homepage.index');
    }

    public function homePage_old()
    {
        if(Auth::check()){
            $userLogged = Auth::user();
            $findUser = Student::where("_id",$userLogged->tks_sotk)->first();
            return view('smoney.homepage.homepage',[
                'status' => 'userLogged',
                'name' => $findUser->hoten,
                'image' => $findUser->image
            ]);   
        }else{
            return view('smoney.homepage.homepage');
        }
    }

    public function login()
    {
        return view('smoney.homepage.login');
    }
}

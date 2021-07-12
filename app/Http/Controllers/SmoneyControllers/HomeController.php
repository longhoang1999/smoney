<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Models\SmoneyModels\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function homePage()
    {
        return view('smoney.homepage.index');
    }

    public function homePage_old()
    {
        return view('smoney.homepage.homepage');
    }

    public function login()
    {
        return view('smoney.homepage.login');
    }
}
